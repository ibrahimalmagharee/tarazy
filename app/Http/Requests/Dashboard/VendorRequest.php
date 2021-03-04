<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'company_name' => 'required|max:150|min:1',
            'location' => 'required|max:150|min:1',
            'commercial_registration_No' => 'required|numeric|digits_between:1,50',
            'mobile_No' => 'required|numeric|digits:10|unique:vendors,mobile_No,'. $this -> id,
            'national_Id' => 'required|numeric|digits_between:5,20|unique:vendors,national_Id,'. $this -> id,
            'email' => 'required|email|max:100|unique:vendors,email,'. $this -> id,
            'type_activity' => 'required|max:20|min:1',
            'password' => 'required|confirmed|digits_between:4,6',
        ];
    }

    public function messages()
    {
        return[
            'company_name.required' => 'يرجى ادخال اسم الشركة',
            'company_name.max' => 'يجب ان لا يتجاوز اسم الشركة عن 150 حرف ',
            'company_name.min' => 'يجب ادخال حرف واحد على الاقل من اسم الشركة ',
            'location.required' => 'يرجى ادخال موقع الشركة',
            'location.max' => 'يجب ان لا يتجاوز موقع الشركة عن 150 حرف ',
            'location.min' => 'يجب ادخال حرف واحد على الاقل من موقع الشركة ',
            'commercial_registration_No.required' => 'يرجى ادخال رقم السجل التجاري للشركة',
            'commercial_registration_No.digits_between' => 'يجب ان لا يتجاوز رقم السجل التجاري عن 50 رقم ولا يقل عن رقم واحد',
            'mobile_No.required' => 'يرجى ادخال رقم الجوال',
            'mobile_No.digits' => 'يجب ان يكون رقم الجوال 10 أرقام ',
            'mobile_No.unique' => 'هذا الرقم مسجل باسم تاجر من قبل',
            'national_Id.required' => 'يرجى ادخال رقم الهوية',
            'national_Id.digits_between' => 'يجب ان لا يتجاوز رقم الهوية عن 20 رقم ولا يقل عن 5 ارقام ',
            'national_Id.unique' => 'هذا الرقم مسجل باسم تاجر من قبل',
            'email.required' => 'يرجى ادخال البريد الالكتروني',
            'email.email' => 'يرجى التحقق من صيعة البريد الالكتروني المدخل',
            'email.unique' => 'هذا الايميل موجود من قبل يرجى التحقق من البريد الالكتروني االمدخل',
            'type_activity.required' => 'يرجى اختيار نوع النشاظ التجاري',
            'type_activity.max' => 'يجب ان لا يزيد نوع النشاط عن 20 حرف',
            'password.required' => 'يرجى ادخال كلمة المرور',
            'password.digits_between' => 'كلمة المرور يجب ان لا تقل عن 4 أحرف ولا تزيد عن 6 احرف',
            'password.confirmed' => 'كلمة المرور غير متطابقة يرجى التأكد منها',
        ];

    }
}
