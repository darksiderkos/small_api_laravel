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

//Route::get('/', 'ProductController@index');


Route::group(['prefix' => '/api'], function () {

    //Categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@index'); //- получить список категорий
        Route::get('/{id}', 'CategoryController@show')->where('id', '[0-9]+'); //- получить список категорий
        Route::get('/{categoryId}/products', 'ProductController@index')->where('categoryId', '[0-9]+');//- получить категорию со списком товаров (пагинация)
//        Route::post('/', 'CategoryController@create');
//        Route::put('/{categoryId}', 'CategoryController@update');
//        Route::delete('/{categoryId}', 'CategoryController@delete');
    });

    //Products
    Route::group(['prefix' => 'products'], function () {
<<<<<<< HEAD
        Route::get('/{productId}', 'ProductController@show')->where('id', '[0-9]+'); // - получить товар с свойствами
=======
        Route::get('/{productId}', 'ProductController@show'); // - получить товар с свойствами

>>>>>>> 8586fc4d7955c999900653b2a5dc471c40c62915
    });


//    Route::post('/categories/{categoryId}/products', 'ProductController@create');
//    Route::put('/categories/{categoryId}/products/{productId}', 'ProductController@update');


});
