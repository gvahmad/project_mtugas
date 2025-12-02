@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Halaman Karyawan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(!$petugas)
        <div class="alert alert-info">Profil karyawan tidak ditemukan. Pastikan akun Anda memiliki email yang sama dengan data `petugas`.</div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tugas yang diberikan</h5>

            @if($tasks->isEmpty())
                <p>Tidak ada tugas untuk ditampilkan.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->judul }}</td>
                            <td>{{ Str::limit($task->deskripsi, 80) }}</td>
                            <td>{{ optional($task->deadline)->format('Y-m-d') }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                            <td>
                                <form action="{{ route('karyawan.tugas.updateStatus', $task->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <div class="input-group">
                                        <select name="status" class="form-control">
                                            <option value="pending" {{ $task->status=='pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="proses" {{ $task->status=='proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="selesai" {{ $task->status=='selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    
</div>
@endsection
