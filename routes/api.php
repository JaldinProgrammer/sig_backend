<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CoordinateController;
use \App\Http\Controllers\BusController;
use \App\Http\Controllers\VehicleController;
use \App\Http\Controllers\DriverController;
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


Route::group(['prefix'=> 'vehicles'], function () {
    Route::get('show/{id}', [VehicleController::class, 'show']);
    Route::get('all', [VehicleController::class, 'all']);
});

Route::group(['prefix'=> 'drivers'], function () {
    Route::get('ocupar-vehiculo/{user}/{vehicle}', [DriverController::class, 'ocupar']);
    Route::get('liberar-vehiculo/{user}/{vehicle}', [DriverController::class, 'liberar']);
});
