<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'getLogin'])->name('login');
Route::get('/register', [AuthController::class, 'getRegister']);
Route::post('/login', [AuthController::class, 'doLogin']);
Route::post('/register', [AuthController::class, 'doRegister']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/email/verify', [AuthController::class, 'verifyEmail'])->middleware('auth')->name('verification.notice');;
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'doVerifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');;
Route::get('/email/verification-notification', [AuthController::class, 'sendVerifyEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');;

Route::resource('/dashboard', TodoController::class)->middleware(['auth','verified']);