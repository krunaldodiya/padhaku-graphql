<?php

namespace App\Http\Controllers;

use Error;

use App\Category;
use App\Quiz;
use App\Repositories\Contracts\QuizRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::get();

        return $categories;
    }

    public function test(Request $request, QuizRepositoryInterface $quizRepo)
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

        if ($request->type === "verify") {
            $verify = verifychecksum_e($data, env('PAYTM_MERCHANT_KEY'), $request->checksum_verify);
            return compact('verify');
        }

        $generate = getChecksumFromArray($data, env('PAYTM_MERCHANT_KEY'));
        return compact('generate');
    }
}
