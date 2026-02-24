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
        Schema::create('aspirasi_status_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelaporan');
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai']);
            $table->text('feedback')->nullable();
            $table->string('changed_by')->nullable(); // Admin yang mengubah
            $table->timestamps();

            $table->foreign('id_pelaporan')->references('id_pelaporan')->on('input_aspirasis');
            $table->index(['id_pelaporan', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasi_status_histories');
    }
};