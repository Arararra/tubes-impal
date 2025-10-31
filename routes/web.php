<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\GeneralController;

Route::get('/', [GeneralController::class, 'home'])->name('home');
Route::get('/catalog', [GeneralController::class, 'catalog'])->name('catalog');
Route::get('/checkout', [GeneralController::class, 'checkout'])->name('checkout');
Route::get('/{slug?}', [GeneralController::class, 'single'])->name('single');
