<?php

namespace Feature\IncomeTypes;

use App\Models\IncomeType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetIncomeTypesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_can_get_income_types(): void
    {
        //Arrange
        IncomeType::factory()->count(4)->create();

        //Action
        $response = $this->getJson('/api/income-types-view');

        //Assert
        $response->assertStatus(200)->assertJsonCount(4);
        $response->assertJsonStructure([
            '*' => ['id', 'income_type', 'max_amount', 'min_amount'],
        ]);

    }
}
