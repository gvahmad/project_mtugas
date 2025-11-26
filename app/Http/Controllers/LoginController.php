<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Proses login user
     */
    public function login(Request $request)
    {
        // Simpan email sementara ketika gagal login
        Session::flash('email', $request->email);

        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Data login
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Cek kredensial
        if (Auth::attempt($infologin)) {
            return redirect('barang')->with('success', 'Berhasil Login');
        }

        // Jika gagal login
        return redirect('auth/login')
            ->with('error', 'Email atau password yang kamu masukkan tidak valid.');
    }

    /**
     * Logout user
     */
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
}
}
