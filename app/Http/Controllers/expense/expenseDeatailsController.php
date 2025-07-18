<?php

namespace App\Http\Controllers\expense;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseTypeCreateRequest;
use App\Models\ExpenseType;
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
}
