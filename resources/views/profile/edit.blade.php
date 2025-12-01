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
        border: 3px solid #2f3437;
        object-fit: cover;
    }
    
    .upload-label {
        display: inline-block;
        padding: 10px 20px;
        background: linear-gradient(135deg, #3a3f44 0%, #6b7280 100%);
        color: white;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .upload-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(58,63,68,0.28);
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
                        <div class="alert alert-success" style="background: linear-gradient(135deg, #e9ecef 0%, #f1f3f5 100%); color: #2f3437; border: none; border-radius: 10px; padding: 15px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Validation errors (show helpful messages when upload or validation fails) --}}
                    @if ($errors->any())
                        <div class="alert alert-danger" style="background:#fdecea;color:#8a1f1f;border-radius:10px;padding:12px;border:none;margin-bottom:16px;">
                            <strong>Terjadi kesalahan:</strong>
                            <ul style="margin:8px 0 0 18px; padding:0;">
                                @foreach ($errors->all() as $error)
                                    <li style="line-height:1.5;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="photo-section">
                            <h5 style="margin-bottom: 15px; color: #333;">Foto Profil</h5>
                            @php
                                $profileFile = 'img/profile/' . (Auth::user()->profile_photo ?? 'default-profile.png');
                                $profileSrc = file_exists(public_path($profileFile)) ? asset($profileFile) : asset('img/undraw_profile.svg');
                            @endphp
                            <img src="{{ $profileSrc }}" alt="Foto Profil" class="photo-preview">
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

    // Client-side validation: file type/size feedback before submitting
    document.querySelector('form[action="{{ route('profile.update') }}"]').addEventListener('submit', function(e) {
        const input = document.getElementById('profile_photo');
        const file = input.files[0];
        if (file) {
            const maxSize = 10 * 1024 * 1024; // 2MB
            const allowed = ['image/jpeg', 'image/jpg', 'image/png'];
            // If file too big or wrong type, prevent submit and show a brief alert
            if (file.size > maxSize || !allowed.includes(file.type)) {
                e.preventDefault();
                let message = 'Foto harus JPG/PNG dan maksimal 2MB.';
                alert(message);
                return false;
            }
        }
    });
</script>

@endsection
