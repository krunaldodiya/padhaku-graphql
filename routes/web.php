<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/paytm-order', 'TestController@paytmOrder')->name('paytm-order');
Route::get('/paytm-status', 'TestController@paytmStatus')->name('paytm-status');

Route::get('/categories', 'TestController@categories');
