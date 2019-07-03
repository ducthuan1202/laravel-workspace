<?php

Route::namespace('Backend')->group(function () {

    Route::namespace('Auth')->group(function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout')->middleware('auth:admin');
    });

    Route::get('socket', 'HomeController@socket')->name('home.socket');
    Route::get('api', 'HomeController@api')->name('home.api');

    # route không cần xác minh (login)
    Route::get('categories/resource/{category}', 'CategoryController@resource')->name('home.resource');

    # route cần xác minh (login)
    Route::middleware('auth:admin')->group(function () {

        Route::get('/', 'HomeController@index')->name('home.index');

        Route::get('eloquent', 'HomeController@eloquent')->name('home.eloquent');
        Route::get('categories/list', 'CategoryController@list')->name('categories.list');
        Route::get('categories/get-data', 'CategoryController@getData')->name('categories.get_data');
        Route::get('products/get-data', 'ProductController@getData')->name('products.get_data');

        Route::resources([
            'logs' => 'LogController',
            'categories' => 'CategoryController',
            'products' => 'ProductController',
        ]);

    });

});
