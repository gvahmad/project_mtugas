<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Simpan email sementara
        Session::flash('email', $request->email);

        // Validasi
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {

            // Regenerate session (WAJIB)
            $request->session()->regenerate();

            return redirect()->intended('/')
                ->with('success', 'Berhasil Login');
        }

        return redirect('/login')
            ->with('error', 'Email atau password tidak valid.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
