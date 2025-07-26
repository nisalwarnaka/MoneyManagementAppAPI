<?php

namespace App\Http\Controllers\expense;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseTransactionCreateRequest;
use App\Http\Requests\ExpenseTransactionEditRequest;
use App\Http\Requests\ExpenseTransactionsFinderRequest;
use App\Http\Requests\ExpenseTypeCreateRequest;
use App\Http\Requests\ExpenseTypeEditRequest;
use App\Models\ExpenseType;
use App\Models\IncomeExpenseTransaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class expenseDeatailsController extends Controller
{
    public function ExpenseTypeCreate(ExpenseTypeCreateRequest $request):JsonResponse
    {
        $AllDataExpenseTypeCreate = $request->validated();

        if (ExpenseType:: where('expense_type' , $AllDataExpenseTypeCreate['ExpenseType'])->exists()) {


            return response()->json(['message' => 'Expense Type Already Exist'], 409);
        }
        else{

            ExpenseType::create([

                'expense_type' => $AllDataExpenseTypeCreate['ExpenseType'],
                'max_amount' => $AllDataExpenseTypeCreate['MaxAmount'],
                'min_amount' => $AllDataExpenseTypeCreate['MinAmount']
            ]);

            return response()->json(['message' => 'Expense Type Created Successfully'], 201);
        }

    }

    public function ExpenseTransactionCreate(ExpenseTransactionCreateRequest $request):JsonResponse
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

            return response()->json(['Expense Transaction Created Successfully']);
        }
        else
        {

            return response()->json(['Expense Transaction Limitation Error']);
        }
    }

    public function ExpenseTypeEdit(ExpenseTypeEditRequest $request):JsonResponse
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

                return response()->json(['Expense Type Updated Successfully']);
            }
            else{


                return response()->json(['This Expense Type Already Exist']);
            }

        }
        else{

            if (ExpenseType::where('id' , $AllDataExpenseTypeEdit['ExpenseTypeIdForEdit'])->exists()){

            ExpenseType::where('id', $AllDataExpenseTypeEdit['ExpenseTypeIdForEdit'])->update([

                'expense_type' => $AllDataExpenseTypeEdit['ExpenseTypeForEdit'],
                'max_amount' => $AllDataExpenseTypeEdit['ExpenseMaxAmountForEdit'],
                'min_amount' => $AllDataExpenseTypeEdit['ExpenseMinAmountForEdit']

            ]);

                return response()->json(['Expense Type Updated Successfully']);

            }
            else{


                return response()->json(['error ! something went wrong, please try again later']);
            }
        }

    }

    public function ExpenseTransactionEdit(ExpenseTransactionEditRequest $request):JsonResponse
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

            return response()->json(['Income Transaction Updated Successfully']);
        }
        else{

            return response()->json(['Income Transaction limitation error']);
        }
    }

    public function ExpenseTypeDelete(Request $request): JsonResponse
    {
        $ExpenseTypeIdForDelete = $request['ExpenseTypeIdForDelete'];
        ExpenseType::destroy($ExpenseTypeIdForDelete);


        return response()->json(['Expense Type Deleted Successfully']);
    }

    public function ExpenseTypesView(): JsonResponse {
        return response()->json(ExpenseType::all(),);
    }

    public function ExpenseTransactionsView(Request $request): JsonResponse {

        return response()->json(IncomeExpenseTransaction::whereNotNull('expense_type')->get());
    }

    public function ExpenseTransactionSearch(ExpenseTransactionsFinderRequest $request): JsonResponse {

        $AllDataExpenseTransactionSearch = $request->validated();


        if($AllDataExpenseTransactionSearch['ExpenseTypeIdForSearch'] == null & $AllDataExpenseTransactionSearch['ExpenseTransactionMonthForSearch'] == null){

            return response()->json(IncomeExpenseTransaction::whereNotNull('expense_type')->get());
        }
        else{
            $SearchExpenseTransactionsData = IncomeExpenseTransaction::query();

            if($AllDataExpenseTransactionSearch['ExpenseTypeIdForSearch'] != null){

                $SearchExpenseTransactionsData->where('expense_type_id', $AllDataExpenseTransactionSearch['ExpenseTypeIdForSearch']);
            }

            if($AllDataExpenseTransactionSearch['ExpenseTransactionMonthForSearch'] != null){

                $SearchExpenseTransactionsData->where('month', $AllDataExpenseTransactionSearch['ExpenseTransactionMonthForSearch']);
            }

            $SelectedExpenseTransactionData = $SearchExpenseTransactionsData->get();

            if($SelectedExpenseTransactionData -> isEmpty()){

                return response()->json(['No Data Found']);
            }

            return response()->json($SearchExpenseTransactionsData->get());
        }
    }
}
