<?php

use App\Http\Controllers\admin\apis\ReportApiController;
use App\Http\Controllers\admin\OrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/monthly-meal-totals/{meal_id}', [ReportApiController::class, 'getMonthlyMealTotals']);
Route::get('/monthly-rating-meal/{meal_id}', [ReportApiController::class, 'getMonthlyRatingMeal']);
Route::get('/weekly-orders', [ReportApiController::class, 'weeklyOrders']);

Route::post('/add-to-cart', [OrderController::class, 'addToCart'])->name('admin.orders.cart');
