<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('income_expense_transactions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('income_type')->nullable();
            $table->string('expense_type')->nullable();
            $table->integer('income_type_id')->nullable();
            $table->integer('expense_type_id')->nullable();
            $table->integer('transaction_amount');
            $table->string('special_note')->nullable();
            $table->string('month');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_expense_transactions');
    }
};
