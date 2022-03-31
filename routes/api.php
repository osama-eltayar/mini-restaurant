<?php

use App\Http\Controllers\Api\AvailableTableController;
use App\Http\Controllers\Api\MealController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ReservationController;
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

Route::resource('meals', MealController::class)->only('index');
Route::resource('reservations', ReservationController::class)->only('store');
Route::resource('orders', OrderController::class)->only('store');
Route::get('available-tables', AvailableTableController::class);
