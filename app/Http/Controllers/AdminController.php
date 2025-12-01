<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate(10);
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username',
            'password' => 'required|string|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fotoName = null;
        if ($request->hasFile('foto')) {
            $fotoName = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('foto_admin'), $fotoName);
        }

        Admin::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'foto' => $fotoName,
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function show($id)
    {
        // For now redirect show to edit page
        return redirect()->route('admin.edit', $id);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $id,
            'password' => 'nullable|string|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fotoName = $admin->foto;

        if ($request->hapus_foto && $admin->foto && file_exists(public_path('foto_admins/' . $admin->foto))) {
            unlink(public_path('foto_admins/' . $admin->foto));
            $fotoName = null;
        }

        if ($request->hasFile('foto')) {
            if ($fotoName && file_exists(public_path('foto_admins/' . $fotoName))) {
                unlink(public_path('foto_admins/' . $fotoName));
            }
            $fotoName = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('foto_admins'), $fotoName);
        }

        $admin->nama_lengkap = $request->nama_lengkap;
        $admin->username = $request->username;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->foto = $fotoName;
        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->foto && file_exists(public_path('foto_admins/' . $admin->foto))) {
            unlink(public_path('foto_admins/' . $admin->foto));
        }

        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin berhasil dihapus');
    }
}
