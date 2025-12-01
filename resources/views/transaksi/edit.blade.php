@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')

<style>
    .form-modern {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .form-header {
        background: linear-gradient(135deg, #2f3437 0%, #6b7280 100%);
        color: #f1f3f5;
        padding: 25px;
    }
    
    .form-header h3 {
        margin: 0;
        font-weight: 700;
    }
    
    .form-control {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #6b7280;
        box-shadow: 0 0 0 3px rgba(107,114,128,0.08);
    }
    
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .btn-update {
        background: linear-gradient(135deg, #3a3f44 0%, #6b7280 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
    }
    
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(58,63,68,0.28);
        color: white;
    }
    
    .btn-back {
        background: #e0e0e0;
        color: #333;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
    }
    
    .btn-back:hover {
        background: #d0d0d0;
        color: #333;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-modern">
                <div class="form-header">
                    <h3>✏️ Edit Transaksi</h3>
                </div>

                <div class="p-4">
                    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label">Nama Barang</label>
                            <select name="barang_id" class="form-control" required>
                                @foreach($barangs as $b)
                                    <option value="{{ $b->id }}" {{ $b->id == $transaksi->barang_id ? 'selected' : '' }}>
                                        {{ $b->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="{{ $transaksi->tanggal }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label">Jenis Transaksi</label>
                                    <select name="jenis" class="form-control" required>
                                        <option value="masuk" {{ $transaksi->jenis == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                        <option value="keluar" {{ $transaksi->jenis == 'keluar' ? 'selected' : '' }}>Keluar</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" value="{{ $transaksi->jumlah }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="4">{{ $transaksi->keterangan }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('transaksi.index') }}" class="btn btn-back">← Kembali</a>
                            <button type="submit" class="btn btn-update">✓ Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
