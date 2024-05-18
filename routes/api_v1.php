<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\RandomNumberController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::namespace('App\Http\Controllers\Api\V1')->group(function () {
    Route::get('/numbers/{id}', [RandomNumberController::class, 'retrieve'])->name('retrieve');
    Route::post('/numbers', [RandomNumberController::class, 'generate'])->name('generate');
});
