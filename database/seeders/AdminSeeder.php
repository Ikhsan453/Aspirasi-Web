<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 3 Akun Admin
        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        Admin::create([
            'username' => 'admin2',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        Admin::create([
            'username' => 'admin3',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}