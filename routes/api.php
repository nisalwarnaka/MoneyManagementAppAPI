<?php

use App\Http\Controllers\expense\expenseDeatailsController;
use App\Http\Controllers\income\incomeDetailsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/income-type-create', [IncomeDetailsController::class, 'IncomeTypeCreate']);
Route::post('/expense-type-create', [expenseDeatailsController::class, 'ExpenseTypeCreate']);
Route::post('/income-transaction-create', [IncomeDetailsController::class, 'IncomeTransactionCreate']);
Route::post('/expense-transaction-create', [expenseDeatailsController::class, 'ExpenseTransactionCreate']);
Route::post('/expense-type-edit', [expenseDeatailsController::class, 'ExpenseTypeEdit']);
Route::post('/income-type-edit', [IncomeDetailsController::class, 'IncomeTypeEdit']);
Route::post('/income-transaction-edit', [IncomeDetailsController::class, 'IncomeTransactionEdit']);
Route::post('/expense-transaction-edit', [expenseDeatailsController::class, 'ExpenseTransactionEdit']);
