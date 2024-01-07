<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LogCaptureController;
use App\Http\Controllers\LogLockController;
use App\Http\Controllers\LogRfidController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::resource('log-capture', LogCaptureController::class);
Route::resource('log-lock', LogLockController::class);
Route::resource('log-rfid', LogRfidController::class);

