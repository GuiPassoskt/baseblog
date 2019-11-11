<?php

namespace App\Http\Requests\ProductContent;

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
            'text'       => ['required', 'string'],
            'type'       => ['required', 'in:text,title,subtitle,list'],
            'product_id' => ['required', 'exists:products,id']
        ];
    }
}
