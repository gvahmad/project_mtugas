@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-modern">
                <div class="form-header">
                    <h3>➕ Tambah Admin</h3>
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

                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto (opsional)</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.index') }}" class="btn btn-back">← Kembali</a>
                            <button type="submit" class="btn btn-save">✓ Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
