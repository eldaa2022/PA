<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tggl_publish',
        'tags',
        'jenis_konten',
        'status',
        'lampiran',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
