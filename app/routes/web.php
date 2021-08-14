<?php

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

Route::get('/', [Modules\Core\Http\Controllers\CoreController::class, 'index'])->name('index');

// Imprint
Route::get('/imprint', [Modules\Core\Http\Controllers\CoreController::class, 'imprint'])->name('imprint');

// Privacy Policy
Route::get('/privacy-policy', [Modules\Core\Http\Controllers\CoreController::class, 'privacyPolicy'])->name('privacyPolicy');

// Donations
Route::get('/donations', [Modules\Core\Http\Controllers\CoreController::class, 'donations'])->name('donations');

// Info
Route::get('/info', [Modules\Core\Http\Controllers\CoreController::class, 'info'])->name('info');
