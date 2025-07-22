<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseTransactionEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'ExpenseTransactionTypeForEdit' => ['required'],
            'ExpenseTransactionTypeIdForEdit' => ['required'],
            'ExpenseTransactionIdForEdit' => ['required'],
            'ExpenseTransactionAmountForEdit' => ['required'],
            'ExpenseTransactionSpecial_noteForEdit' => ['nullable'],
            'ExpenseTransactionMonthForEdit' => ['required'],
        ];
    }
}
