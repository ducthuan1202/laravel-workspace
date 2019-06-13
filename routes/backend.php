<?php

Route::namespace('Backend')->group(function () {

    Route::namespace('Auth')->group(function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout')->middleware('auth:admin');
    });

    Route::middleware('auth:admin')->group(function () {

        Route::get('/', 'HomeController@index')->name('home.index');

        Route::resources([
            'logs' => 'LogController',
            'categories' => 'CategoryController',
        ]);
    });

});
