<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Application;
use App\Models\Cate;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rebate;
use App\Models\Standard;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Auth;
use Log;

class ApplicationObserver
{
    use  Notifiable;

    public function creating(Application $model)
    {
//        Log::info(request()->get('standard'));

    }

    public function created(Application $model)
    {

    }


    /**
     * @param Application $model
     * testing-----------------------------
     */
    public function updating(Application $model)
    {
        $app = Application::find($model->id);
        if(isset($app) && $app->status != 2 && $model->status == 2){
            $order = Order::find($model->order_id);
            if (!empty($order) && in_array($order->status,array(2,3,4)))//$model->level == 2 &&
                $this->upgrade($model);
        }

    }

    /**
     * @param Application $model
     * 升级代理商
     */
    private function upgrade(Application $model){
        $user = User::find($model->user_id);
        //4 3 2 省 市 区
        $gid = 4;
        $province = $model->province;
        $city = $model->city;
        $country = $model->country;
        $data = array('prox_name4'=>$province);
        if (!empty($city)){
            $data['prox_name3'] = $city;
            $gid = 3;
        }
        if (!empty($country)){
            $data['prox_name2'] = $country;
            $gid = 2;
        }

        $prox = \DB::table('grade_user')->where([['user_id',$model->user_id],['type',3],['grade_id',$gid]])->first();
        $data['grade_id'] = $gid;
        $data['user_id'] = $user->id;
        $data['prox_level'] = $model->level;
        $data['status'] = 1;
        $data['is_oauthed'] = 1;
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (!empty($prox)){
            \DB::table('grade_user')->where('id',$prox->id)->update($data);
        }else{
            $data['type'] = 3;
            $data['created_at'] = date('Y-m-d H:i:s');
            \DB::table('grade_user')->insert($data);
        }
        /**
         * 机会申请1级代理商 -1
         */
        if ($model->use_chance == 1)
            $user->decrement('apply_free',1);
        $sup = $user->superior;
        if (isset($sup) && $sup->id != 1)
            $this->upSup($sup,$model,$user);
        //申请获得旅游机会一次
        if ($model->level == 2)
            $user->increment('tour_times',1);
    }

    /**
     * @param User $user
     * @return bool
     * 推荐一位代理商->自动升级为1级
     */
    private function upSup(User $user,Application $model,User $b_user){
        $can = \DB::table('grade_user')->where([['user_id',$user->id],['type',3],['prox_level',2]])->first();
        $can1 = \DB::table('grade_user')->where([['user_id',$user->id],['type',3],['prox_level',1]])->first();
        //推荐1位代理->余额+1000
        if ($model->level == 2 && (!empty($can) || !empty($can1))) {
            $user->increment('coupon', 1000);
            $order = Order::find($model->order_id);
            if (!empty($order)) {
                $data = array('order_id' => $order->id, 'product_id' => $order->product_id, 'amount' => 1000, 'type' => 4,
                    'user_id' => $user->id, 'remark' => '推荐1位二级代理,余额+1000', 'created_user_id' => $b_user->id, 'created_user_name' => optional($b_user)->name ?? '', 'status' => 1);
                Rebate::create($data);
            }
        }
        if (empty($can))
            return false;
        $data = array('status'=>1,'is_oauthed'=>1,'prox_level'=>1,'updated_at'=>date('Y-m-d H:i:s'));
        \DB::table('grade_user')->where('id',$can->id)->update($data);
        return true;
    }

    public function updated(Application $model)
    {
    }

    public function deleted(Application $model)
    {

    }

}