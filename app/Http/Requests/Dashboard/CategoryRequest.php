<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Enumeration\CategoryType;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'type' => 'required|in:'. CategoryType::mainCategory . ',' . CategoryType::subCategory,
            'parent_id' => 'sometimes|nullable|numeric',
        ];


    }

    public function messages()
    {
        return [
            'name.required' => 'يرجى ادخال اسم القسم',
            'name.max' => 'يجب ان لا يتجاوز اسم القسم عن 100 حرف',
            'parent_id.required' => 'يجب اختيار القسم الرئيسي للقسم الفرعي',
            'parent_id.exist' => 'هذا القسم غير موجود',

        ];

    }
}
