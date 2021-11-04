<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/roomssearch', [App\Http\Controllers\HomeController::class, 'searchRooms'])->name('searchRooms');

Route::post('/getprice', [App\Http\Controllers\HomeController::class, 'getPrice'])->name('getPrice');

Route::post('/badges', [App\Http\Controllers\HomeController::class, 'badges'])->name('badges');

Route::get('/activities', [App\Http\Controllers\HomeController::class, 'activities'])->name('activities');

Route::post('/signin', [App\Http\Controllers\HomeController::class, 'signIn']);

Route::post('/signup', [App\Http\Controllers\HomeController::class, 'signUp']);

Route::get('/homesetting', [App\Http\Controllers\HomeController::class, 'homePageSetting']);



Route::post('/roomdetails', [App\Http\Controllers\HomeController::class, 'RoomDetail']);
Route::post('/packagedetails', [App\Http\Controllers\HomeController::class, 'PackageDetail']);

Route::post('/coupon', [App\Http\Controllers\HomeController::class, 'getCoupon']);



Route::get('/getminprice', [App\Http\Controllers\HomeController::class, 'getMinPrice']);

Route::post('/tax', [App\Http\Controllers\HomeController::class, 'getTax']);

Route::get('/getservices', [App\Http\Controllers\HomeController::class, 'getServices']);
Route::get('/getpolicy', [App\Http\Controllers\HomeController::class, 'getPolicy']);

Route::post('/bookinginfo', [App\Http\Controllers\HomeController::class, 'bookingInfo']);
Route::post('/getbooking', [App\Http\Controllers\HomeController::class, 'getBooking']);

Route::post('/enable', [App\Http\Controllers\HomeController::class, 'enable']);







