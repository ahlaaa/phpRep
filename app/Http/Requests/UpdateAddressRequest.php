<?php

namespace App\Http\Requests;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Address;

class UpdateAddressRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['telephone' => ['required', new PhoneRule()]] + Address::$rules;
    }
}
