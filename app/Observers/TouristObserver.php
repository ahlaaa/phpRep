<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Card;
use App\Models\Order;
use App\Models\Rebate;
use App\Models\Tourist;
use App\Models\Cate;
use App\Models\Product;
use App\Models\Standard;
use App\Models\User;
use App\Models\UserOrder;
use Illuminate\Notifications\Notifiable;
use Auth;
use Log;

class TouristObserver
{
    use  Notifiable;

    public function creating(Tourist $model)
    {
        $model->user_name = $model->user_name??(optional(User::find($model->user_id))->name??null);
        $model->status = 1;
//        Log::info(request()->get('standard'));

    }

    public function created(Tourist $model)
    {

    }


    public function updating(Tourist $model)
    {
        $tourist = Tourist::find($model->id);
        $user = User::find($model->user_id);
        if ($tourist->status != 2 && $model->status == 2)
            $this->finishTour($user,$model);
    }
    private function finishTour(Tourist $tourist){
        // 消费福利
//        $this->rebate($model);

        $uos = UserOrder::where([['first_oid',$tourist->id]])->whereIn('status',[1,2])->get();
        $num = sizeof($uos)??0;
        if ($num <= 0)
            return false;
        $time = date('Y-m-d H:i:s');
        foreach ($uos as $uo){
            $uo->status = 1;
            $uo->end_at = $time;
            $uo->save();
        }
        //2级
        $can = \DB::table('grade_user')->where([['user_id',$tourist->user_id],['type',3],['prox_level',2],['status',1]])->first();
        //1级
        $can1 = \DB::table('grade_user')->where([['user_id',$tourist->user_id],['type',3],['prox_level',1],['status',1]])->first();
        $flag = false;//上级不为1级
        $r_user = User::find($tourist->user_id);
        $sup2 = $r_user->superior;
        if (!empty($can)){
            if (!empty($sup2) && $sup2->id != 1){
                $can11 = \DB::table('grade_user')->where([['user_id',$sup2->id],['type',3],['prox_level',1],['status',1]])->first();
                if (!empty($can11))
                    $flag = true;//上级为1级
            }

        }
        //1级代理商 游客旅游产品?的佣金12%
        //2 => '1级代理商奖励',
        //        3 => '2级代理商奖励',游客旅游产品的佣金10%;所属1级代理商2%(无,归自己)
        $sub_order = Order::whereIn('order_id',$uos->pluck("order_id")->toArray())->whereIn('status',[2,3,4])->get();

        foreach ($sub_order as $od) {
            if (!empty($can1)) {
                $amount = ($od->pre_amount)*0.12;
                $data = array('order_id'=>$od->id,'product_id'=>$od->product_id,'amount'=>$amount,'type'=>2,
                    'user_id'=>$tourist->user_id,'remark'=>'游客消费奖励1级代理商','created_user_id'=>$od->user_id,'created_user_name'=>optional($od->user)->name??'','status'=>1);
                Rebate::create($data);
//                $r_user->increment('rebate',$amount);
            }
            //2级代理商 上级为1级->2%,own->10% || 12%
            if (!empty($can)){
                if (!$flag){//上级不为1 12%
                    $amount = ($od->pre_amount)*0.12;
                    $data = array('order_id'=>$od->id,'product_id'=>$od->product_id,'amount'=>$amount,'type'=>3,
                        'user_id'=>$tourist->user_id,'remark'=>'游客消费奖励2级代理商(12%)','created_user_id'=>$od->user_id,'created_user_name'=>optional($od->user)->name??'','status'=>1);
                    Rebate::create($data);
//                    $r_user->increment('rebate',$amount);
                }else{//上级不1 10% 上级2%
                    $amount1 = ($od->pre_amount)*0.1;
                    $data = array('order_id'=>$od->id,'product_id'=>$od->product_id,'amount'=>$amount1,'type'=>3,
                        'user_id'=>$tourist->user_id,'remark'=>'游客消费奖励2级代理商(12%)','created_user_id'=>$od->user_id,'created_user_name'=>optional($od->user)->name??'','status'=>1);
                    Rebate::create($data);
//                    $r_user->increment('rebate',$amount1);
                    $amount2 = ($od->pre_amount)*0.02;
                    $data = array('order_id'=>$od->id,'product_id'=>$od->product_id,'amount'=>$amount2,'type'=>3,
                        'user_id'=>$tourist->user_id,'remark'=>'游客消费奖励1级代理商(2%)','created_user_id'=>$od->user_id,'created_user_name'=>optional($od->user)->name??'','status'=>1);
                    Rebate::create($data);
//                    $sup2->increment('rebate',$amount2);
                }
            }
            // 消费福利1
            $this->rebate($od);
        }
        /**
         * 参加过公益游1次
         */
        $vis = Order::where([['user_id',$tourist->user_id],['otype',3],['created_at','<',$tourist->created_at],['status',4]])->first();
        if (!empty($vis) && $num >= 6)
            $this->getChance($tourist->user);
    }
    private function getChance(User $user){
        $user->increment('apply_free',1);
    }
    protected function rebate(Order $model)
    {
        $user = $model->user;
        $sup = $user->superior;
        /**
         * 下级消费 1%---代理商获得
         */
        $prox_sup = \DB::table('grade_user')->where([['user_id',$sup->id],['type',3],['status',1]])->first();
        if($model->otype != 4 && isset($sup) && $sup->id != 1 && !empty($prox_sup) && $sup->grades_id == 5){
            $amount = ($model->pre_amount)*0.01;
//            $sup->increment('rebate',$amount??0);
            $data = array('order_id'=>$model->id,'product_id'=>$model->product_id,'amount'=>$amount,'type'=>1,
                'user_id'=>$sup->id,'remark'=>'代理商获得下级消费1%','created_user_id'=>$user->id,'created_user_name'=>$user->name,'status'=>1);
            Rebate::create($data);
        }

        //充值
        if ($model->otype == 4) {
            //->u+
            if ($user->grades_id == 1 && $model->pre_amount >= 99) {
                //+2 消费券
                $this->addCard($user,1, 2);
            }
            //u+ 79c
            if ($user->grades_id == 5 ){
                if ($model->pre_amount >= 79)
                    $this->addCard($user, 1,2);
            }
        }
        if ($user->grades_id == 5 && $model->otype != 4){
            if ($model->pre_amount >= 199)
                $this->addCard($user, 1,1);
        }
    }
    private function addCard(User $user,int $cid,int $num){
        $card = \DB::table('card_user')->where([['user_id',$user->id],['card_id',$cid]])->first();
        $card1 = Card::find($cid);
        /**
         * +2 消费券/50
         */
        if (isset($card)){
            $data = array('price'=>$card1->price??0,'product_num'=>$card1->product_num??0,'product_unit'=>$card1->product_unit??null,
                'product_id'=>$card1->product_id??null,'updated_at'=>date('Y-m-d H:i:s'));
            $data['card_num'] = ($card->card_num+$num);
            \DB::table('card_user')->where('id',$card->id)->update($data);
        }else{
            $data = array('user_id'=>$user->id,'card_id'=>1,'price'=>$card1->price??0,'product_num'=>$card1->product_num??0,'product_unit'=>$card1->product_unit??null,
                'product_id'=>$card1->product_id??null,'card_num'=>$num,'created_at'=>date('Y-m-d H:i:s'));
            \DB::table('card_user')->insert($data);
        }
    }
    public function updated(Tourist $model)
    {
    }

    public function deleted(Tourist $model)
    {

    }

}