<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusBarang extends Model
{
    use HasFactory;

    protected $table = 'statusbarangs';

    protected $fillable = [
        'barang_id',
        'nama_barang',
        'jumlah_rusak',
        'tanggal_rusak',
        'keterangan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
