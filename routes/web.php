<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.v4.index');
})->name('v4.portal');

// AUTHENTICATION ROUTES
use App\Http\Controllers\Auth\v4\AuthController;
use \App\Http\Controllers\Auth\v4\LoginController;

Route::group(['prefix' => 'v4', 'as' => ''], function () {
    Route::get('login', [LoginController::class, 'index'])->name('v4.login');
    Route::post('login', [AuthController::class, 'login'])->name('v4.login.process');
});

// PROTECTED ROUTES
use \App\Http\Controllers\v4\Dashboard\DashboardController;
use \App\Http\Controllers\v4\Setting\ProfilController;
use \App\Http\Controllers\v4\Akun\AksesJabatanController;

Route::group(['middleware' => ['auth'], 'prefix' => 'v4', 'as' => ''], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('v4.dashboard');
    Route::get('profil', [ProfilController::class, 'index'])->name('v4.profil');

    // AKUN PENGGUNA
        Route::get('akun/aksesjabatan', [AksesJabatanController::class, 'index'])->name('v4.akun.aksesjabatan');

    // LOGOUT ROUTE
    Route::post('logout', [AuthController::class, 'logout'])->name('v4.logout');
});
