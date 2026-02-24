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
        Schema::table('aspirasi_status_histories', function (Blueprint $table) {
            // Drop existing foreign key
            $table->dropForeign(['id_pelaporan']);
            
            // Add foreign key with cascade delete
            $table->foreign('id_pelaporan')
                  ->references('id_pelaporan')
                  ->on('input_aspirasis')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aspirasi_status_histories', function (Blueprint $table) {
            // Drop cascade foreign key
            $table->dropForeign(['id_pelaporan']);
            
            // Add back original foreign key
            $table->foreign('id_pelaporan')
                  ->references('id_pelaporan')
                  ->on('input_aspirasis');
        });
    }
};