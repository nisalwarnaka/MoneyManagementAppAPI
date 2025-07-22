<?php

namespace App\Http\Controllers\expense;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseTransactionCreateRequest;
use App\Http\Requests\ExpenseTransactionEditRequest;
use App\Http\Requests\ExpenseTypeCreateRequest;
use App\Http\Requests\ExpenseTypeEditRequest;
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
                'month' => $AllDataExpenseTransactionCreate['ExpenseTransactionMonth']

            ]);
            return "Expense Transaction Created Successfully";
        }
        else
        {
            return "Expense Transaction Limitation Error";
        }
    }

    public function ExpenseTypeEdit(ExpenseTypeEditRequest $request):string
    {
        $AllDataExpenseTypeEdit = $request->validated();

        if (ExpenseType::where('expense_type' , $AllDataExpenseTypeEdit['ExpenseTypeForEdit'])->exists()) {

            $SelectExpenseType = ExpenseType::where('expense_type' , $AllDataExpenseTypeEdit['ExpenseTypeForEdit']);

            $SelectedExpenseTypeId = $SelectExpenseType->get()[0]->id;

            if ($SelectedExpenseTypeId == $AllDataExpenseTypeEdit['ExpenseTypeIdForEdit']) {

                ExpenseType::where('id', $SelectedExpenseTypeId)->update([

                    'expense_type' => $AllDataExpenseTypeEdit['ExpenseTypeForEdit'],
                    'max_amount' => $AllDataExpenseTypeEdit['ExpenseMaxAmountForEdit'],
                    'min_amount' => $AllDataExpenseTypeEdit['ExpenseMinAmountForEdit']

                ]);
                return "Expense Type Updated Successfully";
            }
            else{

                return "This Expense Type Already Exist";
            }

        }
        else{

            if (ExpenseType::where('id' , $AllDataExpenseTypeEdit['ExpenseTypeIdForEdit'])->exists()){

            ExpenseType::where('id', $AllDataExpenseTypeEdit['ExpenseTypeIdForEdit'])->update([

                'expense_type' => $AllDataExpenseTypeEdit['ExpenseTypeForEdit'],
                'max_amount' => $AllDataExpenseTypeEdit['ExpenseMaxAmountForEdit'],
                'min_amount' => $AllDataExpenseTypeEdit['ExpenseMinAmountForEdit']

            ]);
            return "Expense Type Updated Successfully";

            }
            else{

                return "error ! something went wrong, please try again later";
            }
        }

    }

    public function ExpenseTransactionEdit(ExpenseTransactionEditRequest $request):string
    {
        $AllDataExpenseTransactionEdit = $request->validated();

        $SelectedExpenseType = ExpenseType::where('id', $AllDataExpenseTransactionEdit['ExpenseTransactionTypeIdForEdit']);
        $selectedExpenseTypeMaxAmount = $SelectedExpenseType->get()[0]->max_amount;
        $SelectedExpenseTypeMinAmount = $SelectedExpenseType->get()[0]->min_amount;

        if($selectedExpenseTypeMaxAmount >=  $AllDataExpenseTransactionEdit['ExpenseTransactionAmountForEdit'] &  $SelectedExpenseTypeMinAmount <= $AllDataExpenseTransactionEdit['ExpenseTransactionAmountForEdit'])
        {

            IncomeExpenseTransaction::where('id', $AllDataExpenseTransactionEdit['ExpenseTransactionIdForEdit'])->update([

                'transaction_amount' => $AllDataExpenseTransactionEdit['ExpenseTransactionAmountForEdit'],
                'special_note' => $AllDataExpenseTransactionEdit['ExpenseTransactionSpecial_noteForEdit'],
                'month' => $AllDataExpenseTransactionEdit['ExpenseTransactionMonthForEdit']
            ]);
            return "Income Transaction Updated Successfully";
        }
        else{
            return "Income Transaction limitation error";
        }



    }
}
