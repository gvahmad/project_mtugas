@extends('layouts.app')

@section('title', 'Edit Profil')

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
    
    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    
    .photo-section {
        background: #f8f9ff;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: center;
    }
    
    .photo-preview {
        max-width: 150px;
        height: 150px;
        border-radius: 50%;
        margin: 0 auto 15px;
        border: 3px solid #6a11cb;
        object-fit: cover;
    }
    
    .upload-label {
        display: inline-block;
        padding: 10px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .upload-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }
    
    #profile_photo {
        display: none;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-modern">
                <div class="form-header">
                    <h3>👤 Edit Profil</h3>
                </div>

                <div class="p-4">
                    @if (session('success'))
                        <div class="alert alert-success" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none; border-radius: 10px; padding: 15px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="photo-section">
                            <h5 style="margin-bottom: 15px; color: #333;">Foto Profil</h5>
                            <img src="{{ asset('img/profile/' . (Auth::user()->profile_photo ?? 'default-profile.png')) }}" alt="Foto Profil" class="photo-preview">
                            <div>
                                <input type="file" id="profile_photo" name="profile_photo" accept="image/*">
                                <label for="profile_photo" class="upload-label">📷 Pilih Foto</label>
                            </div>
                            <small class="form-text text-muted" style="display: block; margin-top: 10px;">Format: JPG, PNG. Ukuran maksimal: 2MB</small>
                        </div>

                        <div class="mb-4">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-back">← Kembali</a>
                            <button type="submit" class="btn btn-save">✓ Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview foto saat dipilih
    document.getElementById('profile_photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.querySelector('.photo-preview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
