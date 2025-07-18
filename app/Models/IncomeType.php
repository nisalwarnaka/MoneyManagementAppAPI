<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, mixed $income_type)
 * @method static create(array $array)
 */
class IncomeType extends Model
{
    protected $table="income_types";

    protected $fillable=[
        'income_type',
        'max_amount',
        'min_amount'];
}
