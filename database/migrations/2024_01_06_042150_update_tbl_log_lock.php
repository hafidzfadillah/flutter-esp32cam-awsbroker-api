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
        Schema::table('tbl_log_lock', function (Blueprint $table) {
            // Add a new column
            $table->string('rfid_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_log_lock', function (Blueprint $table) {
            // Reverse the changes made in the "up" method
            $table->dropColumn('rfid_number');
        });
    }
};
