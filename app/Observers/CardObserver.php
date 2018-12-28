<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Card;
use App\Models\Cate;
use App\Models\Product;
use App\Models\Standard;
use Illuminate\Notifications\Notifiable;
use Auth;
use Log;

class CardObserver
{
    use  Notifiable;

    public function creating(Card $model)
    {
//        Log::info(request()->get('standard'));

    }

    public function created(Card $model)
    {

    }


    public function updating(Card $model)
    {
    }

    public function updated(Card $model)
    {
    }

    public function deleted(Card $model)
    {

    }

}