<?php

namespace App\Http\Requests\ProductCategories;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => ['required', 'max:255', 'unique' => 'unique:product_categories,name'],
            //'image' => ['required' => 'required', 'image']
        ];
    }
}
