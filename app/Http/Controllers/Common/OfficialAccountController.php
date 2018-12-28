<?php
/**
 * Created by PhpStorm.
 * User: huangming
 * Date: 2018/3/15
 * Time: 15:46
 */

namespace App\Http\Controllers\Common;

use App\Repositories\AccountFlowRepository;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use EasyWeChat;

// 公众号
class OfficialAccountController extends BaseController
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

            if (!$order || $order->status >= 1) { // 如果订单不存在 或者 订单已经支付过了
                return true; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            ///////////// <- 建议在这里调用微信的【订单查询】接口查一下该笔订单的情况，确认是已经支付 /////////////

            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                if (array_get($message, 'result_code') === 'SUCCESS') {
                    $order->status = 1;
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


    public function userList()
    {
        $officialAccount = EasyWeChat::officialAccount();

        //dd($officialAccount->data_cube->visitDistribution("2017-06-11", "2017-06-17"));
//        return $miniProgram->userPortrait("2017-06-11", "2018-06-11");
//
//        // dd(($miniProgram->auth->session(1)));
        return $officialAccount->user->list();
    }
}