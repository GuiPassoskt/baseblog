<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('users/login', 'Api\UsersController@login');

Route::middleware('auth:api')->group(function () {
    
    Route::post('product-images', 'Api\ProductImagesController@update');

    Route::post('posts/{post}/upload-cover-image', 'Api\PostsController@uploadCoverImage');

    Route::get('files', 'Api\FilesController@index');

    Route::post('files/upload', 'Api\FilesController@upload');

    Route::resource('posts',  'Api\PostsController', [
        'except' => ['index', 'show']
    ]);

    Route::resource('products', 'Api\ProductsController', [
        'except' => ['index', 'show']
    ]);

    Route::resource('product-categories', 'Api\ProductCategoriesController', [
        'except' => ['index', 'show'],
        'parameters' => [
            'product-categories' => 'productCategory'
        ]
    ]);

    Route::post('product-categories/{productCategory}/upload-image', 'Api\ProductCategoriesController@uploadImage');
});

Route::resource('posts',  'Api\PostsController', [
    'only' => ['index', 'show']
]);

Route::resource('products', 'Api\ProductsController', [
    'only' => ['index', 'show']
]);

Route::resource('product-categories', 'Api\ProductCategoriesController', [
    'only' => ['index', 'show']
]);


Route::get('posts/by-slug/{slug}', 'Api\PostsController@bySlug');