<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GasReadingController;


Route::post('/gas-readings', [GasReadingController::class, 'store']);