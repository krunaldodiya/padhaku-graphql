<?php

use App\Http\Controllers\PaytmController;
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

Route::middleware('auth:api')->post('/generate-checksum', 'PaytmController@generateChecksum');
Route::middleware('auth:api')->post('/verify-checksum', 'PaytmController@verifyChecksum');
Route::middleware('auth:api')->post('/upload', 'UserController@upload');

Route::get('/invite/{sender_id}/{mobile}', 'UserController@checkInvitation');
Route::get('/rate', 'UserController@rate');
Route::post('/quizzes', 'QuizController@quizzes');
