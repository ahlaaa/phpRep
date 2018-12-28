<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Card;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Auth;

class UserObserver
{
    use  Notifiable;

    public function creating(User $model)
    {
        $model->grades_id = 1;
//        $user = User::find($model->superior_id);
        /**
         * 上级 抽取勋章机会+1
         */
//        if (isset($user) && $user->id != 1){
//            $user->increment('card_times',1);
//        }
    }


    public function updating(User $model)
    {
        $user = User::find($model->id);
        $sup = $user->superior;
        /**
         * 更新上级 上级抽取勋章机会+1
         */
        if(isset($sup) && $sup->grades_id == 5) {
//            if (($user->superior_id == 1 || !isset($user->superior_id)) && $model->superior_id != 1 && isset($sup) && $sup->id != 1)
//                $user->increment('card_times', 1);
            if (isset($user->superior_id) && $user->superior_id != 1 && $user->grades_id == 1 && $model->grades_id == 5 && $model->superior_id != 1 && isset($sup) && $sup->id != 1)
            {
                $sub = $sup->subordinates->count()??0;
                if ($sub > 10)
                    return true;
                $num = 1;
                if ($sub == 5)
                    $num += 3;
                if ($sub == 10)
                    $this->addCard($sup,3,1);//香槟兑换券
//                $user->increment('card_times', 1);
                $this->addCard($sup,2,$num);//面膜兑换券
            }
        }
//        $m = request()->get('m','User');
//        \Log::info('Models::'.json_encode($model));
//        $input = $model;
//        $input = new $m($input->toArray());
//        unset($input->id);
//        \Log::info('Models1::'.json_encode($model));
//        \Log::info('User::'.json_encode($input));
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
        if (!empty($card)){
            $data = array('price'=>$card1->price??0,'product_num'=>$card1->product_num??0,'product_unit'=>$card1->product_unit??null,
                'product_id'=>$card1->product_id??null);
            $data['card_num'] = ($card->card_num+$num);
            \DB::table('card_user')->where('id',$card->id)->update($data);
        }else{
            $data = array('user_id'=>$user->id,'card_id'=>1,'price'=>$card1->price??0,'product_num'=>$card1->product_num??0,'product_unit'=>$card1->product_unit??null,
                'product_id'=>$card1->product_id??null,'card_num'=>$num);
            \DB::table('card_user')->insert($data);
        }
    }

}