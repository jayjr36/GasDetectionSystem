<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GasReadingController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/display-page', function () {
    return view('display');
});

Route::get('/gas-readings', [GasReadingController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/send-email', [MailController::class, 'showForm'])->name('send.email');
Route::post('/send-email', [MailController::class, 'sendEmail'])->name('send.email.send');
