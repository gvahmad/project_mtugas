@extends('layouts/app')
@section('content')
<style>
    .dashboard-card {
        border-radius: 15px;
        border: none;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
    
    .card-header-gradient {
        background: linear-gradient(135deg, #2f3437 0%, #6b7280 100%);
        color: #f1f3f5;
        padding: 20px;
        border: none;
    }
    
    .card-total-barang {
        background: linear-gradient(135deg, #3a3f44 0%, #6b7280 100%);
        color: #f1f3f5;
    }
    
    .card-total-petugas {
        background: linear-gradient(135deg, #454b50 0%, #9aa0a6 100%);
        color: #f1f3f5;
    }
    
    .card-barang-rusak {
        background: linear-gradient(135deg, #e9ecef 0%, #f1f3f5 100%);
        color: #2f3437;
    }
    
    .card-persentase {
        background: linear-gradient(135deg, #e9ecef 0%, #f5f7f9 100%);
        color: #2f3437;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
    }
    
    .stat-label {
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.9;
    }
</style>

<div class="container-fluid">
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="color: #2f3437;">Data tugas</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Admin Card (replaces Total Barang) -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card card-total-barang shadow h-100">
                <div class="card-body">
                    <div class="stat-label">
                        Total Admin
                    </div>
                    <div class="stat-number mt-2">
                        {{ $totalAdmin }}
                    </div>
                    <div style="font-size: 0.95rem; opacity: 0.85;">Orang</div>
                </div>
            </div>
        </div>

        <!-- Total Petugas Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card card-total-petugas shadow h-100">
                <div class="card-body">
                    <div class="stat-label">
                        Total Petugas
                    </div>
                    <div class="stat-number mt-2">
                        {{ $jumlahPetugas }}
                    </div>
                    <div style="font-size: 0.95rem; opacity: 0.85;">Orang</div>
                </div>
            </div>
        </div>

        <!-- Tugas Selesai Card (replaces Barang Rusak) -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card card-barang-rusak shadow h-100">
                <div class="card-body">
                    <div class="stat-label">
                        Tugas Selesai
                    </div>
                    <div class="stat-number mt-2">
                        {{ $tugasSelesai }}
                    </div>
                    <div style="font-size: 0.95rem; opacity: 0.85;">Item</div>
                </div>
            </div>
        </div>

        <!-- Persentase Kondisi Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card card-persentase shadow h-100">
                <div class="card-body">
                        <div class="stat-label">
                        Persentase Selesai
                    </div>
                    <div class="stat-number mt-2">
                        @if($totalTugas > 0)
                            {{ round(($tugasSelesai / $totalTugas) * 100, 1) }}%
                        @else
                            0%
                        @endif
                    </div>
                    <div style="font-size: 0.95rem; opacity: 0.85;">dari total</div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection()