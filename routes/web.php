<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GasReadingController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/display-page', function () {
    return view('display');
});

Route::get('/gas-readings', [GasReadingController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
