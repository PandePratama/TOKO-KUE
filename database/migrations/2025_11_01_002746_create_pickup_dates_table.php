<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('pickup_dates', function (Blueprint $table) {
            $table->id();
            $table->date('pickup_date')->unique(); // tanggal pengambilan
            $table->boolean('is_available')->default(true); // status ketersediaan
            $table->timestamps();
        });
    }

    /**
     * Reverse (rollback) migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_dates');
    }
};
