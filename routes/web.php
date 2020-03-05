<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'TestController@test');
Route::get('/paytm/order/create', 'PaytmController@createOrder')->name('paytm-create-order');
Route::post('/paytm/order/process', 'PaytmController@processOrder')->name('paytm-process-order');
Route::get('/paytm/order/{status}', 'PaytmController@orderStatus')->name('paytm-order-status');

Route::get('/categories', 'TestController@categories');

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/privacy', function () {
    return view('privacy');
});
