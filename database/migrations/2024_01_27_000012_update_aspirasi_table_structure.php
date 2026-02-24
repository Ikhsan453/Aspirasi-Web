<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get existing foreign keys and indexes using raw SQL
        $foreignKeys = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'tb_aspirasi' 
            AND COLUMN_NAME = 'id_kategori'
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ");
        
        $uniqueIndexes = DB::select("
            SELECT INDEX_NAME 
            FROM information_schema.STATISTICS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'tb_aspirasi' 
            AND COLUMN_NAME = 'id_kategori'
            AND NON_UNIQUE = 0
            AND INDEX_NAME != 'PRIMARY'
        ");
        
        // Drop existing constraints
        Schema::table('tb_aspirasi', function (Blueprint $table) use ($foreignKeys, $uniqueIndexes) {
            // Drop foreign key if exists
            foreach ($foreignKeys as $fk) {
                $table->dropForeign($fk->CONSTRAINT_NAME);
            }
            
            // Drop unique index if exists
            foreach ($uniqueIndexes as $index) {
                $table->dropUnique($index->INDEX_NAME);
            }
        });
        
        // Add new column and constraints
        Schema::table('tb_aspirasi', function (Blueprint $table) {
            // Add id_pelaporan column
            $table->unsignedBigInteger('id_pelaporan')->after('id_aspirasi')->unique();
            
            // Foreign key to tb_input_aspirasi
            $table->foreign('id_pelaporan')
                  ->references('id_pelaporan')
                  ->on('tb_input_aspirasi')
                  ->onDelete('cascade');
            
            // Re-add foreign key for id_kategori (for reference only, not unique)
            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('tb_kategori')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_aspirasi', function (Blueprint $table) {
            $table->dropForeign(['id_pelaporan']);
            $table->dropColumn('id_pelaporan');
            
            // Restore unique constraint on id_kategori
            $table->unique('id_kategori');
        });
    }
};
