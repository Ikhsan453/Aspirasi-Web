<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    use HasFactory;

    protected $table = 'tb_input_aspirasi';
    protected $primaryKey = 'id_pelaporan';

    protected $fillable = [
        'nis',
        'id_kategori',
        'lokasi',
        'ket',
        'foto'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function aspirasi()
    {
        return $this->hasOne(Aspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }

    public function statusHistories()
    {
        return $this->hasMany(AspirasiStatusHistory::class, 'id_pelaporan', 'id_pelaporan')
                    ->orderBy('created_at', 'desc');
    }

    // Override delete method to handle cascade delete manually if needed
    public function delete()
    {
        // Delete related aspirasi and status histories first (though cascade should handle this)
        $this->aspirasi()->delete();
        $this->statusHistories()->delete();
        
        return parent::delete();
    }
}