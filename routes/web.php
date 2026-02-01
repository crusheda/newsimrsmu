<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.v4.index');
})->name('portal');

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

Route::group(['middleware' => ['auth'], 'prefix' => 'v4', 'as' => ''], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('v4.dashboard');
    Route::get('profil', [ProfilController::class, 'index'])->name('v4.profil');

    // LOGOUT ROUTE
    Route::post('logout', [AuthController::class, 'logout'])->name('v4.logout');
});
