<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Petugas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::sum('jumlah');
        $jumlahPetugas = Petugas::count();
        $barangRusak = Barang::sum('kondisi_rusak');
        
        return view('dashboard', compact('totalBarang', 'jumlahPetugas', 'barangRusak'));
    }
}
