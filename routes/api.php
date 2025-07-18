<?php

use App\Http\Controllers\expense\expenseDeatailsController;
use App\Http\Controllers\income\incomeDetailsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/income-type-create', [IncomeDetailsController::class, 'IncomeTypeCreate']);
Route::post('/expense-type-create', [expenseDeatailsController::class, 'ExpenseTypeCreate']);
