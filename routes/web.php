<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/paytm/order/create', 'PaytmController@createOrder')->name('paytm-create-order');
Route::post('/paytm/order/process', 'PaytmController@processOrder')->name('paytm-process-order');
Route::get('/paytm/order/{status}', 'PaytmController@orderStatus')->name('paytm-order-status');

Route::get('/categories', 'TestController@categories');

Route::get('/test', 'TestController@test');

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/download', function (Request $request) {
    $url = "https://api.msg91.com/api/v2/sendsms";

    $data = [
        'sender' => "SOCIAL",
        'route' => "1",
        'country' => "0",
        "sms" => [
            [
                "message" => "Sending of personalized and customized information",
                "to" => [$request->query("mobile")]
            ]
        ]
    ];

    $client = new \GuzzleHttp\Client();

    $request = $client->post($url, [
        'json' => $data,
        'headers' => [
            "authkey" => env("MSG91_KEY"),
            'content-type' => 'application/json',
            'Accept' => 'application/json'
        ]
    ]);

    $body = json_decode($request->getBody());

    dd($body);
});
