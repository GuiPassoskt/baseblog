<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $posts = Post::take(3)->latest('id')->get();
        $products = Product::take(4)->latest('id')->get();

        return view('pages.index', compact('posts','products'));
    }

    public function products()
    {   

        $products = Product::paginate();
        
        return view('pages.products', compact('products'));
    }

    public function product(Product $product)
    {
        
    }
}
