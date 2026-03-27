<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PKBMController;
use App\Http\Controllers\LKPController;
use App\Http\Controllers\PAUDController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('home')
        : redirect()->route('login');
});

Auth::routes(['register' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('pkbm', PKBMController::class);

Route::resource('lkp', LKPController::class);

Route::resource('paud', PAUDController::class);

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/izin', [LaporanController::class, 'izin'])->name('laporan.izin');
Route::get('/laporan/expired', [LaporanController::class, 'expired'])->name('laporan.expired');