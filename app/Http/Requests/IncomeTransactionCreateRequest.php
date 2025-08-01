<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomeTransactionCreateRequest extends FormRequest
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
            'income_type' => ['required','string','max:255'],
            'income_type_id' => ['required','numeric'],
            'transaction_amount' => ['required','numeric'],
            'special_note' =>['nullable','string','max:255'],
            'month' =>['required','string','max:255'],

        ];
    }
}
