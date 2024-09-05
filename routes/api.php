<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::post('/store/product', [ProductController::class, 'store'])->name('store.product');
Route::get('/product/{id}', [ProductController::class, 'edit'])->name('edit.product');
Route::post('/product/{id}', [ProductController::class, 'update'])->name('update.product');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('delete.product');