<?php

// database/migrations/xxxx_xx_xx_create_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total', 15, 2);
            $table->string('status')->default('pending'); // pending, paid, failed
            $table->string('payment_proof')->nullable(); // foto bukti transfer
            $table->enum('payment_method', ['transfer', 'store'])->default('transfer');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
