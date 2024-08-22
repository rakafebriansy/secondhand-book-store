<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->group(function() {
    Route::get('/',[App\Http\Controllers\Admin\AuthController::class,'login'])->middleware('guest:admin,web');
    Route::post('/',[App\Http\Controllers\Admin\AuthController::class,'doLogin']);
    Route::get('/product',[App\Http\Controllers\Admin\ProductController::class,'index']);
    Route::post('/product',[App\Http\Controllers\Admin\ProductController::class,'store']);
    Route::patch('/product',[App\Http\Controllers\Admin\ProductController::class,'update']);
    Route::delete('/product',[App\Http\Controllers\Admin\ProductController::class,'delete']);
});
