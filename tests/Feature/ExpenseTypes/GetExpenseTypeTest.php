<?php

namespace Feature\ExpenseTypes;

use App\Models\ExpenseType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetExpenseTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_can_get_expense_types(): void
    {
        //Arrange
        ExpenseType::factory()->count(4)->create();

        //Act
        $response = $this->getJson('/api/expense-types-view');


        //Assert
        $response->assertStatus(200)->assertJsonCount(4)->assertJsonStructure(
            ['*' => ['id','expense_type','max_amount','min_amount']]);

    }
}
