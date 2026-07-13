<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\PurchaseImportController;
use App\Http\Controllers\Admin\ITCController;
use App\Console\Commands\ImportMembers;
Route::get('/api/sponsor-search', [RegisterController::class, 'sponsorSearch'])
    ->name('api.sponsor.search');

Route::get('/', function () {
    return redirect()->route('register');
});

Route::get('/register', [RegisterController::class, 'index'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

Route::get('/register/success', function () {
    return view('auth.register-success');
})->name('register.success');

Route::get('/login', [LoginController::class, 'index'])
    ->name('login');

Route::post('/login', [LoginController::class, 'store'])
    ->name('login.store');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Purchase Import
|--------------------------------------------------------------------------
*/

Route::get('/admin/purchase/import', [PurchaseImportController::class, 'index'])
    ->name('purchase.import');

Route::post('/admin/purchase/import', [PurchaseImportController::class, 'import'])
    ->name('purchase.import.store');

/*
|--------------------------------------------------------------------------
| ITC Management
|--------------------------------------------------------------------------
*/

Route::get('/admin/itc', [ITCController::class, 'index'])
    ->name('itc.index');

Route::get('/admin/itc/{smart_id}', [ITCController::class, 'show'])
    ->name('itc.show');

Route::get('/admin/import-members', function () {

    $command = new ImportMembers();

    return $command->handle();

});