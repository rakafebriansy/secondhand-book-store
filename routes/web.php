<?php

use App\Http\Controllers\User\ShoppingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ShoppingController::class, 'index']);
Route::get('/register',[App\Http\Controllers\User\AuthController::class,'register']);
Route::post('/register',[App\Http\Controllers\User\AuthController::class,'doRegister']);
Route::get('/login',[App\Http\Controllers\User\AuthController::class,'login']);
Route::post('/login',[App\Http\Controllers\User\AuthController::class,'doLogin']);
Route::middleware('auth:web')->group(function() {
    Route::post('/checkout', [ShoppingController::class, 'doCheckout']);
    Route::get('/order-confirmation', [ShoppingController::class, 'confirmOrder']);
});

Route::prefix('/admin')->group(function() {
    Route::get('/',[App\Http\Controllers\Admin\AuthController::class,'login'])->middleware('guest:admin,web');
    Route::post('/',[App\Http\Controllers\Admin\AuthController::class,'doLogin']);
    Route::middleware('auth:admin')->group(function() {
        Route::get('/product',[App\Http\Controllers\Admin\ProductController::class,'index']);
        Route::post('/product',[App\Http\Controllers\Admin\ProductController::class,'store']);
        Route::patch('/product',[App\Http\Controllers\Admin\ProductController::class,'update']);
        Route::delete('/product',[App\Http\Controllers\Admin\ProductController::class,'delete']);
        Route::get('/logout',[App\Http\Controllers\Admin\AuthController::class,'logout']);
    });
});
