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
        Route::get('products/get-data', 'ProductController@getData')->name('products.get_data');

        Route::resources([
            'logs' => 'LogController',
            'categories' => 'CategoryController',
            'products' => 'ProductController',
        ]);

    });

});
