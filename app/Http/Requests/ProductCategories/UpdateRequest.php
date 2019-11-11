<?php

namespace App\Http\Requests\ProductCategories;

class UpdateRequest extends StoreRequest
{
   
    public function rules()
    {
        $rules = parent::rules();

        //$rules['image']['required'] = 'nullable';
        $rules['name']['unique'] = 'unique:product_categories,name,' . $this->route('productCategory.id');

        return $rules;
    }
}
