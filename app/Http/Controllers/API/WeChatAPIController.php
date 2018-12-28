<?php
/**
 * Created by PhpStorm.
 * User: huangming
 * Date: 2018/3/15
 * Time: 15:46
 */

namespace App\Http\Controllers\API;
use App\Repositories\AccountFlowRepository;
use EasyWeChat;
use Auth;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OrderRepository;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use Illuminate\Http\Request;
use Log;

class WeChatAPIController extends AppBaseController
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function order(OrderRepository $orderRepository, int $id)
    {
        $payment = EasyWeChat::payment(); // 微信支付

        $order = $orderRepository->findWithoutFail($id);

        $result = $payment->order->unify([
            'body' => '支付订单',
            'out_trade_no' => $order->number,
            'attach' => $id,
            //'total_fee' => $order->amount * 100,
            'total_fee' => 1,
            'trade_type' => 'JSAPI',
            'openid' => Auth::guard('api')->user()->open_id,
        ]);

        return $result;

    }

    public function balance(AccountFlowRepository $accountFlowRepository, float $amount)
    {
        $user = Auth::user();

        if ($user->rebate < $amount) {
            return $this->sendResponse([], '账户余额不足');
        }
        $payment = EasyWeChat::payment();

        $partnerTradeNo = 'tx' . time();

        $result = $payment->transfer->toBalance([
            'partner_trade_no' => $partnerTradeNo, // 商户订单号，需保持唯一性(只能是字母或者数字，不能包含有符号)
            'openid' => Auth::guard('api')->user()->open_id,
            //'check_name' => 'FORCE_CHECK', // NO_CHECK：不校验真实姓名, FORCE_CHECK：强校验真实姓名
            'check_name' => 'NO_CHECK', // NO_CHECK：不校验真实姓名, FORCE_CHECK：强校验真实姓名
            //'re_user_name' => '王小帅', // 如果 check_name 设置为FORCE_CHECK，则必填用户真实姓名
            'amount' => $amount * 100, // 企业付款金额，单位为分
            'desc' => '金蚂蚁提现', // 企业付款操作说明信息。必填
        ]);

        if ($result['return_code'] === 'SUCCESS') {
            if (array_get($result, 'result_code') === 'SUCCESS') {
                $accountFlowRepository->create([
                    'type'=> 1,
                    'user_id'=> Auth::guard('api')->user()->id,
                    'amount'=> $amount,
                    'number'=> $partnerTradeNo
                ]);
                $user->rebate = bcsub($user->rebate, $amount, 2);
                $user->save();
                return $this->sendResponse($result, '提现成功');
            }
        }
        return $this->sendResponse($result, '提现失败');
        // return $this->sendError('提现失败');
    }

    public function queryBalanceOrder(String $tradeNo)
    {
        $payment = EasyWeChat::payment();
        return $payment->transfer->queryBalanceOrder(123456789);
    }

    public function regisetQrcode(Request $request)
    {
        $qrCode = new QrCode(
            'https://' .
            $request->server('HTTP_HOST') .
            '/register.html?superior_id=' . Auth::user()->id
            );
        $qrCode->setSize(300);
        $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'qrcode') . DIRECTORY_SEPARATOR . Auth::user()->id . '.png';
        $qrCode->writeFile($path);
        return 'https://' . $request->getHost() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'qrcode' . DIRECTORY_SEPARATOR . Auth::user()->id . '.png';
    }
    
}