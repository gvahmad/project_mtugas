@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-modern">
                <div class="form-header">
                    <h3>✏️ Edit Tugas</h3>
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

                    <form action="{{ route('tugas.update', $tugas->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul', $tugas->judul) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="pending" {{ $tugas->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $tugas->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $tugas->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $tugas->deadline ? $tugas->deadline->format('Y-m-d') : '') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Admin</label>
                            <select name="admin_id" class="form-control" required>
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}" {{ $tugas->admin_id == $admin->id ? 'selected' : '' }}>{{ $admin->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Karyawan (opsional)</label>
                            <select name="karyawan_id" class="form-control">
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach($karyawans as $k)
                                    <option value="{{ $k->id }}" {{ $tugas->karyawan_id == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('tugas.index') }}" class="btn btn-back">← Kembali</a>
                            <button type="submit" class="btn btn-save">✓ Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
