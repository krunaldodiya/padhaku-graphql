<?php

use App\Refer;
use App\ReferSource;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

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

Route::get('/refer', function (Request $request) {
    if ($request->has('utm_id')) {
        $request->session()->put('utm_id', $request->get('utm_id'));
    }

    return redirect("https://www.sawalbemisaal.com");
});

Route::get('/download/app', function (Request $request) {
    $direct = ReferSource::first();

    $refer_source_id = $request->session()->has('utm_id') &&
        ReferSource::find($request->session()->get('utm_id')) ? $request->session()->get('utm_id') :
        $direct->id;

    $agent = new Agent();

    $data = [
        'refer_source_id' => $refer_source_id,
        'ip_address' => $request->ip(),
        'languages' => json_encode($agent->languages()),
        'device' => $agent->device(),
        'platform' => $agent->platform(),
        'platform_version' => $agent->version($agent->platform()),
        'browser' => $agent->browser(),
        'browser_version' => $agent->version($agent->browser()),
        'robot' => $agent->robot(),
    ];

    Refer::create($data);

    $file_name = "sawal-bemisaal.apk";

    $path = storage_path("app/public/apps/$file_name");

    $headers = [
        "Content-Type" => "application/vnd.android.package-archive",
        "Content-Disposition" => "attachment; filename='$file_name'",
    ];

    return response()->download($path, "$file_name", $headers);
});

Route::get('/download/start', function (Request $request) {
    return view('download');
});

Route::get('/download', function (Request $request) {
    if (!$request->query("mobile")) {
        throw new Error("No mobile provided");
    }

    $url = "https://api.msg91.com/api/v2/sendsms";

    $data = [
        'sender' => "SOCIAL",
        'route' => "1",
        'country' => "91",
        "sms" => [
            [
                "message" => "Get the Sawal Bemisaal app and enjoy Quizzing on the go! \n Learn & Earn ! Click https://bit.ly/SawalBemisaal to download now!",
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

    return $request->getBody();
});
