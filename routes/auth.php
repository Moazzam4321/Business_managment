<?php

use App\Http\Controllers\AuthController;
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



Route::post('/SignUp', [AuthController::class,'signUp'])->name('sign_up');
Route::post('/verify/account', [AuthController::class,'verifyAccount']);
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/forgot/password', [AuthController::class,'forgotPassword'])->name('forgot_password');
Route::post('/reset/password', [AuthController::class,'resetPassword']);