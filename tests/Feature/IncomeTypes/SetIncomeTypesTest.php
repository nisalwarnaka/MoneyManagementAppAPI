<?php

namespace Tests\Feature\IncomeTypes;

use App\Models\IncomeType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SetIncomeTypesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_can_set_income_types(): void
    {
        //Arrange
        //$Data = IncomeType::factory()->make()->toArray();

        $Data = [
            'income_type'=> 'test1',
            'max_amount'=>1000,
            'min_amount'=>100,
        ];
        $Data1 = [
            'income_type'=> 'test2',
            'max_amount'=>1000,
            'min_amount'=>100,
        ];

        //Act
        $response = $this->postJson('/api/income-type-create', $Data);
        $response1 = $this->postJson('/api/income-type-create', $Data1);

        //Assert
        $response->assertStatus(201)->assertJson(['message' => 'Income Type Created Successfully']);
        $response1->assertStatus(201)->assertJson(['message' => 'Income Type Created Successfully']);

        $this->assertDatabaseHas('income_types', [
            'income_type' => $Data['income_type'],
            'max_amount' => $Data['max_amount'],
            'min_amount' => $Data['min_amount'],
        ]);
        $this->assertDatabaseHas('income_types', [
            'income_type' => $Data1['income_type'],
            'max_amount' => $Data1['max_amount'],
            'min_amount' => $Data1['min_amount'],
        ]);
    }

    public function test_with_same_income_types(): void
    {
        //Arrange
        //$Data = IncomeType::factory()->make()->toArray();

        $Data = [
            'income_type'=> 'test',
            'max_amount'=>1000,
            'min_amount'=>100,
        ];
        $Data1 = [
            'income_type'=> 'test',
            'max_amount'=>1000,
            'min_amount'=>100,
        ];

        //Act
        $response = $this->postJson('/api/income-type-create', $Data);
        $response1 = $this->postJson('/api/income-type-create', $Data1);

        //Assert
        $response->assertStatus(201)->assertJson(['message' => 'Income Type Created Successfully']);
        $response1->assertStatus(409)->assertJson(['message' => 'Income Type Already Exists']);

        $this->assertDatabaseHas('income_types', [
            'income_type' => $Data['income_type'],
            'max_amount' => $Data['max_amount'],
            'min_amount' => $Data['min_amount'],
        ]);
    }
}
