<?php

use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UseController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\ApiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/addToCart',[TransactionController::class,'addToCart'])->name('addToCart');//
Route::post('/payNow',[TransactionController::class,'payNow'])->name('payNow');//
Route::post('/topUpNow',[WalletController::class,'topUpNow'])->name('topUpNow');//
Route::post('/request_topup',[WalletController::class,'request_topup'])->name('request_topup');//
Route::get('/download{order_id}',[TransactionController::class,'download'])->name('download');//
Route::post('/product/store',[ProductController::class,'store'])->name('product.store');//
Route::get('/product/index',[ProductController::class,'index'])->name('product.index');//
Route::delete('/product/destroy/{id}',[ProductController::class,'destroy'])->name('product.destroy');//
Route::put('/product/update/{id}',[ProductController::class,'update'])->name('product.update');//
Route::delete('/DeleteCart/{id}',[TransactionController::class,'DeleteCart'])->name('DeleteCart');
Route::post('/transaction/{id}',[TransactionController::class,'take'])->name('transaction.take');
Route::resource('/user', UseController::class);
// Route::get('/', [ApiController::class, 'index']);