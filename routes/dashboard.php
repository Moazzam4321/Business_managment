<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "auth" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth.token')->group( function (){
Route::post('/update/profile', [DashboardController::class, 'update_profile']);
Route::post('/profile/view',[DashboardController::class,'get_user_data']);
Route::post('/add/item',[DashboardController::class,'add_item']);
Route::post('/update/item',[DashboardController::class,'update_item']);
});