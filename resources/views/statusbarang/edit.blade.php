@extends('layouts.app')

@section('title', 'Edit Status Barang')

@section('content')

<style>
    .form-modern {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .form-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
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
        border-color: #2575fc;
        box-shadow: 0 0 0 3px rgba(37, 117, 252, 0.1);
    }
    
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .btn-update {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
    }
    
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
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
                    <h3>✏️ Edit Status Barang</h3>
                </div>

                <div class="p-4">
                    <form action="{{ route('statusbarang.update', $status->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label">Nama Barang</label>
                            <select name="barang_id" class="form-control" required>
                                @foreach($barangs as $b)
                                    <option value="{{ $b->id }}" {{ $status->barang_id == $b->id ? 'selected' : '' }}>
                                        {{ $b->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label">Jumlah Rusak</label>
                                    <input type="number" name="jumlah_rusak" class="form-control" value="{{ $status->jumlah_rusak }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label">Tanggal Rusak</label>
                                    <input type="date" name="tanggal_rusak" class="form-control" value="{{ $status->tanggal_rusak }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="4">{{ $status->keterangan }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('statusbarang.index') }}" class="btn btn-back">← Kembali</a>
                            <button type="submit" class="btn btn-update">✓ Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
