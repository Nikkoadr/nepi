<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PKBMController;
use App\Http\Controllers\LKPController;
use App\Http\Controllers\PAUDController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotifikasiController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('home')
        : redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('pkbm', PKBMController::class);

Route::resource('lkp', LKPController::class);

Route::resource('paud', PAUDController::class);

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');

Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
Route::get('/notifikasi/{id}', [NotifikasiController::class, 'show'])->name('notifikasi.show');