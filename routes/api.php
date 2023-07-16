<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\CustomerController;

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

Route::resource('events', EventController::class)->only([
    'index'
]);

Route::resource('event', EventController::class)->only([
    'show'
]);

Route::resource('customers', CustomerController::class)->only([
    'index'
]);

Route::resource('orders', CustomerController::class)->only([
    'show'
]);

Route::resource('purchase', CustomerController::class)->only([
    'update'
]);

