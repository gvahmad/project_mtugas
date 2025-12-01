@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-modern">
                <div class="form-header">
                    <h3>✏️ Edit Admin</h3>
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

                    <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $admin->nama_lengkap) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username', $admin->username) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto (opsional)</label>
                            <div class="mb-2">
                                @if($admin->foto)
                                    <img src="{{ asset('foto_admins/' . $admin->foto) }}" width="120" alt="foto" class="img-thumbnail" style="border-radius:8px;">
                                    <div class="form-check mt-2"><input type="checkbox" name="hapus_foto" id="hapus_foto" class="form-check-input"><label for="hapus_foto" class="form-check-label">Hapus foto lama</label></div>
                                @endif
                            </div>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.index') }}" class="btn btn-back">← Kembali</a>
                            <button type="submit" class="btn btn-save">✓ Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
