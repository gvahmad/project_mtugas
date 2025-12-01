<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';
    protected $fillable = ['judul', 'deskripsi', 'status', 'deadline', 'admin_id', 'karyawan_id'];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Petugas::class, 'karyawan_id');
    }
}
