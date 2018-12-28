<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Withdraw;
use App\Models\User as Users;
use App\User;
use Illuminate\Notifications\Notifiable;
use EasyWeChat;
use Illuminate\Support\Facades\Redis;

class WithdrawObserver
{
    use  Notifiable;

    public function creating(Withdraw $model){
        $user = Users::findOrFail($model->user_id);
        if(!empty($user))
            $model->user_name = $user->name??'';
    }

    public function updating(Withdraw $model)
    {
        if ($model->isDirty('status') &&  $model->status === 2) {
            if ($model->user->rebate < $model->amount) { // 余额不足无法审核通过
                setcookie('withdraw_update'.$model->id.'msg','用户余额不足无法审核通过',time()+300,'/');
                return false;
            }

            if ($model->type === 3) {
                return $this->transferWechat($model);
            } else {
                $model->user->decrement('rebate', $model->amount);
            }
        }
    }

    const taxed = 0.99;
    public function transferWechat(Withdraw $model)
    {
        $payment = EasyWeChat::payment();

        $partnerTradeNo = 'tx' . time();

        if (!$model->user->open_id) {
            return false;
        }

//        dd(intval($model->amount * 100 * self::taxed));

        $result = $payment->transfer->toBalance([
            'partner_trade_no' => $partnerTradeNo, // 商户订单号，需保持唯一性(只能是字母或者数字，不能包含有符号)
            'openid' => $model->user->open_id,
            'check_name' => 'NO_CHECK', // NO_CHECK：不校验真实姓名, FORCE_CHECK：强校验真实姓名
            'amount' => intval($model->amount * 100 * self::taxed), // 企业付款金额，单位为分
            'desc' => '金蚂蚁提现', // 企业付款操作说明信息。必填
        ]);


        if ($result['return_code'] === 'SUCCESS') {

            if (array_get($result, 'result_code') === 'FAIL') {
                setcookie('withdraw_update'.$model->id.'msg','微信商户号余额不足或故障,打款失败',time()+300,'/');
                return false;
            }

            if (array_get($result, 'result_code') === 'SUCCESS') {
                setcookie('withdraw_update'.$model->id.'msg','微信打款成功',time()+300,'/');
                $model->user->decrement('rebate', $model->amount);
            }
        }


    }

}