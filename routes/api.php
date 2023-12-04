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
Route::middleware(['check.installer'])->group(function () {

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index']);
Route::post('/tasks/create', [\App\Http\Controllers\TaskController::class, 'store']);
Route::get('/tasks/{id}', [\App\Http\Controllers\TaskController::class, 'show']);
Route::post('/tasks/{id}/update', [\App\Http\Controllers\TaskController::class, 'update']);
Route::delete('/tasks/{id}/delete', [\App\Http\Controllers\TaskController::class, 'destroy']);

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']);
Route::get('/products/{id}/detail', [\App\Http\Controllers\ProductController::class, 'detail']);

Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/category/search', [\App\Http\Controllers\CategoryController::class, 'search']);
Route::post('/category/create', [\App\Http\Controllers\CategoryController::class, 'create']);

Route::get('/comment', [\App\Http\Controllers\CommentController::class, 'index']);
Route::get('/comment/latest', [\App\Http\Controllers\CommentController::class, 'latest']);
Route::get('/comment/{id}/list', [\App\Http\Controllers\CommentController::class, 'list']);

Route::get('/site-category', [\App\Http\Controllers\SiteCategoryController::class, 'index']);

Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index']);
Route::get('/blog/{id}/view', [\App\Http\Controllers\BlogController::class, 'view']);

Route::get('/crypto', [\App\Http\Controllers\CryptoController::class, 'index']);
Route::get('/crypto/cptickers', [\App\Http\Controllers\CryptoController::class, 'getCPTickers']);

Route::post('/payment/stripejs/capture', [\App\Http\Controllers\PaymentController::class, 'stripeJsCapture']);
Route::post('/payment/stripejs/payment-intent', [\App\Http\Controllers\PaymentController::class,
    'stripeJsPaymentIntent']);
