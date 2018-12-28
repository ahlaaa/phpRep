<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Card;
use App\Models\Gift;
use App\Models\Log;
use App\Models\Order;
use App\Models\Point;
use App\Models\Product;
use App\Models\Rebate;
//use App\Models\Sale;
use App\Models\Sapling;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\Application;
use App\Repositories\RebateRepository;
use App\Repositories\StoreRepository;
use App\Repositories\UserRepository;
use Illuminate\Notifications\Notifiable;
use Auth;
use Illuminate\Support\Facades\Redis;

class OrderObserver
{
    use  Notifiable;

    public function creating(Order $model)
    {
//        $this->user = Auth::user() ?? Auth::guard('api')->user();
//
//        $model->created_user_id = $this->user->id;
//        $model->created_user_name = $this->user->name;
        $model->status = 1;
        $model->user_name = optional($model->user)->name??'';
        $model->amount = ($model->amount==0)?0.01:$model->amount;
        if (empty($model->father_id))
            $model->leader_id = $model->user_id;
        $model->number = date('Ymd') . time();
        if ($model->use_times != 0)
            User::find($model->user_id)->decrement('tour_times',$model->use_times);
//        \Log::info('orders::'.json_encode($model));
        //判断是否为香榧果订单 统计斤数
        $can = $this->checkOrderCreate($model);
        if ($can == 1)
            $model->fruit_order = 1;
        //$model->address_str = $model->address ? $model->address->location : '';
        // $model->amount = bcmul(constants('PRODUCT_PRICE'), $model->qty, 2);
    }
//    'ORDER_STATUS' => [
//1 => '待付款',
//2 => '待发货',
//3 => '已发货',
//4 => '已确认',
//5 => '已取消',
//6 => '退换货'
//    ],
    private function checkOrderCreate(Order $order)
    {
        $cates = sizeof($order->cates) > 0 ? $order->cates : $order;
        $flag = 0;
        foreach ($cates as $cate) {
            if (!isset($cate->product_id))
                continue;
            $product = Product::find($cate->product_id);
            if (!empty($product) && $product->product_category_id == 21) {
                $flag = 1;
                break;
            }
        }
        return $flag;
    }
    public function created(Order $model){

    }
    /**
     * @param Application $model
     * 升级为代理商
     */
    private function upgrades(Application $model){
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
    public function updating(Order $model)
    {

//        if($model->isDirty('status') && 4 == $model->status)
//            $model->deal_time = date('Y-m-d H:i:s');
        $order = Order::find($model->id);
        if ($model->status == 2 && $order->status != 2 ) {
//            if ($order->otype == 3) {
//                //if (array_get($input,'otype') == 3)
//                    Order::assUsers($order);
////                $uo = UserOrder::where('order_id', $model->id)->first();
////                if (!empty($uo)) {
////                    $uo->status = 1;
////                    $uo->save();
////                }
//            }
            //申请代理 后台已同意 改变用户
            //testing-------------------
            if ($order->otype == 5){
                $application = Application::where('order_id',$model->id)->first();
                if (!empty($application) && $application->status == 2)// && $model->level == 2
                    $this->upgrades($application);
            }
        }
        if ($model->status == 4 && $order->status != 4) {
//            if ($order->otype == 3){
//                $uo = UserOrder::where('order_id',$model->id)->first();//[['first_oid',$model->father_id],['user_id',$model->user_id]]
//                if(!empty($uo)){
//                    $uo->status = 2;
//                    $uo->save();
//                }
//            }
            $model->deal_time = date('Y-m-d H:i:s');
            $this->done($model);
        }
        /**
         * 取消旅游团订单 退出团
         */
//        if ($model->status == 5 && $order->status != 5 && $order->otype == 3){
//            $uo = UserOrder::where('order_id',$model->id)->first();
//            if ($model->use_times != 0)
//                User::find($model->user_id)->increment('tour_times',$model->use_times);
//            if(!empty($uo)){
//                $uo_status = $uo->status??0;//1--已付款
//                //删除数据库数据
//                $uo->forceDelete();
//                if ($uo_status == 1){
//                    $data = array('order_id'=>$order->id,'product_id'=>$order->product_id,'amount'=>$order->amount,'type'=>5,
//                        'user_id'=>$model->user_id,'remark'=>'游客取消已付款的团订单,退款到奖励','created_user_id'=>$order->user_id,'created_user_name'=>optional($order->user)->name??'','status'=>1);
//                    Rebate::create($data);
//                }
////                $order->user->increment()
//            }
//        }

//        if ($model->status === 2 && $order->status !== 2) $this->pay($model, $order);
    }

    public function updated(Order $model){
    }

    private function tourist(Order $model){

    }
    private function recharge(Order $model){

    }
    protected function done(Order $model)
    {
        $user = User::find($model->user_id);
        $model = Order::find($model->id);
        /**
         * u+会员 购买香榧干果 cid=21
         */
        if ($model->otype == 2 && $user->grades_id == 5)
            $this->checkOrder($model,$user);
        /**
         * 公益造林订单  加入到树表
         */
        if ($model->otype == 1)
            $this->addSaplings($model, $user);

        $this->users($model, $user);
        $this->cards($model, $user);
        if($model->otype != 3)
            // 消费福利 不为旅游订单 直接奖励 否则  旅游完成后奖励
            $this->rebate($model);
        // 升级
        $this->upgrade($model);
        // 献金
//        $this->point($model);

    }

    /**
     * @param Order $order
     * @param User $user
     * 香榧干果购买
     * 一次性购买35斤->7折优惠(140/斤);近7年消费35斤香榧干果&每年>=5斤
     * 得:香榧树1棵、树权证、收益卡(按收益表自主选择交付方式(简单声明));推荐人香榧干果1斤(按人数累加)/年(20年)+权益卡(自动发放)
     */
    private function checkOrder(Order $order,User $user){
        $cates = sizeof($order->cates) > 0?$order->cates:$order;
        $fruits = array();
        foreach ($cates as $cate){
            if ($cate->product->product_category_id == 21)
                array_push($fruits,$cate);
        }
        $allWeights = 0;
        foreach ($fruits as $fruit){
            $weight = $fruit->product->weight??$fruit->product->weig;
            $allWeights += $weight;
        }
        $sub_flag = false;
        $sub_orders = Order::where([['status',4],['fruit_order',1]])->whereBetween('created_at',[date('Y-m-d H:i:s',strtotime('-6 years')),date('Y-m-d H:i:s')])->get();
        $sub_fruits = array();
        foreach ($sub_orders as $sub_order){
            $sub_cates = sizeof($sub_order->cates) > 0?$sub_order->cates:$sub_order;
            foreach ($sub_cates as $sub_cate){
                if ($sub_cate->product->product_category_id != 21)
                    continue;
                $created_at = date('Y',strtotime($sub_order->created_at));
                $str_time = $created_at.'-1-1 00:00:00';
                $year_keys = Gift::where([['from_user_id',$user->from_user_id],['type',0]])->whereBetween('created_at',[$str_time,date('Y-m-d H:i:s',strtotime('+1 years',strtotime($str_time)))])->first();
                if (!empty($year_keys))
                    break;
                if (isset($sub_fruits[$created_at])){
                    $sub_fruits[$created_at] += $sub_cate->product->weight??$sub_cate->product->weig;
                }else{
                    $sub_fruits[$created_at] = $sub_cate->product->weight??$sub_cate->product->weig;
                }
            }
        }
        //连续7年消费 且总共大于35斤
        if (sizeof($sub_fruits) >= 7 && array_sum($sub_fruits) >= 35){
            $sub_flag = true;
            foreach ($sub_fruits as $sub_fruit){
                if ($sub_fruit < 5) {
                    $sub_flag = false;
                    break;
                }
            }
        }

        $allWeights = 0;
        foreach ($fruits as $fruit){
            $weight = $fruit->product->weight??$fruit->product->weig;
            $allWeights += $weight;
        }
        /**
         * 第8年接上了? 继续给上级加
         */
        if ($allWeights/1000/2 >= 35) {
            $this->gifts1($order, $user, 1);
        }else if ($sub_flag) {
            $this->gifts1($order, $user);
        }
    }

    private function gifts1(Order $order,User $user,int $type = 0){
        $this->addSaplings($order,$user,2);
        $this->addCert($user,1);
        $this->addCert($user,3);
        if ($user->superior_id != 1) {
            $superior = $user->superior;
            if (!isset($superior))
                return false;
            $this->addCert($superior,2);
            $g_data = array('user_id'=>$superior->id,'name'=>'香榧干果','fruit_nums'=>500,'fruit_end_time'=>date('Y-m-d H:i:s',strtotime('+20 years')),
                'fruit_start_time'=>date('Y-m-d H:i:s'),'order_id'=>$order->id,'from_user_id'=>$user->id,'type'=>$type);
            Gift::create($g_data);
        }
    }

    private function addCert(User $user,int $cid,string $image = null){
        $data = array('user_id'=>$user->id,'cert_id'=>$cid,'updated_at'=>date('Y-m-d H:i:s')
        ,'begin_at'=>date('Y-m-d H:i:s'),'end_at'=>date('Y-m-d H:i:s',strtotime('+100 years')),'image'=>$image);
        $cert = \DB::table('cert_user')->where([['user_id',$user->id],['cert_id',$cid]])->first();
        if (empty($cert)){
            $data['created_at'] = date('Y-m-d H:i:s');
            \DB::table('cert_user')->insert($data);
        }else{
            $data['begin_at'] = $cert->begin_at;
            \DB::table('cert_user')->where('id',$cert->id)->insert($data);
        }

    }


    private function getChance(User $user){
        $user->increment('apply_free',1);
    }

    /**
     * @param Order $model
     * @param User $user
     * 增加香榧果树
     */
    private function addSaplings(Order $model,User $user,int $type = 1){
        $o_cates = $model->cates;
        $pid = $model->product_id;
        $cids = array();
        if (sizeof($o_cates) > 0){
            foreach ($o_cates as $cate){
                if($cate->pivot->product_id == $pid)
                    array_push($cids,$cate->id);
//                    $cid = $cate->id;
            }
        }
        $arr = array('user_id'=>$user->id,'product_id'=>$model->product_id,'order_number'=>$model->number,'type'=>$model->product->type,'status'=>1,'type'=>$type);
//        if(isset($cid))
//            $arr['cate_id'] = $cid;
        if (sizeof($cids) > 0){
            foreach ($cids as $cid){
                $arr['cate_id'] = $cid;
                Sapling::create($arr);
            }
        }else{
            Sapling::create($arr);
        }
//        Sapling::create($arr);
    }

    private function users(Order $model, User $user)
    {
        /**
         * 充值增加余额
         * u+ 79->99
         */
        if($model->otype == 4) {
            $amount = $model->pre_amount??0;
            $getType = '余额充值';
            if ($user->grades_id == 5 && $model->pre_amount >= 79){
                $amount += 20;
                $getType = '余额充值(+会员冲79得99)';
            }
            $user->increment('coupon', $amount??0);
            $data = array('order_id'=>$model->id,'product_id'=>$model->product_id,'amount'=>$amount,'type'=>4,
                'user_id'=>$user->id,'remark'=>$getType,'created_user_id'=>$user->id,'created_user_name'=>optional($user)->name??'','status'=>1);
            Rebate::create($data);
        }
        /**
         * 余额抵扣
         */
        $user->decrement('coupon', $model->coupon_reduce??0);
    }

    private function cards(Order $model, User $user)
    {
        $card = \DB::table('card_user')->where([['user_id', $model->user_id], ['card_id', $model->card_id]])->first();
        if (!empty($card)) {
            \DB::table('card_user')->where('id',$card->id)->update(['card_num'=>($card->card_num??0)-($model->card_num??0),'updated_at'=>date('Y-m-d H:i:s')]);
//            $input = $card;
//            \DB::table('card_user')->delete($card->id, true);
//            $input = json_decode(json_encode($input), true);
//            unset($input['id']);
//            $input['deleted_at'] = date('Y-m-d H:i:s');
//            \DB::table('cardlogs')->insert($input);
        }
    }

    //
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

    private function upuser($num = array(),User $user,Order $model){
        $reb_num = $num[0];
        if(sizeof($num) > 1){
            $rebate_num = $model->amount*($reb_num/100);
        }else{
            $cates = $model->cates;
            $nums_cate = sizeof($cates)>0?sizeof($cates):1;
            $rebate_num = $reb_num*$nums_cate;
        }
        $user->coupon += $rebate_num;
        $user->rebate += $rebate_num;
        $user->save();
    }
    /**
     * 升级 99=》+会员
     * @param Order $model
     */
    protected function upgrade(Order $model)
    {
        $user = $model->user;
        if ($user->grades_id == 1 && $model->otype == 4 && $model->pre_amount >= 99){
            $user->grades_id = 5;
            $user->save();
        }
    }

    /**
     * @param User $user
     * @param int $num
     * 增加券
     */
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

    const BASE = 100000000;
    /**
     * 献金
     */
    protected function point(Order $model) {

        $basePoint =  Point::find(0);

        $percentage = $basePoint->point / self::BASE * 100;

        $now = Point::where('percentage', '<=', $percentage)->first();

        $point = $now->point *  $model->products->reduce(function ($carry, $product) {
                return $carry + $product->pivot->qty * $product->price;
            });
        $model->user->point += $point;

        $model->user->save();

        $basePoint->point -= $point;

        $basePoint->save();
    }
    //
    protected function pay(Order $model, Order $order)
    {

    }

}