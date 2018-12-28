<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Cate;
use App\Models\Product;
use App\Models\Standard;
use Illuminate\Notifications\Notifiable;
use Auth;
use Log;

class CateObserver
{
    use  Notifiable;

    public function creating(Cate $model)
    {
//        Log::info(request()->get('standard'));

    }

    public function created(Cate $model)
    {

    }


    public function updating(Cate $model)
    {
    }

    public function updated(Cate $model)
    {
    }

    public function deleted(Cate $model)
    {

    }

}