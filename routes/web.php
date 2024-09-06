<?php

use App\Http\Controllers\ProductFetchController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [RegistrationController::class, 'create'])->name('register');


Route::post('/store', [RegistrationController::class, 'store'])->name('user.store');
Route::get('/index', [RegistrationController::class, 'index'])->name('user.index');
Route::get('/edit/{id}', [RegistrationController::class, 'edit'])->name('user.edit');
Route::post('/update/{id}', [RegistrationController::class, 'update'])->name('user.update');
Route::delete('/delete/{id}', [RegistrationController::class, 'destroy'])->name('user.delete');


Route::get('/product-fetch', [ProductFetchController::class, 'index'])->name('product-fetch');
Route::get('/product-create', [ProductFetchController::class, 'create'])->name('product-create');
