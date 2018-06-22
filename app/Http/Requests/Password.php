<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;
use Hash;
use Auth;
class Password extends FormRequest
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

    public function yanzheng(){
        Validator::extend('pwd',function ($attribute, $value, $parameters, $validator){
            return Hash::check($value,Auth::user()->password);
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->yanzheng();
        return [
            'oldpassword' => 'required|pwd',
            'password' => 'required|confirmed|min:3|max:16',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'oldpassword.pwd' => '原密码错误!',
        ];
    }
}
