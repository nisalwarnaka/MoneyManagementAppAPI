<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseTransactionCreateRequest extends FormRequest
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
            'ExpenseTransactionType' => ['required','string','max:255'],
            'ExpenseTypeId' => ['required','numeric'],
            'ExpenseTransactionAmount' => ['required','numeric'],
            'ExpenseSpecialNote' =>['nullable','string','max:255'],
            'ExpenseTransactionMonth' =>['required','string','max:255'],
        ];
    }
}
