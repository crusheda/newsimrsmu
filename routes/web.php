<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\LoginController;
use \App\Http\Controllers\Dashboard\DashboardController;

Route::get('/', function () {
    return view('pages.index');
})->name('portal');

// AUTHENTICATION ROUTES
Route::group(['prefix' => 'v4', 'as' => ''], function () {
    Route::get('login', [LoginController::class, 'index'])->name('auth.login');
});

// PROTECTED ROUTES
Route::group(['middleware' => ['auth'], 'prefix' => 'v4', 'as' => ''], function () {
    Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
});
