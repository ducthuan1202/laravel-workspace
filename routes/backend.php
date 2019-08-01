<?php

Route::namespace('Backend')->group(function () {

    # route login, logout backend
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login')->name('check_login');
        Route::post('/logout', 'LoginController@logout')->name('logout')->middleware('auth:admin');
    });

    # route cần xác minh (login)
    Route::middleware(['auth:admin', 'check.permissions'])->group(function () {

        Route::get('/', 'HomeController@index')->name('home.index');
        Route::get('/eloquent', 'HomeController@eloquent')->name('home.eloquent');
        Route::get('/logs', 'LogController@index')->name('logs.index');
        Route::get('/permissions', 'HomeController@permissions')->name('home.permissions');

        Route::resources([
            'categories' => 'CategoryController',
        ]);

        # group route `products`
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', 'ProductController@index')->name('index');
            Route::get('/get-data', 'ProductController@getData')->name('get_data');
            Route::get('/create', 'ProductController@openForm')->name('open_form');
            Route::post('/store', 'ProductController@saveForm')->name('save_form');
            Route::delete('/destroy', 'ProductController@destroy')->name('destroy');
        });

        # group route `products`
        Route::prefix('roles')->name('roles.')->group(function () {
            # Phần route cho roles
            Route::get('/', 'RoleController@index')->name('index');
            Route::get('/get-data', 'RoleController@getData')->name('get_data');
            Route::get('/open-form', 'RoleController@openForm')->name('open_form');
            Route::post('/save-form', 'RoleController@saveForm')->name('save_form');
            Route::get('/choose-permissions', 'RoleController@choosePermissions')->name('choose_permissions');
            Route::post('/save-permissions', 'RoleController@savePermissions')->name('save_permissions');
        });

    });

});
