@extends('layouts.app')

@section('title', 'Data Admin')

@section('content')

<style>
    /* reuse petugas styles with slight tweaks */
</style>

<div class="page-header">
    <h2>👨‍💼 Data Admin</h2>
    <a href="{{ route('admin.create') }}" class="btn btn-add">+ Tambah Admin</a>
</div>

@if (session('success'))
<div class="alert alert-success" style="background: linear-gradient(135deg, #e9ecef 0%, #f1f3f5 100%); color: #2f3437; border: none; border-radius: 10px; padding: 15px;">{{ session('success') }}</div>
@endif

<div class="card shadow-lg" style="border: none; border-radius: 15px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern table-hover mb-0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $a)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            @if($a->foto)
                                <img src="{{ asset('foto_admins/' . $a->foto) }}" alt="Foto Admin" width="60" class="img-thumbnail" style="border-radius: 8px;">
                            @else
                                <span class="text-muted">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ $a->nama_lengkap }}</td>
                        <td>{{ $a->username }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.edit', $a) }}" class="btn btn-sm btn-custom-edit">Edit</a>
                            <form action="{{ route('admin.destroy', $a) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-custom-delete" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
