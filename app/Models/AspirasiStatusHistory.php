<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspirasiStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'tb_aspirasi_status_history';

    protected $fillable = [
        'id_pelaporan',
        'status',
        'feedback',
        'changed_by'
    ];

    public function inputAspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'changed_by', 'username');
    }
}