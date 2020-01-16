<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'TestController@test');
Route::get('/paytm/order', 'PaytmController@createOrder')->name('paytm-order');
Route::post('/paytm/status', 'PaytmController@checkStatus')->name('paytm-status');

Route::get('/categories', 'TestController@categories');
