<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'. $this -> id,
            'password' => 'nullable|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'يرجى ادخال الاسم',
            'email.required' => 'يرجى ادخال البريد الالكتروني',
            'email.email' => 'يرجى التحقق من صيعة البريد الالكتروني المدخل',
            'email.unique' => 'هذا الايميل موجود من قبل يرجى التحقق من البريد الالكتروني االمدخل',
            'password.confirmed' => 'كلمة المرور غير متطابقة يرجى التأحد منها',
            'password.min' => 'كلمة المرور أقل من 8 جروف و 8 أرقام يجب أن تكون أكثر من 8 حروف و 8 أرقام'
        ];

    }
}
