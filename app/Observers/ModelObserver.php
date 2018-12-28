<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use Illuminate\Notifications\Notifiable;
use App\Models\Model;
use Auth;

class ModelObserver
{
    use  Notifiable;

//    public function __construct()
//    {
//        $this->user = Auth::user() ?? Auth::guard('api')->user();
//
//        // $this->user_id = $this->user? $this->user->id : 0;
//        // $this->user_id = $this->user->id;
//        // $this->user_name = $this->user ? $this->user->name : 'unknown';
//        // $this->user_name = $this->user->name;
//    }
//
//    public function creating(Model $model)
//    {
//        $model->created_user_id = $this->user->id;
//        $model->created_user_name = $this->user->name;
//        $model->updated_user_id = $this->user->id;
//        $model->updated_user_name = $this->user->name;
//    }
////
//    public function updating(Model $model)
//    {
//        $model->updated_user_id = $this->user->id;
//        $model->updated_user_name = $this->user->name;
//    }
}