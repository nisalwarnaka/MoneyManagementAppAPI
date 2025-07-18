<?php

namespace App\Http\Controllers\income;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeTypeCreateRequest;
use App\Models\IncomeType;

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
}
