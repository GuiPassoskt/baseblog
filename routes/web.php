<?php

use App\Models\Post;


Route::get('/', 'PagesController@home');
Route::get('/sobre', 'PagesController@about');
Route::get('/produtos', 'PagesController@products');
Route::get('/produto/{product}/{slug?}', 'PagesController@product')->name('page_product');

Route::get('blog/{slug}', function ($slug) {

    $post = Post::where(compact('slug'))->firstOrFail();

    return view('blog', compact('post'));
})
->name('blog');

Route::get('admin/{any?}', function () {
    return view('admin');
})
->where('any', '.*');


