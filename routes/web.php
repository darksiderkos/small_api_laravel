<?php

Route::group(['prefix' => '/api', 'middleware' => 'jwt.auth'], function () {
    Route::post('/login', 'AuthController@login');

    //Categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@index'); //- получить список категорий
        Route::get('/{id}', 'CategoryController@show')->where('id', '[0-9]+'); //- получить список категорий
        Route::get('/{categoryId}/products', 'ProductController@index')->where('categoryId', '[0-9]+');//- получить категорию со списком товаров (пагинация)
        Route::post('/', 'CategoryController@create');
        Route::put('/{categoryId}', 'CategoryController@update')->where('categoryId', '[0-9]+');
        Route::delete('/{categoryId}', 'CategoryController@delete');
    });

    //Products
    Route::group(['prefix' => 'products'], function () {
        Route::get('/{productId}', 'ProductController@show')->where('id', '[0-9]+');
        Route::put('/{productId}', 'ProductController@update')->where('id', '[0-9]+');
        Route::post('/', 'ProductController@create')->where('id', '[0-9]+');
    });

    Route::middleware('jwt.refresh')->get('/token', function () {
    });
});
