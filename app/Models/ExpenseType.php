<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, mixed $ExpenseType)
 * @method static create(mixed $AllDataExpenseTypeCreate)
 */
class ExpenseType extends Model
{
    protected $table = 'expense_types';
    protected $fillable = [
        'expense_type',
        'max_amount',
        'min_amount',];
}
