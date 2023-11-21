<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index']);
Route::post('/tasks/create', [\App\Http\Controllers\TaskController::class, 'store']);
Route::get('/tasks/{id}', [\App\Http\Controllers\TaskController::class, 'show']);
Route::post('/tasks/{id}/update', [\App\Http\Controllers\TaskController::class, 'update']);
Route::delete('/tasks/{id}/delete', [\App\Http\Controllers\TaskController::class, 'destroy']);

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']);

Route::get('/crypto', [\App\Http\Controllers\CryptoController::class, 'index']);
Route::get('/crypto/cptickers', [\App\Http\Controllers\CryptoController::class, 'getCPTickers']);

Route::post('/payment/stripejs/capture', [\App\Http\Controllers\PaymentController::class, 'stripeJsCapture']);
