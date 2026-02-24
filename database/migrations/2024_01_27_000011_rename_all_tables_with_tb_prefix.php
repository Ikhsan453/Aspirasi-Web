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
        // Rename tables dengan prefix tb_
        Schema::rename('kategoris', 'tb_kategori');
        Schema::rename('siswas', 'tb_siswa');
        Schema::rename('aspirasis', 'tb_aspirasi');
        Schema::rename('input_aspirasis', 'tb_input_aspirasi');
        Schema::rename('admins', 'tb_admin');
        Schema::rename('aspirasi_status_histories', 'tb_aspirasi_status_history');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan nama tabel ke semula
        Schema::rename('tb_kategori', 'kategoris');
        Schema::rename('tb_siswa', 'siswas');
        Schema::rename('tb_aspirasi', 'aspirasis');
        Schema::rename('tb_input_aspirasi', 'input_aspirasis');
        Schema::rename('tb_admin', 'admins');
        Schema::rename('tb_aspirasi_status_history', 'aspirasi_status_histories');
    }
};
