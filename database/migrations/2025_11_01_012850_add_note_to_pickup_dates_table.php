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
        Schema::table('pickup_dates', function (Blueprint $table) {
            $table->text('note')->nullable()->after('pickup_date');
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::table('pickup_dates', function (Blueprint $table) {
            $table->dropColumn('note');
        });
    }
};
