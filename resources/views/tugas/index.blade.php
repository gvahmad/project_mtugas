@extends('layouts.app')

@section('title', 'Data Tugas')

@section('content')

<div class="page-header">
    <h2>📋 Daftar Tugas</h2>
    <a href="{{ route('tugas.create') }}" class="btn btn-add">+ Tambah Tugas</a>
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
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th>Admin</th>
                        <th>Karyawan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tugas as $t)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $t->judul }}</td>
                        <td>{{ Str::limit($t->deskripsi, 50) }}</td>
                        <td class="text-center">
                            @if($t->status === 'pending')
                                <span class="badge badge-secondary">Pending</span>
                            @elseif($t->status === 'proses')
                                <span class="badge badge-info">Proses</span>
                            @else
                                <span class="badge badge-success">Selesai</span>
                            @endif
                        </td>
                        <td>{{ $t->deadline ? $t->deadline->format('Y-m-d') : '-' }}</td>
                        <td>{{ $t->admin?->nama_lengkap }}</td>
                        <td>{{ $t->karyawan?->nama ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('tugas.edit', $t) }}" class="btn btn-sm btn-custom-edit">Edit</a>
                            <form action="{{ route('tugas.destroy', $t) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-custom-delete" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="8" class="text-center">Tidak ada tugas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
