<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['ket_kategori' => 'Kerusakan Meja'],
            ['ket_kategori' => 'Kerusakan Kursi'],
            ['ket_kategori' => 'Kerusakan Papan Tulis'],
            ['ket_kategori' => 'Kerusakan Proyektor'],
            ['ket_kategori' => 'Kerusakan AC'],
            ['ket_kategori' => 'Kerusakan Lampu'],
            ['ket_kategori' => 'Kerusakan Kipas Angin'],
            ['ket_kategori' => 'Kerusakan Pintu'],
            ['ket_kategori' => 'Kerusakan Jendela'],
            ['ket_kategori' => 'Kerusakan Toilet'],
            ['ket_kategori' => 'Masalah Kebersihan'],
            ['ket_kategori' => 'Lainnya'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}