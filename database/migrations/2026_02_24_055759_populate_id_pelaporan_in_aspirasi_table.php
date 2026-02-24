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
        // Delete all existing aspirasi records since they were based on id_kategori
        // New records will be created when aspirasi is submitted or status is updated
        DB::table('tb_aspirasi')->truncate();
        
        // Create aspirasi records for each existing aspirasi
        $aspirasis = DB::table('tb_input_aspirasi')->get();
        
        foreach ($aspirasis as $aspirasi) {
            // Get the latest status from history
            $latestHistory = DB::table('tb_aspirasi_status_history')
                ->where('id_pelaporan', $aspirasi->id_pelaporan)
                ->orderBy('created_at', 'desc')
                ->first();
            
            $status = $latestHistory ? $latestHistory->status : 'Menunggu';
            $feedback = $latestHistory ? $latestHistory->feedback : null;
            
            // Insert aspirasi record with id_pelaporan
            DB::table('tb_aspirasi')->insert([
                'id_pelaporan' => $aspirasi->id_pelaporan,
                'id_kategori' => $aspirasi->id_kategori,
                'status' => $status,
                'feedback' => $feedback,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Truncate and restore old structure (not really reversible)
        DB::table('tb_aspirasi')->truncate();
    }
};
