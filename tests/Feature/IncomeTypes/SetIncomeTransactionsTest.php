<?php

namespace Tests\Feature\IncomeTypes;

use App\Models\IncomeExpenseTransaction;
use App\Models\IncomeType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SetIncomeTransactionsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
   public function test_can_set_income_transactions(): void {

       IncomeType::factory()->create([
           'income_type' => 'test1',
           'max_amount' => 10000,
           'min_amount' => 100,
       ]);
       $Data = IncomeExpenseTransaction::factory()->make([
           'income_type' => 'test1',
           'expense_type' => null,
           'income_type_id' => 2,
           'expense_type_id' => null,
           'transaction_amount' => 5000,
           'special_note' => 'bla bla bla bla bla',
           'month' => 'january',
       ])->toArray();

       $response = $this->postJson('/api/income-transaction-create', $Data);

       $response->assertStatus(201)->assertJson(['message' =>'Income Transaction Created Successfully']);

       $this->assertDatabaseHas('income_expense_transactions', [
           'income_type' => $Data['income_type'],
           'income_type_id' => $Data['income_type_id'],
           'transaction_amount' => $Data['transaction_amount'],
           'special_note' => $Data['special_note'],
           'month' => $Data['month'],
       ]);
   }

   public function test_with_out_of_limit_transaction_amounts(): void{

       IncomeType::factory()->create([
           'income_type' => 'test1',
           'max_amount' => 10000,
           'min_amount' => 100,
       ]);

       $Data = IncomeExpenseTransaction::factory()->make([
           'income_type' => 'test1',
           'expense_type' => null,
           'income_type_id' => 2,
           'expense_type_id' => null,
           'transaction_amount' => 11000,
           'special_note' => 'bla bla bla bla bla',
           'month' => 'january',
       ])->toArray();

       $response = $this->postJson('/api/income-transaction-create', $Data);

       $response->assertStatus(409)->assertJson(['message'=>'Income Transaction limitation error']);
   }
}
