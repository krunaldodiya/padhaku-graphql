<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaytmController extends Controller
{
    public function generateChecksum(Request $request)
    {
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

        $generate = getChecksumFromArray($data, env('PAYTM_MERCHANT_KEY'));
        return compact('generate');
    }

    public function verifyChecksum(Request $request)
    {
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

        $verify = verifychecksum_e($data, env('PAYTM_MERCHANT_KEY'), $request->checksum_verify);
        return compact('verify');
    }
}
