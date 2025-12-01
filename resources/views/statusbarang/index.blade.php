@extends('layouts.app')

@section('title', 'Data Status Barang')

@section('content')

<style>
    .table-modern {
        border-collapse: collapse;
    }
    
    .table-modern thead {
        background: linear-gradient(135deg, #2f3437 0%, #6b7280 100%);
        color: #f1f3f5;
    }
    
    .table-modern tbody tr {
        transition: all 0.3s ease;
    }
    
    .table-modern tbody tr:hover {
        background-color: #f8f9ff;
    }
    
    .btn-custom-edit {
        background: linear-gradient(135deg, #3a3f44 0%, #6b7280 100%);
        color: white !important;
        border: none;
        padding: 5px 12px;
        border-radius: 5px;
        font-size: 0.875rem;
    }
    
    .btn-custom-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(102, 126, 234, 0.4);
    }
    
    .btn-custom-delete {
        background: linear-gradient(135deg, #454b50 0%, #9aa0a6 100%);
        color: white !important;
        border: none;
        padding: 5px 12px;
        border-radius: 5px;
        font-size: 0.875rem;
    }
    
    .btn-custom-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(245, 87, 108, 0.4);
    }
    
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding: 20px;
        background: linear-gradient(135deg, #2f3437 0%, #6b7280 100%);
        border-radius: 10px;
        color: #f1f3f5;
    }
    
    .page-header h2 {
        margin: 0;
        font-weight: 700;
    }
    
    .btn-add {
        background: white;
        color: #6b7280;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 600;
    }
    
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        color: #6b7280;
    }
</style>

<div class="page-header">
    <h2>🧰 Data Status Barang</h2>
    <a href="{{ route('statusbarang.create') }}" class="btn btn-add">+ Tambah Laporan</a>
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
                        <th style="padding: 15px;">No</th>
                        <th style="padding: 15px;">Nama Barang</th>
                        <th style="padding: 15px;">Jumlah Rusak</th>
                        <th style="padding: 15px;">Tanggal Rusak</th>
                        <th style="padding: 15px;">Keterangan</th>
                        <th style="padding: 15px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statusbarang as $sb)
                    <tr>
                        <td style="padding: 12px; text-align: center;">{{ $loop->iteration }}</td>
                        <td style="padding: 12px;">{{ $sb->nama_barang }}</td>
                        <td style="padding: 12px; text-align: center;"><span style="background: #f8d7da; color: #721c24; padding: 5px 10px; border-radius: 5px;">{{ $sb->jumlah_rusak }}</span></td>
                        <td style="padding: 12px; text-align: center;">{{ $sb->tanggal_rusak }}</td>
                        <td style="padding: 12px;">{{ $sb->keterangan }}</td>
                        <td style="padding: 12px; text-align: center;">
                            <a href="{{ route('statusbarang.edit', $sb->id) }}" class="btn btn-sm btn-custom-edit">Edit</a>
                            <form action="{{ route('statusbarang.destroy', $sb->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-custom-delete" onclick="return confirm('Hapus data ini?')">Hapus</button>
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
