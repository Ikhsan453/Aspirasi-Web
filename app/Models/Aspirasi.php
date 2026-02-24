<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $table = 'tb_aspirasi';
    protected $primaryKey = 'id_aspirasi';

    protected $fillable = [
        'status',
        'id_pelaporan',
        'id_kategori',
        'feedback'
    ];

    public function inputAspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}