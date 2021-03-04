<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
            'color' => 'required|max:100|min:1',
        ];
    }

    public function messages()
    {
        return[
            'color.required' => 'يرجى ادخال اسم اللون',
            'color.max' => 'يجب ان لا يتجاوز الاسم عن 100 حرف ',
            'color.min' => 'يجب ادخال حرف واحد على الاقل من اسم اللون ',
        ];

    }
}
