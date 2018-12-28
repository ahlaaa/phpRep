<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Rebate;
use Illuminate\Notifications\Notifiable;

class RebateObserver
{
    use  Notifiable;

    public function creating(Rebate $model)
    {
        if ($model->user_id == 1) {
            return false;
        }
        if ($model->type != 4) {
            $model->user->rebate += $model->amount;

            $model->user->save();
        }
//        else{
//            $model->user->increment('coupon',$model->amount);
//        }


    }


    public function updating(Rebate $model)
    {
    }

}