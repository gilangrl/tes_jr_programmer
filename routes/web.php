<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::resource('/produk', ProdukController::class);
Route::get('/produk/create', [ProdukController::class,'create']);
Route::post('/produk/store', [ProdukController::class,'store'])->name('produk.store');
Route::get('/produk/edit/{id}', [ProdukController::class,'edit']);
Route::put('/produk/update/{id}', [ProdukController::class,'update'])->name('produk.update');
Route::post('/produk/import', [ProdukController::class, 'importFromApi'])->name('produk.import');