@extends('layouts.app')

@section('title', 'Tambah Tugas')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-modern">
                <div class="form-header">
                    <h3>➕ Tambah Tugas</h3>
                </div>

                <div class="p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tugas.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Admin</label>
                            <select name="admin_id" class="form-control" required>
                                <option value="">-- Pilih Admin --</option>
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Karyawan (opsional)</label>
                            <select name="karyawan_id" class="form-control">
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach($karyawans as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('tugas.index') }}" class="btn btn-back">← Kembali</a>
                            <button type="submit" class="btn btn-save">✓ Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
