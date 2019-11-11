<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductImagesController extends Controller
{
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'image'      => 'required|image',
            'product_id' => 'required'
        ]);


        $image = ProductImage::firstOrNew($request->only('product_id'));

        $data['product_id'] = $request->product_id;
        $data['user_id']    = $request->user()->id;

        $path = $request->file('image')->store('products', [
            'disk' => 'public'
        ]);

        $data['path'] = $path;

        $image->fill($data)->save();

        return $image;
    }

    public function destroy(ProductImage $productImage)
    {
        \File::delete($productImage->fullpath);

        $productImage->delete();        
    }
}
