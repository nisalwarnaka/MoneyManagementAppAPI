<?php

namespace App\Http\Controllers\expense;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseTransactionCreateRequest;
use App\Http\Requests\ExpenseTypeCreateRequest;
use App\Models\ExpenseType;
use App\Models\IncomeExpenseTransaction;
use Illuminate\Http\Request;

class expenseDeatailsController extends Controller
{
    public function ExpenseTypeCreate(ExpenseTypeCreateRequest $request):string
    {
        $AllDataExpenseTypeCreate = $request->validated();

        if (ExpenseType:: where('expense_type' , $AllDataExpenseTypeCreate['ExpenseType'])->exists()) {

            return "Expense Type Already Exist";
        }
        else{

            ExpenseType::create([

                'expense_type' => $AllDataExpenseTypeCreate['ExpenseType'],
                'max_amount' => $AllDataExpenseTypeCreate['MaxAmount'],
                'min_amount' => $AllDataExpenseTypeCreate['MinAmount']
            ]);
            return "Expense Type Created Successfully";
        }

    }

    public function ExpenseTransactionCreate(ExpenseTransactionCreateRequest $request):string
    {

        $AllDataExpenseTransactionCreate = $request->validated();

        $SelectedDataExpenseType = ExpenseType::where('id' , $AllDataExpenseTransactionCreate['ExpenseTypeId']);

        $SelectedExpenseTypeMAxAmount = $SelectedDataExpenseType->get()[0]->max_amount;
        $SelectedExpenseTypeMinAmount = $SelectedDataExpenseType->get()[0]->min_amount;

        if($SelectedExpenseTypeMAxAmount >= $AllDataExpenseTransactionCreate['ExpenseTransactionAmount'] & $SelectedExpenseTypeMinAmount <= $AllDataExpenseTransactionCreate['ExpenseTransactionAmount'])
        {

            IncomeExpenseTransaction::create([
                'expense_type' => $AllDataExpenseTransactionCreate['ExpenseTransactionType'],
                'expense_type_id' => $AllDataExpenseTransactionCreate['ExpenseTypeId'],
                'transaction_amount' => $AllDataExpenseTransactionCreate['ExpenseTransactionAmount'],
                'special_note' => $AllDataExpenseTransactionCreate['ExpenseSpecialNote'],

            ]);
            return "Expense Transaction Created Successfully";
        }
        else
        {
            return "Expense Transaction Limitation Error";
        }
    }
}
