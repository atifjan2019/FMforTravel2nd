<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('amount', 10, 2);
            $table->date('income_date');
            $table->string('reference_no')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('completed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};