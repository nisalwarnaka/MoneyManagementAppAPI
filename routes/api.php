<?php

use App\Http\Controllers\income\incomeDetailsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', [IncomeDetailsController::class, 'index']);
