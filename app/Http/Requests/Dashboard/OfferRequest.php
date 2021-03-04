<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'يرجى ادخال العرض',
            'name.max' => 'يجب ان لا يتجاوز الاسم عن 100 حرف ',
            'name.min' => 'يجب ادخال حرف واحد على الاقل من اسم العرض ',
        ];

    }
}
