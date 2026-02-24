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
        Schema::create('input_aspirasis', function (Blueprint $table) {
            $table->id('id_pelaporan');
            $table->string('nis', 10);
            $table->unsignedBigInteger('id_kategori');
            $table->string('lokasi', 50);
            $table->text('ket');
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswas');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_aspirasis');
    }
};