<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use LaravelLegends\EloquentFilter\Filter;
use App\Http\Requests\ProductCategories\StoreRequest;
use App\Http\Requests\ProductCategories\UpdateRequest;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'contains.name' => 'nullable|string'
        ]);

        $query = Filter::fromModel(ProductCategory::class, $request);

        return $query->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return ProductCategory::create($request->all());
    }

    public function show(ProductCategory $productCategory)
    {
        return $productCategory;
    }

    public function update(UpdateRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->all());

        return $productCategory;
    }


    public function uploadImage(ProductCategory $productCategory, Request $request)
    {
        $this->validate($request, ['image' => 'required|image']);

        $image = $request->file('image')->store('categories', [
            'disk' => 'public'
        ]);

        $productCategory->update(compact('image'));

        return $productCategory;
    }
}
