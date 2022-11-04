<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\LoginController;
use App\Models\Product;
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

Route::get('/', [FrontEndController::class,'index']);



Route::get('/coba_controller', [App\Http\Controllers\CobaController::class, 'index']);

Route::get('/admin/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');

Route::post('/admin/products/store', [ProductController::class, 'store'])->name('products.store');

Route::delete('/admin/products/{id}', [ProductController::class, 'delete'])->name('products.delete');

Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('products.update');


Route::get('/admin/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');

Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');

Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('categories.store');

Route::delete('/admin/categories/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

Route::get('/login',[LoginController::class, 'index'])->name('login');

Route::post('/login',[LoginController::class,'authenticate'])->name('login.post');
