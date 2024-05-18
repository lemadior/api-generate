<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\RandomNumberController;
use App\Http\Controllers\AuthController;
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

Route::prefix('auth')->middleware('api')->group(function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::namespace('App\Http\Controllers\Api\V1')->group(function () {
    Route::get('/numbers/{id}', [RandomNumberController::class, 'retrieve'])->name('retrieve');

    Route::post('/numbers', [RandomNumberController::class, 'generate'])->middleware('jwt.auth')->name('generate');
});
