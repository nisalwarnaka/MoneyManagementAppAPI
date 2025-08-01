<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method where(string $string, mixed $AllDataIncomeTransactionEdit)
 * @method static whereNotNull(string $string)
 */
class IncomeExpenseTransaction extends Model
{
   use HasFactory;

    protected $table = 'income_expense_transactions';
    protected $fillable = [
        'income_type',
        'expense_type',
        'income_type_id',
        'expense_type_id',
        'transaction_amount',
        'special_note',
        'month'
    ];
}
