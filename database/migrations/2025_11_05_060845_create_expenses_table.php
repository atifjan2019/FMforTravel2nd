<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->decimal('amount', 10, 2);
            $table->date('expense_date');
            $table->string('reference_no')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('paid');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};