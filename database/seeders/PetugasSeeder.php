<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Admin;
use App\Models\Tugas;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat admin contoh (dibutuhkan oleh foreign key tugas.admin_id)
        $admin = Admin::create([
            'nama_lengkap' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        // Buat user Laravel untuk karyawan
        $user = User::create([
            'name' => 'Karyawan Example',
            'email' => 'karyawan@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // Buat record petugas (tabel petugass) dengan email yang sama
        $petugas = Petugas::create([
            'nama' => 'Karyawan Example',
            'email' => 'karyawan@gmail.com',
            'no_hp' => '081234567890',
            'jabatan' => 'Staff',
        ]);

        // Buat contoh tugas untuk karyawan ini
        Tugas::create([
            'judul' => 'Contoh Tugas 1',
            'deskripsi' => 'Ini adalah tugas contoh yang diberikan oleh admin.',
            'status' => 'pending',
            'deadline' => now()->addDays(7)->format('Y-m-d'),
            'admin_id' => $admin->id,
            'karyawan_id' => $petugas->id,
        ]);
    }
}
