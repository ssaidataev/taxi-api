<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\RideController;

Route::apiResource('drivers', DriverController::class);
Route::apiResource('rides', RideController::class);
//Route::post('/rides/{ride}/assign-driver/{driver}', [RideController::class, 'assignDriver']);
Route::post('/rides/{ride}/assign-driver/{driver}', [RideController::class, 'assignDriver'])
    ->where(['ride' => '[0-9]+', 'driver' => '[0-9]+']);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
