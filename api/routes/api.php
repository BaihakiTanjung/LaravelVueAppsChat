<?php

use App\Events\Hello;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\sendMessageEvent;
use App\Http\Controllers\MessageController;

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

Route::get('/test', function () {
    broadcast(new Hello());
});

Route::get('/getMessage', [MessageController::class, 'fetchMessages']);
Route::post('/sendMessage', [MessageController::class, 'sendMessage']);
