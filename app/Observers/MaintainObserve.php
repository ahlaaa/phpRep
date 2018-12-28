<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/20
 * Time: 14:46
 */

namespace App\Observers;


use App\Models\Maintain;
use App\Models\Order;
use Illuminate\Notifications\Notifiable;

class MaintainObserve
{
    use Notifiable;

    public function creating(Maintain $model)
    {
        $model->user_id = \Auth::id();
        $model->number = 'MT'.date("Ym").time();

    }
    public function created(Maintain $model){
        $maintain = Maintain::find($model->id);
        if(!empty($maintain)){
            $order = $maintain->order;
            $order->status = 6;
            $order->save();
        }
    }

    public function updating(Maintain $model)
    {
        $maintain = Maintain::find($model->id);
        if (!in_array($maintain->status,[4,5]) && 4 == $model->status && in_array($model->type,[1,3])){
            $user = $maintain->user;
            $user->coupon += $model->re_amount;
            $user->save();
        }
    }
    public function updated(Maintain $model){
        $maintain = Maintain::find($model->id);
        if(5 == $model->status){
            $order = $maintain->order;
            $order->status = $model->order_status;
            $order->save();
        }
    }

}