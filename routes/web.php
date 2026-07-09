<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\PurchaseImportController;

Route::get('/api/sponsor-search', [RegisterController::class, 'sponsorSearch'])
    ->name('api.sponsor.search');

Route::get('/', function () {
    return redirect()->route('register');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/admin/purchase/import', [PurchaseImportController::class, 'index'])
    ->name('purchase.import');

Route::post('/admin/purchase/import', [PurchaseImportController::class, 'import'])
    ->name('purchase.import.store');