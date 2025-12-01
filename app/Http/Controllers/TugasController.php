<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Admin;
use App\Models\Petugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::with(['admin','karyawan'])->paginate(10);
        return view('tugas.index', compact('tugas'));
    }

    public function create()
    {
        $admins = Admin::all();
        $karyawans = Petugas::all();
        return view('tugas.create', compact('admins','karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:pending,proses,selesai',
            'deadline' => 'nullable|date',
            'admin_id' => 'required|exists:admins,id',
            'karyawan_id' => 'nullable|exists:petugass,id',
        ]);

        Tugas::create($request->only(['judul','deskripsi','status','deadline','admin_id','karyawan_id']));

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        $admins = Admin::all();
        $karyawans = Petugas::all();
        return view('tugas.edit', compact('tugas','admins','karyawans'));
    }

    public function show($id)
    {
        // Simple redirect to edit — detailed show view can be added later
        return redirect()->route('tugas.edit', $id);
    }

    public function update(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:pending,proses,selesai',
            'deadline' => 'nullable|date',
            'admin_id' => 'required|exists:admins,id',
            'karyawan_id' => 'nullable|exists:petugass,id',
        ]);

        $tugas->update($request->only(['judul','deskripsi','status','deadline','admin_id','karyawan_id']));

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();
        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus');
    }
}
