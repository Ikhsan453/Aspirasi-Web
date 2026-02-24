<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait ResetsAutoIncrement
{
    /**
     * Reset auto increment ID for a table
     *
     * @param string $table
     * @param string $column
     * @return void
     */
    protected function resetAutoIncrement($table, $column = 'id')
    {
        // Get the maximum ID from the table
        $maxId = DB::table($table)->max($column);
        
        // If no records exist, reset to 1, otherwise set to max + 1
        $nextId = $maxId ? $maxId + 1 : 1;
        
        // Check database driver
        $driver = DB::getDriverName();
        
        if ($driver === 'sqlite') {
            // For SQLite, update the sqlite_sequence table
            DB::statement("UPDATE sqlite_sequence SET seq = ? WHERE name = ?", [$maxId ?: 0, $table]);
        } else {
            // For MySQL and other databases
            DB::statement("ALTER TABLE {$table} AUTO_INCREMENT = {$nextId}");
        }
    }

    /**
     * Reset auto increment for tb_input_aspirasi table
     */
    protected function resetInputAspirasiAutoIncrement()
    {
        $this->resetAutoIncrement('tb_input_aspirasi', 'id_pelaporan');
    }

    /**
     * Reset auto increment for tb_kategori table
     */
    protected function resetKategoriAutoIncrement()
    {
        $this->resetAutoIncrement('tb_kategori', 'id_kategori');
    }

    /**
     * Reset auto increment for tb_aspirasi table
     */
    protected function resetAspirasiAutoIncrement()
    {
        $this->resetAutoIncrement('tb_aspirasi', 'id_aspirasi');
    }

    /**
     * Reset auto increment for tb_aspirasi_status_history table
     */
    protected function resetStatusHistoryAutoIncrement()
    {
        $this->resetAutoIncrement('tb_aspirasi_status_history', 'id');
    }

    /**
     * Reset auto increment for tb_siswa table
     */
    protected function resetSiswaAutoIncrement()
    {
        $this->resetAutoIncrement('tb_siswa', 'nis');
    }
}