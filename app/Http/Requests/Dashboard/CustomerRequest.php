<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required|max:100|min:1',
            'email' => 'required|max:100|email|unique:customers,email,'. $this -> id,
            'password' => 'required|confirmed|digits_between:4,6',
            'terms_conditions' => 'accepted',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'يرجى ادخال اسم العميل',
            'name.max' => 'يجب ان لا يتجاوز الاسم عن 100 حرف ',
            'name.min' => 'يجب ادخال حرف واحد على الاقل من اسم العميل ',
            'email.required' => 'يرجى ادخال البريد الالكتروني',
            'email.email' => 'يرجى التحقق من صيعة البريد الالكتروني المدخل',
            'email.unique' => 'هذا الايميل موجود من قبل يرجى التحقق من البريد الالكتروني االمدخل',
            'password.required' => 'يرجى ادخال كلمة المرور',
            'password.digits_between' => 'كلمة المرور يجب ان لا تقل عن 4 أحرف ولا تزيد عن 6 احرف',
            'password.confirmed' => 'كلمة المرور غير متطابقة يرجى التأكد منها',
            'terms_conditions.accepted' => 'يجب الموافقة على الشروط و الأحكام',

        ];

    }
}
