<?php

namespace Feature\ExpenseTypes;

use App\Models\ExpenseType;
use Tests\TestCase;

class SetExpenseTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_set_expense_types(): void
    {
        //Arrange
        $Data = ExpenseType::factory()->make()->toArray();

        //Act
        $response = $this->postJson('/api/expense-type-create', $Data);

        //Assert
        $response->assertStatus(201)->assertJson(['message' => 'Expense Type Created Successfully']);

        $this->assertDatabaseHas('expense_types', [
            'expense_type' => $Data['expense_type'],
            'max_amount' => $Data['max_amount'],
            'min_amount' => $Data['min_amount'],
        ]);
    }

    public function test_with_same_expense_types(): void
    {
        //Arrange
        ExpenseType::factory()->create([
            'expense_type'=> 'test',
            'max_amount'=>1000,
            'min_amount'=>100,]);

        $Data = [
            'expense_type'=> 'test',
            'max_amount'=>1000,
            'min_amount'=>100,
        ];

        //Act
        $response = $this->postJson('/api/expense-type-create', $Data);


        //Assert

        $response->assertStatus(409)->assertJson(['message' => 'Expense Type Already Exist']);

        $this->assertDatabaseHas('expense_types', [
            'expense_type' => $Data['expense_type'],
            'max_amount' => $Data['max_amount'],
            'min_amount' => $Data['min_amount'],
        ]);
    }
}
