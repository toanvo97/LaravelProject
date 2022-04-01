<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            //
            'email'=>'required|email|unique:users,email',
            'name'=>'required|max:100|unique:users,name',
            'password'=>'required'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email không được để trống',
            'name.required' => 'Tên tài khoản không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'email.unique' => 'Email Đã tồn tại',
            'name.unique' => 'Tài khoản đã tồn tại',
            'name.max'=>'Vượt quá 100 ký tự'
        ];
    }
}
