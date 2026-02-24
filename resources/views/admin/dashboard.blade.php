@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@push('styles')
<style>
.stats-card {
    background: var(--gradient-accent);
    border: none;
    border-radius: 16px;
    color: white;
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transform: translate(30px, -30px);
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.stats-card.warning {
    background: linear-gradient(135deg, var(--warning) 0%, #d97706 100%);
}

.stats-card.info {
    background: linear-gradient(135deg, var(--info) 0%, #0891b2 100%);
}

.stats-card.success {
    background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
}

.stats-card.primary {
    background: var(--gradient-accent);
}

.stats-icon {
    font-size: 2.5rem;
    opacity: 0.8;
}

.recent-card {
    background: rgba(30, 41, 59, 0.95);
    border: 1px solid rgba(51, 65, 85, 0.5);
    border-radius: 16px;
    backdrop-filter: blur(10px);
}

.category-progress {
    background: rgba(51, 65, 85, 0.3);
    border-radius: 10px;
    height: 8px;
    overflow: hidden;
}

.category-progress .progress-bar {
    background: var(--gradient-accent);
    border-radius: 10px;
    transition: width 0.6s ease;
}

.maintenance-card {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
    border-radius: 16px;
}

.page-header {
    background: var(--gradient-accent);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    color: white;
}
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header fade-in">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-6 fw-bold mb-2">
                <i class="fas fa-tachometer-alt me-3"></i>
                Dashboard Admin
            </h1>
            <p class="lead mb-0 opacity-75">
                Selamat datang, {{ Auth::guard('admin')->user()->username }}! Kelola Aspirasi Web dengan mudah.
            </p>
        </div>
        <div class="col-md-4 text-md-end">
            <div class="text-white-50">
                <i class="fas fa-calendar-alt me-2"></i>
                {{ now()->format('d F Y') }}
            </div>
        </div>
    </div>
</div>

@php
    // Get statistics with latest status from aspirasi relationship
    $allAspirasi = \App\Models\InputAspirasi::with('aspirasi')->get();
    $totalAspirasi = $allAspirasi->count();
    
    $aspirasiMenunggu = 0;
    $aspirasiProses = 0;
    $aspirasiSelesai = 0;
    
    foreach ($allAspirasi as $aspirasi) {
        $status = $aspirasi->aspirasi ? $aspirasi->aspirasi->status : 'Menunggu';
        
        switch ($status) {
            case 'Menunggu':
                $aspirasiMenunggu++;
                break;
            case 'Proses':
                $aspirasiProses++;
                break;
            case 'Selesai':
                $aspirasiSelesai++;
                break;
        }
    }
@endphp

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card primary slide-in">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-uppercase fw-bold mb-1 opacity-75" style="font-size: 0.875rem;">
                            Total Aspirasi
                        </div>
                        <div class="h2 mb-0 fw-bold">
                            {{ $totalAspirasi }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card warning slide-in" style="animation-delay: 0.1s;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-uppercase fw-bold mb-1 opacity-75" style="font-size: 0.875rem;">
                            Menunggu Review
                        </div>
                        <div class="h2 mb-0 fw-bold">
                            {{ $aspirasiMenunggu }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card info slide-in" style="animation-delay: 0.2s;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-uppercase fw-bold mb-1 opacity-75" style="font-size: 0.875rem;">
                            Dalam Proses
                        </div>
                        <div class="h2 mb-0 fw-bold">
                            {{ $aspirasiProses }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cogs stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card success slide-in" style="animation-delay: 0.3s;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-uppercase fw-bold mb-1 opacity-75" style="font-size: 0.875rem;">
                            Selesai Ditangani
                        </div>
                        <div class="h2 mb-0 fw-bold">
                            {{ $aspirasiSelesai }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Reports -->
    <div class="col-lg-8 mb-4">
        <div class="card recent-card slide-in">
            <div class="card-header">
                <h5 class="mb-0 text-white fw-semibold">
                    <i class="fas fa-list-alt me-2"></i>
                    Aspirasi Terbaru
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-compact mb-0">
                        <thead style="background: var(--gradient-accent);">
                            <tr>
                                <th class="text-white fw-semibold">
                                    <i class="fas fa-hashtag me-1"></i>ID
                                </th>
                                <th class="text-white fw-semibold">
                                    <i class="fas fa-calendar me-1"></i>Tanggal
                                </th>
                                <th class="text-white fw-semibold">
                                    <i class="fas fa-user me-1"></i>NIS
                                </th>
                                <th class="text-white fw-semibold">
                                    <i class="fas fa-tag me-1"></i>Kategori
                                </th>
                                <th class="text-white fw-semibold">
                                    <i class="fas fa-map-marker-alt me-1"></i>Lokasi
                                </th>
                                <th class="text-white fw-semibold">
                                    <i class="fas fa-info-circle me-1"></i>Status
                                </th>
                                <th class="text-white fw-semibold">
                                    <i class="fas fa-cog me-1"></i>Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\InputAspirasi::with(['siswa', 'kategori', 'aspirasi'])->orderBy('created_at', 'desc')->take(5)->get() as $index => $aspirasi)
                                <tr class="slide-in" style="animation-delay: {{ $index * 0.1 }}s;">
                                    <td>
                                        <span class="badge bg-secondary">#{{ $aspirasi->id_pelaporan }}</span>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div class="text-light-custom">{{ $aspirasi->created_at->format('d/m/Y') }}</div>
                                            <small class="text-muted-custom d-block">{{ $aspirasi->created_at->format('H:i') }}</small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-semibold text-light-custom">{{ $aspirasi->nis }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning text-dark fw-semibold">
                                            {{ $aspirasi->kategori->ket_kategori }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="text-light-custom">{{ Str::limit($aspirasi->lokasi, 20) }}</div>
                                    </td>
                                    <td>
                                        @php
                                            $statusText = $aspirasi->aspirasi ? $aspirasi->aspirasi->status : 'Menunggu';
                                            $statusClass = match($statusText) {
                                                'Menunggu' => 'bg-warning text-dark',
                                                'Proses' => 'bg-info',
                                                'Selesai' => 'bg-success',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }} fw-semibold">{{ $statusText }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.aspirasi.show', $aspirasi) }}" 
                                           class="btn btn-sm btn-primary"
                                           style="min-width: 35px;">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted-custom py-4">
                                        <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                        Belum ada Aspirasi masuk
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($totalAspirasi > 0)
                    <div class="card-footer text-center" style="background: rgba(51, 65, 85, 0.3);">
                        <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-primary">
                            <i class="fas fa-list me-2"></i>Lihat Semua aspirasi
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Statistics & Tools -->
    <div class="col-lg-4">
        <!-- Category Statistics -->
        <div class="card recent-card mb-4 slide-in">
            <div class="card-header">
                <h5 class="mb-0 text-white fw-semibold">
                    <i class="fas fa-chart-pie me-2"></i>
                    Statistik Kategori
                </h5>
            </div>
            <div class="card-body">
                @php
                    $kategoris = \App\Models\Kategori::withCount('inputaspirasis')
                        ->orderBy('inputaspirasis_count', 'desc')
                        ->get();
                    $totalAspirasiAll = \App\Models\InputAspirasi::count();
                @endphp
                @forelse($kategoris as $index => $kategori)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-light fw-medium">{{ $kategori->ket_kategori }}</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-info">{{ $kategori->inputaspirasis_count }}</span>
                                <small class="text-muted-custom">
                                    @php
                                        $percentage = $totalAspirasiAll > 0 ? ($kategori->inputaspirasis_count / $totalAspirasiAll) * 100 : 0;
                                    @endphp
                                    {{ number_format($percentage, 1) }}%
                                </small>
                            </div>
                        </div>
                        <div class="category-progress variant-{{ ($index % 5) + 1 }}">
                            <div class="progress-bar" style="width: {{ $percentage }}%"></div>
                        </div>
                        
                        <!-- Status breakdown for this category -->
                        @php
                            $aspirasiKategori = \App\Models\InputAspirasi::with('aspirasi')->where('id_kategori', $kategori->id_kategori)->get();
                            $menunggu = 0;
                            $proses = 0;
                            $selesai = 0;
                            
                            foreach($aspirasiKategori as $aspirasi) {
                                $status = $aspirasi->aspirasi ? $aspirasi->aspirasi->status : 'Menunggu';
                                
                                switch($status) {
                                    case 'Menunggu': $menunggu++; break;
                                    case 'Proses': $proses++; break;
                                    case 'Selesai': $selesai++; break;
                                }
                            }
                        @endphp
                        @if($kategori->inputaspirasis_count > 0)
                            <div class="mt-2 d-flex gap-2 flex-wrap">
                                @if($menunggu > 0)
                                    <small class="badge bg-warning text-dark">{{ $menunggu }} Menunggu</small>
                                @endif
                                @if($proses > 0)
                                    <small class="badge bg-info">{{ $proses }} Proses</small>
                                @endif
                                @if($selesai > 0)
                                    <small class="badge bg-success">{{ $selesai }} Selesai</small>
                                @endif
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center text-muted-custom py-3">
                        <i class="fas fa-tags fa-2x mb-2 d-block"></i>
                        Belum ada kategori
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection