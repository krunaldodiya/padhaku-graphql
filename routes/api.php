<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/checksum', function (Request $request) {
    $data = [
        "MID" => $request->get('MID'),
        "ORDER_ID" => $request->get('ORDER_ID'),
        "CALLBACK_URL" => $request->get('CALLBACK_URL'),
        "CHANNEL_ID" => $request->get('CHANNEL_ID'),
        "CUST_ID" => $request->get('CUST_ID'),
        "INDUSTRY_TYPE_ID" => $request->get('INDUSTRY_TYPE_ID'),
        "TXN_AMOUNT" => $request->get('TXN_AMOUNT'),
        "MOBILE_NO" => $request->get('MOBILE_NO'),
        "EMAIL" => $request->get('EMAIL'),
        "WEBSITE" => $request->get('WEBSITE'),
    ];

    return getChecksumFromArray($data, env('PAYTM_MERCHANT_KEY'));
});
