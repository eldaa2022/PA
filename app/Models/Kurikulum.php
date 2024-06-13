<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    //protected $primaryKey = ['kurikulum_id'];

    protected $fillable = [
        'profil_lulusan',
        'deskripsi',
        'kemampuan',
        'status',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
