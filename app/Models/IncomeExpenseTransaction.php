<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class IncomeExpenseTransaction extends Model
{
    protected $table = 'income_expense_transactions';
    protected $fillable = [
        'income_type',
        'expense_type',
        'income_type_id',
        'expense_type_id',
        'transaction_amount',
        'special_note'
    ];
}
