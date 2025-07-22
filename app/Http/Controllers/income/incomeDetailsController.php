<?php

namespace App\Http\Controllers\income;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeTransactionCreateRequest;
use App\Http\Requests\IncomeTransactionEditRequest;
use App\Http\Requests\IncomeTypeCreateRequest;
use App\Http\Requests\IncomeTypeEditRequest;
use App\Models\IncomeExpenseTransaction;
use App\Models\IncomeType;
use Illuminate\Http\Request;

class incomeDetailsController extends Controller
{
   public function IncomeTypeCreate(IncomeTypeCreateRequest $request):string
   {
       $AllDataIncomeTypeCreate = $request->validated();

       if(IncomeType::where('income_type', $AllDataIncomeTypeCreate['IncomeType'])->exists())
       {
           return "Income Type Already Exist";

       }
       else
       {
           IncomeType::create([
               'income_type' => $AllDataIncomeTypeCreate['IncomeType'],
               'max_amount' => $AllDataIncomeTypeCreate['MaxAmount'],
               'min_amount' => $AllDataIncomeTypeCreate['MinAmount'],

           ]);
           return "Income Type Created Successfully";
       }
   }

   public function IncomeTransactionCreate(IncomeTransactionCreateRequest $request):string
   {
       $AllDataIncomeTransactionCreate = $request->validated();

       $SelectedDataIncomeType = IncomeType::where('id', $AllDataIncomeTransactionCreate['IncomeTypeId']);

       $SelectedIncomeTypeMaxAmount = $SelectedDataIncomeType->get()[0]->max_amount;
       $SelectedIncomeTypeMinAmount = $SelectedDataIncomeType->get()[0]->min_amount;

       if($SelectedIncomeTypeMaxAmount >= $AllDataIncomeTransactionCreate['IncomeTransactionAmount'] & $SelectedIncomeTypeMinAmount <= $AllDataIncomeTransactionCreate['IncomeTransactionAmount'])
       {
           IncomeExpenseTransaction::create([
               'income_type' => $AllDataIncomeTransactionCreate['IncomeTransactionType'],
               'income_type_id' => $AllDataIncomeTransactionCreate['IncomeTypeId'],
               'transaction_amount' => $AllDataIncomeTransactionCreate['IncomeTransactionAmount'],
               'special_note' => $AllDataIncomeTransactionCreate['IncomeSpecialNote'],
               'month' => $AllDataIncomeTransactionCreate['IncomeTransactionMonth'],

           ]);
           return "Income Transaction Created Successfully";
       }
       else
       {
           return "Income Transaction limitation error";
       }

   }

   public function IncomeTypeEdit(IncomeTypeEditRequest $request):string
   {

       $AllDataIncomeTypeEdit = $request->validated();

       if (IncomeType::where('income_type' , $AllDataIncomeTypeEdit['IncomeTypeForEdit'])->exists()) {

           $SelectIncomeType = IncomeType::where('income_type' , $AllDataIncomeTypeEdit['IncomeTypeForEdit']);

           $SelectedIncomeTypeId = $SelectIncomeType->get()[0]->id;

           if ($SelectedIncomeTypeId == $AllDataIncomeTypeEdit['IncomeTypeIdForEdit']) {

               IncomeType::where('id', $SelectedIncomeTypeId)->update([

                   'income_type' => $AllDataIncomeTypeEdit['IncomeTypeForEdit'],
                   'max_amount' => $AllDataIncomeTypeEdit['IncomeMaxAmountForEdit'],
                   'min_amount' => $AllDataIncomeTypeEdit['IncomeMinAmountForEdit']

               ]);

               return "Income Type Updated Successfully";
           }
           else{
               return "this Income Type Already Exist";
           }

       }
       else{

           if (IncomeType::where('id' , $AllDataIncomeTypeEdit['IncomeTypeIdForEdit'])->exists()){

           IncomeType::where('id', $AllDataIncomeTypeEdit['IncomeTypeIdForEdit'])->update([

               'income_type' => $AllDataIncomeTypeEdit['IncomeTypeForEdit'],
               'max_amount' => $AllDataIncomeTypeEdit['IncomeMaxAmountForEdit'],
               'min_amount' => $AllDataIncomeTypeEdit['IncomeMinAmountForEdit']

           ]);
               return "Income Type Updated Successfully";

           }
           else{
               return "error ! something went wrong, please try again later";
           }

       }


   }

   public function IncomeTransactionEdit(IncomeTransactionEditRequest $request):string
   {
       $AllDataIncomeTransactionEdit = $request->validated();

       $SelectedIncomeType = IncomeType::where('id', $AllDataIncomeTransactionEdit['IncomeTransactionTypeIdForEdit']);
       $selectedIncomeTypeMaxAmount = $SelectedIncomeType->get()[0]->max_amount;
       $SelectedIncomeTypeMinAmount = $SelectedIncomeType->get()[0]->min_amount;

       if($selectedIncomeTypeMaxAmount >=  $AllDataIncomeTransactionEdit['IncomeTransactionAmountForEdit'] &  $SelectedIncomeTypeMinAmount <= $AllDataIncomeTransactionEdit['IncomeTransactionAmountForEdit'])
       {

           IncomeExpenseTransaction::where('id', $AllDataIncomeTransactionEdit['IncomeTransactionIdForEdit'])->update([

               'transaction_amount' => $AllDataIncomeTransactionEdit['IncomeTransactionAmountForEdit'],
               'special_note' => $AllDataIncomeTransactionEdit['IncomeTransactionSpecial_noteForEdit'],
               'month' => $AllDataIncomeTransactionEdit['IncomeTransactionMonthForEdit'],
           ]);
           return "Income Transaction Updated Successfully";
       }
       else{
           return "Income Transaction limitation error";
       }



   }

   public function IncomeTypeDelete(Request $request): string
   {
       $IncomeTypeIdForDelete = $request['IncomeTypeIdForDelete'];
       IncomeType::destroy($IncomeTypeIdForDelete);

       return "Income Type Deleted Successfully";
   }

   public function IncomeAndExpenseTransactionDelete(Request $request): string
   {
       $IncomeOrExpenseTransactionIdForDelete = $request['IncomeOrExpenseTransactionIdForDelete'];
       IncomeExpenseTransaction::destroy($IncomeOrExpenseTransactionIdForDelete);

       return "Transaction Deleted Successfully";
   }
}
