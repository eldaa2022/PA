<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $primaryKey = ['admin_id'];

    protected $fillable = [
        'email',
        'password',
        'foto',
    ];

    public function agenda()
    {
        return $this->hasMany(Agenda::class);
    }
    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }
}
