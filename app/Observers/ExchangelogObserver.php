<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Card;
use App\Models\Exchangelog;
use Illuminate\Notifications\Notifiable;
use Auth;
use Log;

class ExchangelogObserver
{
    use  Notifiable;

    public function creating(Exchangelog $model)
    {
//        Log::info(request()->get('standard'));

    }

    public function created(Exchangelog $model)
    {

    }


    public function updating(Exchangelog $model)
    {
//        $log = Exchangelog::findOrFail($model->id);
//        if ($model->status == 2 && optional($log)->status != 2){
//            $cards = \DB::table('card_user')->where([['user_id'=>$model->user_id],['card_id'=>$model->card_id]])->first();
//            if ($cards){
//                \DB::table('card_user')->where('id',$cards->id)->update(['card_num'=>($cards->card_num+1)]);
//            }else{
//                $card = Card::findOrFail($model->card_id);
//                $data = array('user_id'=>$model->user_id,
//                    'card_id'=>$model->card_id,'price'=>$card->price,'product_num'=>$card->product_num,
//                    'product_id'=>$card->product_id,'card_num'=>1);
//                \DB::table('card_user')->insert($data);
//            }
//        }
    }

    public function updated(Exchangelog $model)
    {
    }

    public function deleted(Exchangelog $model)
    {

    }

}