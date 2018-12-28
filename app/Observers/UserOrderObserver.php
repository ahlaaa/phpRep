<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Order;
use App\Models\UserOrder;
use App\Models\Cate;
use App\Models\Product;
use App\Models\Standard;
use Illuminate\Notifications\Notifiable;
use Auth;
use Log;

class UserOrderObserver
{
    use  Notifiable;

    public function creating(UserOrder $model)
    {
//        Log::info(request()->get('standard'));

    }

    public function created(UserOrder $model)
    {

    }


    public function updating(UserOrder $model)
    {
        $um = UserOrder::find($model->id);
//        if (empty(request()->getUri()) && $model->status == 1 && $um->status != 1)
//            optional(Order::findOrFail($model->order_id))->increment('amount',$model->amount);
        if($model->status == 2 && $um->status != 2){
            $this->rebate($model);
        }

    }

    /**
     * @param UserOrder $model
     * 旅游完成  奖励
     */
    private function rebate(UserOrder $model){

    }

    public function updated(UserOrder $model)
    {
    }

    public function deleted(UserOrder $model)
    {

    }

}