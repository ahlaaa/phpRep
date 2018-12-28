<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/20
 * Time: 15:04
 */

namespace App\Http\Requests\API;


use App\Models\Maintain;
use Illuminate\Foundation\Http\FormRequest;
use InfyOm\Generator\Request\APIRequest;

class UpdateMaintainAPIRequest extends APIRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [];//Maintain::$rules;
    }
}