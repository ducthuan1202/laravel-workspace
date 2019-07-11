<?php

Route::namespace('Backend')->group(function () {

    # route login, logout backend
    Route::namespace('Auth')->group(function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout')->middleware('auth:admin');
    });

    # route cần xác minh (login)
    Route::middleware('auth:admin')->group(function () {

        Route::get('/', 'HomeController@index')->name('home.index');
        Route::get('eloquent', 'HomeController@eloquent')->name('home.eloquent');
        Route::get('logs', 'LogController@index')->name('logs.index');

        Route::resources([
            'categories' => 'CategoryController',
        ]);

        # group route `products`
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', 'ProductController@index')->name('index');
            Route::get('get-data', 'ProductController@getData')->name('get_data');
            Route::get('create', 'ProductController@openForm')->name('open_form');
            Route::post('store', 'ProductController@saveForm')->name('save_form');
            Route::delete('destroy', 'ProductController@destroy')->name('destroy');
        });

    });

});
