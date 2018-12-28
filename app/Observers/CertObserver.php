<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Cert;
use Illuminate\Notifications\Notifiable;
use Auth;
use Log;

class CertObserver
{
    use  Notifiable;

    public function creating(Cert $model)
    {
//        Log::info(request()->get('standard'));

    }

    public function created(Cert $model)
    {

    }


    public function updating(Cert $model)
    {
    }

    public function updated(Cert $model)
    {
    }

    public function deleted(Cert $model)
    {

    }

}