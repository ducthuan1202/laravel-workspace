<?php

Route::namespace('Backend')->group(function () {

    Route::get('/', 'HomeController@index')->name('home.index');

    Route::resources([
        'logs' => 'LogController',
        'categories' => 'CategoryController',
    ]);
});
