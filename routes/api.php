<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CoordinateController;
use \App\Http\Controllers\BusController;
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

Route::group(['prefix'=> 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('admin', [AuthController::class, 'adminLogin']);
});

Route::group(['prefix'=> 'bus'], function () {
    Route::get('index', [BusController::class, 'index']);
    Route::get('show/{id}', [BusController::class, 'show']);
    Route::get('all', [BusController::class, 'busesWithTheyPaths']);
});

Route::group(['prefix'=> 'coordinate'], function () {
    Route::get('show/{id}/{comingback}', [CoordinateController::class, 'show']);
});
