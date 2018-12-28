<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Medal;
use App\Models\Cate;
use App\Models\Product;
use App\Models\Standard;
use Illuminate\Notifications\Notifiable;
use Auth;
use Log;

class MedalObserver
{
    use  Notifiable;

    public function creating(Medal $model)
    {
//        Log::info(request()->get('standard'));

    }

    public function created(Medal $model)
    {

    }


    public function updating(Medal $model)
    {
    }

    public function updated(Medal $model)
    {
    }

    public function deleted(Medal $model)
    {

    }

}