<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'tb_kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'ket_kategori'
    ];

    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'id_kategori', 'id_kategori');
    }

    public function aspirasi()
    {
        return $this->hasOne(Aspirasi::class, 'id_kategori', 'id_kategori');
    }

    public function inputAspirasis()
    {
        return $this->hasMany(InputAspirasi::class, 'id_kategori', 'id_kategori');
    }
}