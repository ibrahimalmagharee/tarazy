<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FabricRequest extends FormRequest
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
            'name' => 'required|max:100',
            'color_id' => 'required|numeric|exists:colors,id',
            'category_id' => 'required|numeric|exists:categories,id',
            'description' => 'required|max:1000',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'price' => 'required|numeric',
            'offer_id' => 'required|numeric|exists:offers,id',
            'vendor_id' => 'required|numeric|exists:vendors,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يرجى ادخال اسم المنتج',
            'name.max' => 'يجب ان لا يتجاوز اسم المنتج عن 100 حرف',
            'color_id.required' => 'يجب اختيار لون المنتج',
            'color_id.exist' => 'هذا اللون غير موجود',
            'color_id.numeric' => 'يجب ان تكون قيمة اللون رقم',
            'category_id.required' => 'يجب اختيار قمسم للمنتج',
            'category_id.exist' => 'هذا القسم غير موجود',
            'category_id.numeric' => 'يجب ان تكون قيمة القسم رقم',
            'description.required' => 'يجب ادخال وصف للمنتج',
            'description.max' => 'يجب ان لا يتجاوز وصف المنتج عن 1000 كلمة',
            'photo.required_without' => 'يجب ادخال صورة المنتج',
            'photo.mimes' => 'يجب ان تكون الصورة تحت صيغة jpg,jpeg,png',
            'price.required' => 'يحب ادخال سعر المنتج',
            'price.numeric' => 'يجب ان يكون السعر رقم',
            'offer_id.required' => 'يجب اختيار العرض للمنتج',
            'offer_id.exist' => 'هذا العرض غير موجود',
            'offer_id.numeric' => 'يجب ان تكون قيممة العرض رقم',
            'vendor_id.required' => 'يجب اختيار التاجر لهذا المنتج',
            'vendor_id.exist' => 'هذا التاجر غير موجود',
            'vendor_id.numeric' => 'يجب ان تكون القيمة رقم',
        ];
    }
}
