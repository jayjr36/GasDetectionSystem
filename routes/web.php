<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GasReadingController;
use App\Http\Controllers\MailController;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/display-page', function () {
    return view('display');
});
Route::get('/gas-readings/Graph', [GasReadingController::class, 'indexGraph'])->name('gas.readings');
Route::get('/gas-readings', [GasReadingController::class, 'index']);
Auth::routes();

Route::get('/create/user', function () {
    return view('admin.create_user');
})->name('new-user');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::post('/admin/send-email', [AdminController::class, 'sendEmail'])->name('admin.sendEmail');
Route::get('/users/create', [AdminController::class, 'store'])->name('users.create');
Route::get('/users/edit/{user}', [AdminController::class, 'editUser'])->name('users.edit');
Route::get('/users/create', [AdminController::class, 'createUserForm'])->name('users.create');
  
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
Route::post('/admin/send-email', [AdminController::class, 'sendEmail'])->name('admin.sendEmail');


Route::get('/admin/email-logs', [AdminController::class, 'emailLogs'])->name('admin.emailLogs');

Route::get('/gas-graph', [GasReadingController::class, 'graph'])->name('gas.graph');
Route::get('/send-email', [MailController::class, 'showForm'])->name('send.email');
Route::post('/send-email', [MailController::class, 'sendEmail'])->name('send.email.send');
