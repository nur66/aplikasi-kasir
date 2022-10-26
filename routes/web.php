<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiPembelianBarangController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.master');
// });

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('register');
// });

Route::get('/forgot-password', function () {
    return view('forgot-password');
});

Route::get('/not-found', function () {
    return view('not_found');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Product
// Show
Route::get('/show-all-product', [BarangController::class, 'read']);

// Add
Route::get('/add-product', [BarangController::class, 'add']);
Route::post('/store-product', [BarangController::class, 'store']);

// Serch
Route::get('/show-all-product/search', [BarangController::class, 'search'])->name('serch');

// Edit
Route::get('/edit-product/{id}', [BarangController::class, 'edit']);
Route::post('/edit-product', [BarangController::class, 'editStore'])->name('edit');

// Delete
Route::get('/delete-product/{id}', [BarangController::class, 'delete']);


// Transaksi
Route::get('/transaction', [TransaksiPembelianBarangController::class, 'show'])->name('transaction');
Route::post('/store-transaction', [TransaksiPembelianBarangController::class, 'store'])->name('store-transaction');

// show transaction
Route::get('/show-transaction', [TransaksiPembelianBarangController::class, 'showTransaction'])->name('transaction');

Route::post('/store-transaction-inv', [TransaksiPembelianBarangController::class, 'storeInvoice'])->name('invoice');


