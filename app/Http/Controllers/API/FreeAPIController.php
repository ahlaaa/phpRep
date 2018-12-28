<?php
/**
 * Created by PhpStorm.
 * User: huangming
 * Date: 2018/1/16
 * Time: 13:58
 */

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Models\Enterprise;
use App\Models\Exhibition;
use InfyOm\Generator\Utils\ResponseUtil;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Response;
use Validator;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class FreeAPIController extends Controller
{
    use ValidatesRequests;

    public function register(UserRepository $userRepository, CreateUserAPIRequest $request)
    {
        $input = $request->all();
//        $tel_validate = request()->input('code',null);
//        unset($input['code']);
        $validator = Validator::make($input, User::$rules);
        $tel_code = $_COOKIE['jmy_tel_code']??null;

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->all(), '422');
        }
//        if (empty($tel_valide) || $tel_validate != $tel_code)
//            return $this->sendError('验证码不匹配', '422');
        setcookie('jmy_tel_code',null,time(),'/');
        $input['password'] = '123456';
        $users = $userRepository->create($input);
        $user = User::find($users->id);
        if($user->superior_id != 1){
            $this->rebateSuperior($user);
        }
        return $this->sendResponse($users->toArray(), '注册成功');
    }

    private function rebateSuperior(User $model){
        $card_user = new User();
        $user = User::find($model->id);
        //20元充值券
        $card_user->addCard($user,5,1);
        $sup = $user->superior;
        /**
         * 更新上级 上级抽取勋章机会+1
         */
        if(isset($sup) && $sup->id != 1) {
            $sub = $sup->subordinates->count()??0;
            $flag = false;
            if ($sub == 10 && $sup->grades_id == 1){
                $sup->grades_id = 5;
                $sup->save();
                $flag = true;
            }
            if ((isset($sup) && $sup->grades_id == 5) || $flag)
                $sup->increment('card_times', 1);
        }
    }

    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }
}