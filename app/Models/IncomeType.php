<?php

namespace App\Models;

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static where(string $string, mixed $income_type)
 * @method static create(array $array)
 * @method static factory()
 */
class IncomeType extends Model
{
    use HasFactory;
    protected $table="income_types";

    protected $fillable=[
        'income_type',
        'max_amount',
        'min_amount'];
}
