<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/20
 * Time: 15:04
 */

namespace App\Http\Requests;


use App\Models\Maintain;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintainRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [];//Maintain::$rules;
    }
}