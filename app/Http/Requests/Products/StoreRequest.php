<?php

namespace App\Http\Requests\Products;

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
            'name'                => 'required|string',
            'description'         => 'string',
            'product_category_id' => 'required|exists:product_categories,id'
        ];
    }
}