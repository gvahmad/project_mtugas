<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';
    protected $fillable = ['nama_lengkap', 'username', 'password', 'foto'];

    // Hide password when converting to array
    protected $hidden = ['password'];

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'admin_id');
    }
}
