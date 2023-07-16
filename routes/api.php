<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;

/**
 * Acá se definen las rutas a los endpoints y a que método de qué clase acceden.
 * Debería ser facil de entender cual corresponde a qué.
 */

Route::resource('events', EventController::class)->only([
    'index'
]);

Route::resource('event', EventController::class)->only([
    'show'
]);

Route::resource('orders', CustomerController::class)->only([
    'show'
]);

Route::resource('purchase', PurchaseController::class)->only([
    'store'
]);

