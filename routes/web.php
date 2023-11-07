<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UseController;
use App\Http\Controllers\WalletController;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/addToCart',[TransactionController::class,'addToCart'])->name('addToCart');//
Route::post('/payNow',[TransactionController::class,'payNow'])->name('payNow');//
Route::post('/topUpNow',[WalletController::class,'topUpNow'])->name('topUpNow');//
Route::post('/request_topup',[WalletController::class,'request_topup'])->name('request_topup');//
Route::get('/download{order_id}',[TransactionController::class,'download'])->name('download');//
Route::post('/product/store',[ProductController::class,'store'])->name('product.store');//
Route::delete('/product/destroy/{id}',[ProductController::class,'destroy'])->name('product.destroy');//
Route::put('/product/update/{id}',[ProductController::class,'update'])->name('product.update');//
Route::delete('/DeleteCart/{id}',[TransactionController::class,'DeleteCart'])->name('DeleteCart');
Route::post('/transaction/{id}',[TransactionController::class,'take'])->name('transaction.take');
Route::resource('/user', UseController::class);


