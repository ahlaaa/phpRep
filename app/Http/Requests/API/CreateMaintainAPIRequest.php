<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/20
 * Time: 15:04
 */

namespace App\Http\Requests\API;


use App\Http\Controllers\AppBaseController;
use App\Models\Maintain;
use Illuminate\Foundation\Http\FormRequest;
use InfyOm\Generator\Request\APIRequest;
use Validator;

class CreateMaintainAPIRequest extends APIRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
//        $validator = Validator::make($request->all(), Maintain::$rules);
//        \Log::info(json_encode($validator));
//        if ($validator->fails()) {
//            return (new AppBaseController())->sendError($validator,201);
//        }
        return Maintain::$rules;
    }
}