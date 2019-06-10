<?php

Route::namespace('Frontend')->group(function () {
    Route::get('/', 'HomeController@index')->name('home.index');
});
