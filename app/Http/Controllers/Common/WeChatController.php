<?php
/**
 * Created by PhpStorm.
 * User: huangming
 * Date: 2018/3/15
 * Time: 15:46
 */

namespace App\Http\Controllers\Common;
use App\Models\UserOrder;
use App\Repositories\AccountFlowRepository;
use App\Repositories\OrderRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use EasyWeChat;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;


class WeChatController extends BaseController
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        $officialAccount = EasyWeChat::officialAccount();

        return $officialAccount->server->serve();
    }


    public function jsBridge(String $prepayId): String
    {
        $payment = EasyWeChat::payment();

        $jssdk = $payment->jssdk;

        $json = $jssdk->bridgeConfig($prepayId); // 返回 json 字符串，如果想返回数组，传第二个参数 false

        return $json;
    }

    public function jssdk(String $prepayId)
    {
        $payment = EasyWeChat::payment();

        $jssdk = $payment->jssdk;

        $json = $jssdk->sdkConfig($prepayId); // 返回 json 字符串，如果想返回数组，传第二个参数 false

        return $json;
    }

    public function notify(Request $request, OrderRepository $orderRepository, AccountFlowRepository $accountFlowRepository)
    {
        $payment = EasyWeChat::payment();

        $response = $payment->handlePaidNotify(function ($message, $fail) use ($orderRepository, $accountFlowRepository) {

            $order =  $orderRepository->findWhere(['number'=> $message['out_trade_no']])->first();

            if (!$order || $order->status >= 2) { // 如果订单不存在 或者 订单已经支付过了
                return true; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            ///////////// <- 建议在这里调用微信的【订单查询】接口查一下该笔订单的情况，确认是已经支付 /////////////

            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                if (array_get($message, 'result_code') === 'SUCCESS') {
//                    if ($order->products->first()->category->pid  == 20) {
//                        $order->status = 3;
//                    } else {
//                        $order->status = 2;
//                    }
                    $order->status = 2;
                    if ($order->otype == 1)//公益造林订单
                        $order->status = 4;
//                    if($order->otype == 3){//旅游订单
//                        $uo = UserOrder::where('order_id',$order->id)->first();
//                        $uo->status = 1;
//                        $uo->save();
//                    }
                    if($order->otype == 4)//充值订单
                        $order->status = 4;
                    $order->save(); // 保存订单
                    $accountFlowRepository->create([
                        'type'=> 0,
                        'number'=> 'zf' . $order->number,
                        'user_id'=> $order->user_id,
                        'amount'=> $order->amount,
                        'order_id'=> $order->id,
                    ]);
                    // 用户支付失败

                }
            }

            return true; // 返回处理完成
        });

        return $response;
    }

    public function oauth(Request $request)
    {
        $officialAccount = EasyWeChat::officialAccount();
        $response = $officialAccount->oauth->scopes(['snsapi_userinfo'])
            ->setRequest($request)
            ->redirect();
        return $response;
    }

    public function code()
    {
        $officialAccount = EasyWeChat::officialAccount();

        $oauth = $officialAccount->oauth;

// 获取 OAuth 授权结果用户信息
        $user = $oauth->user();


        return $user;
    }

    public function login(Request $request)
    {
        $openid = $request->openid;

        if (!$openid) {
            return $this->sendError('登录失败', 412);
        }

        $user = User::where('open_id', $openid)->first();

        if ($user) {
            return $this->sendResponse([
                'access_token' => $user->createToken('openid')->accessToken
            ], '登录成功');
        }
        return $this->sendError('登录失败', 412);
    }

    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }
}