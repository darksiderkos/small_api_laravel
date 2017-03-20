<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ProductController@index');


Route::group(['prefix' => '/api'], function () {

    //Categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@index');
//        Route::post('/', 'CategoryController@create');
//        Route::put('/{categoryId}', 'CategoryController@update');
//        Route::delete('/{categoryId}', 'CategoryController@delete');
    });

    //Products
    Route::group(['prefix'=>'products'], function(){
        Route::get('/{productId}', 'ProductController@show');

    });

    Route::get('/categories/{categoryId}/products', 'ProductController@index');
    Route::get('/categories/{categoryId}/products/{productId}', 'ProductController@show');
//    Route::post('/categories/{categoryId}/products', 'ProductController@create');
//    Route::put('/categories/{categoryId}/products/{productId}', 'ProductController@update');


});
