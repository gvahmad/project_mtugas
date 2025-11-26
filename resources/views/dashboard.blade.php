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
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 20px;
        border: none;
    }
    
    .card-total-barang {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .card-total-petugas {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    
    .card-barang-rusak {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    
    .card-persentase {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
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
        <h1 class="h3 mb-0" style="color: #6a11cb;">Dashboard Inventaris</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Barang Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card card-total-barang shadow h-100">
                <div class="card-body">
                    <div class="stat-label">
                        Total Barang
                    </div>
                    <div class="stat-number mt-2">
                        {{ $totalBarang }}
                    </div>
                    <div style="font-size: 0.95rem; opacity: 0.85;">Unit</div>
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

        <!-- Barang Rusak Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card card-barang-rusak shadow h-100">
                <div class="card-body">
                    <div class="stat-label">
                        Barang Rusak
                    </div>
                    <div class="stat-number mt-2">
                        {{ $barangRusak }}
                    </div>
                    <div style="font-size: 0.95rem; opacity: 0.85;">Unit</div>
                </div>
            </div>
        </div>

        <!-- Persentase Kondisi Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card card-persentase shadow h-100">
                <div class="card-body">
                    <div class="stat-label">
                        Persentase Rusak
                    </div>
                    <div class="stat-number mt-2">
                        @if($totalBarang > 0)
                            {{ round(($barangRusak / $totalBarang) * 100, 1) }}%
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