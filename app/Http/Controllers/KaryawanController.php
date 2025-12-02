<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas;
use App\Models\Tugas;

class KaryawanController extends Controller
{
    // Tampilkan daftar tugas yang ditugaskan ke karyawan (sesuai email User -> Petugas)
    public function index()
    {
        $user = Auth::user();

        $tasks = collect();
        $petugas = null;

        if ($user && $user->email) {
            $petugas = Petugas::where('email', $user->email)->first();
        }

        if ($petugas) {
            $tasks = Tugas::where('karyawan_id', $petugas->id)->orderBy('deadline')->get();
        }

        return view('karyawan.index', compact('tasks', 'petugas'));
    }

    // Update status tugas oleh karyawan (mis. in_progress, completed)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
        ]);

        $tugas = Tugas::findOrFail($id);

        // Pastikan tugas memang untuk petugas yang login (cek via email mapping)
        $user = Auth::user();
        $petugas = null;
        if ($user && $user->email) {
            $petugas = Petugas::where('email', $user->email)->first();
        }

        if (!$petugas || $tugas->karyawan_id != $petugas->id) {
            return redirect()->route('karyawan.index')->with('error', 'Anda tidak memiliki akses untuk mengubah status tugas ini.');
        }

        $tugas->status = $request->status;
        $tugas->save();

        return redirect()->route('karyawan.index')->with('success', 'Status tugas berhasil diperbarui.');
    }
}
