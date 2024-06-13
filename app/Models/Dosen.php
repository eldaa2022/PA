<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;


    protected $fillable = [
        'nama',
        'email',
        'foto',
        'kompetensi',
        'matkul',
        'lampiran',
        'status',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
