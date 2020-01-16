<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaytmController extends Controller
{
    public function parseChecksumOptions($data)
    {
        return [
            "MID" => $data['MID'],
            "ORDER_ID" => $data['ORDER_ID'],
            "CALLBACK_URL" => $data['CALLBACK_URL'],
            "CHANNEL_ID" => $data['CHANNEL_ID'],
            "CUST_ID" => $data['CUST_ID'],
            "INDUSTRY_TYPE_ID" => $data['INDUSTRY_TYPE_ID'],
            "TXN_AMOUNT" => $data['TXN_AMOUNT'],
            "MOBILE_NO" => $data['MOBILE_NO'],
            "EMAIL" => $data['EMAIL'],
            "WEBSITE" => $data['WEBSITE'],
        ];
    }

    public function generateChecksum(Request $request)
    {
        $data = $this->parseChecksumOptions($request->all());
        $generate = getChecksumFromArray($data, env('PAYTM_MERCHANT_KEY'));

        return compact('generate');
    }

    public function verifyChecksum(Request $request)
    {
        $data = $this->parseChecksumOptions($request->all());
        $verify = verifychecksum_e($data, env('PAYTM_MERCHANT_KEY'), $request->checksum_verify);

        return compact('verify');
    }
}
