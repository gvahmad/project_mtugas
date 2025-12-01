@extends('layouts/app')

@section('title', 'Tambah Barang')

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
    
    .btn-save {
        background: linear-gradient(135deg, #3a3f44 0%, #6b7280 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
    }
    
    .btn-save:hover {
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
                    <h3>➕ Tambah Barang</h3>
                </div>
                
                <div class="p-4">
                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="satuan" class="form-label">Satuan</label>
                                    <input type="text" name="satuan" id="satuan" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="kondisi_bagus" class="form-label">Kondisi Bagus</label>
                                    <input type="number" name="kondisi_bagus" id="kondisi_bagus" class="form-control" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="kondisi_rusak" class="form-label">Kondisi Rusak</label>
                                    <input type="number" name="kondisi_rusak" id="kondisi_rusak" class="form-control" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('barang.index') }}" class="btn btn-back">← Kembali</a>
                            <button type="submit" class="btn btn-save">✓ Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
