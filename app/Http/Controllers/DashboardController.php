<?php

namespace App\Http\Controllers;
use App\Models\Petugas;
use App\Models\Admin;
use App\Models\Tugas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Use Admin and Tugas statistics instead of Barang
       $totalAdmin = Admin::count();
        $jumlahPetugas = Petugas::count();
        $tugasSelesai = Tugas::where('status', 'selesai')->count();
        $totalTugas = Tugas::count();

        return view('dashboard', compact('totalAdmin', 'jumlahPetugas', 'tugasSelesai', 'totalTugas'));
    }
}
