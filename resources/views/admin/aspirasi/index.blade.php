@extends('layouts.admin')

@section('title', 'Kelola Aspirasi')

@push('styles')
<style>
.page-header {
    background: var(--gradient-accent);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    color: white;
}

.filter-card {
    background: rgba(30, 41, 59, 0.95);
    border: 1px solid rgba(51, 65, 85, 0.5);
    border-radius: 16px;
    backdrop-filter: blur(10px);
}

.data-table-card {
    background: rgba(30, 41, 59, 0.95);
    border: 1px solid rgba(51, 65, 85, 0.5);
    border-radius: 16px;
    backdrop-filter: blur(10px);
}

.stats-bar {
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.5rem;
}

.action-buttons .btn {
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
}

/* Animation delays for table rows */
.slide-in-delay-0 { animation-delay: 0s; }
.slide-in-delay-1 { animation-delay: 0.05s; }
.slide-in-delay-2 { animation-delay: 0.1s; }
.slide-in-delay-3 { animation-delay: 0.15s; }
.slide-in-delay-4 { animation-delay: 0.2s; }
.slide-in-delay-5 { animation-delay: 0.25s; }
.slide-in-delay-6 { animation-delay: 0.3s; }
.slide-in-delay-7 { animation-delay: 0.35s; }
.slide-in-delay-8 { animation-delay: 0.4s; }
.slide-in-delay-9 { animation-delay: 0.45s; }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header fade-in">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-6 fw-bold mb-2">
                <i class="fas fa-comments me-3"></i>
                Kelola Aspirasi
            </h1>
            <p class="lead mb-0 opacity-75">
                Pantau dan kelola semua Aspirasi sarana prasarana sekolah
            </p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('student.aspirasi.create') }}" class="btn btn-success btn-lg shadow-lg">
                <i class="fas fa-plus-circle me-2"></i>Tambah Aspirasi
            </a>
        </div>
    </div>
</div>

<!-- Statistics Bar -->
<div class="stats-bar slide-in">
    <div class="row text-center">
        <div class="col-md-3">
            <div class="fw-bold text-light fs-4">{{ $inputAspirasis->total() }}</div>
            <small class="text-muted-custom">Total Aspirasi</small>
        </div>
        <div class="col-md-3">
            @php
                $menunggu = $inputAspirasis->filter(function($item) {
                    return ($item->aspirasi ? $item->aspirasi->status : 'Menunggu') === 'Menunggu';
                })->count();
            @endphp
            <div class="fw-bold text-warning fs-4">{{ $menunggu }}</div>
            <small class="text-muted-custom">Menunggu</small>
        </div>
        <div class="col-md-3">
            @php
                $proses = $inputAspirasis->filter(function($item) {
                    return ($item->aspirasi ? $item->aspirasi->status : 'Menunggu') === 'Proses';
                })->count();
            @endphp
            <div class="fw-bold text-info fs-4">{{ $proses }}</div>
            <small class="text-muted-custom">Dalam Proses</small>
        </div>
        <div class="col-md-3">
            @php
                $selesai = $inputAspirasis->filter(function($item) {
                    return ($item->aspirasi ? $item->aspirasi->status : 'Menunggu') === 'Selesai';
                })->count();
            @endphp
            <div class="fw-bold text-success fs-4">{{ $selesai }}</div>
            <small class="text-muted-custom">Selesai</small>
        </div>
    </div>
</div>

<!-- Search and Filter Form -->
<div class="card filter-card mb-4 slide-in">
    <div class="card-header">
        <h5 class="mb-0 text-white fw-semibold">
            <i class="fas fa-filter me-2"></i>
            Filter & Pencarian
        </h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.aspirasi.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="search" class="form-label fw-semibold">
                        <i class="fas fa-search me-1"></i>Pencarian
                    </label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" 
                           placeholder="NIS, nama, kategori, lokasi...">
                </div>
                <div class="col-md-2">
                    <label for="date_from" class="form-label fw-semibold">
                        <i class="fas fa-calendar-alt me-1"></i>Dari Tanggal
                    </label>
                    <input type="date" class="form-control" id="date_from" name="date_from" 
                           value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <label for="date_to" class="form-label fw-semibold">
                        <i class="fas fa-calendar-check me-1"></i>Sampai Tanggal
                    </label>
                    <input type="date" class="form-control" id="date_to" name="date_to" 
                           value="{{ request('date_to') }}">
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label fw-semibold">
                        <i class="fas fa-info-circle me-1"></i>Status
                    </label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Dalam Proses</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <label for="per_page" class="form-label fw-semibold">
                        <i class="fas fa-list me-1"></i>Show
                    </label>
                    <select class="form-select" id="per_page" name="per_page">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 per halaman</option>
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 per halaman</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per halaman</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per halaman</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per halaman</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-refresh"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="alert alert-info py-2 mb-0">
                        <i class="fas fa-info-circle"></i>
                        <strong>{{ $inputAspirasis->total() }}</strong> Aspirasi ditemukan
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="card data-table-card slide-in">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-modern mb-0">
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
                            <i class="fas fa-graduation-cap me-1"></i>Kelas
                        </th>
                        <th class="text-white fw-semibold">
                            <i class="fas fa-book me-1"></i>Jurusan
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
                    @forelse($inputAspirasis as $index => $aspirasi)
                        <tr class="slide-in slide-in-delay-{{ $index % 10 }}">
                            <td>
                                <span class="badge bg-secondary fs-6">#{{ $aspirasi->id_pelaporan }}</span>
                            </td>
                            <td class="text-light">
                                <div>{{ $aspirasi->created_at->format('d/m/Y') }}</div>
                                <small class="text-muted-custom">{{ $aspirasi->created_at->format('H:i') }}</small>
                            </td>
                            <td class="text-light">{{ $aspirasi->nis }}</td>
                            <td class="text-light">{{ $aspirasi->siswa->kelas ?? '-' }}</td>
                            <td class="text-light">{{ $aspirasi->siswa->jurusan ?? '-' }}</td>
                            <td>
                                <span class="badge bg-warning text-dark fw-semibold">
                                    {{ $aspirasi->kategori->ket_kategori }}
                                </span>
                            </td>
                            <td class="text-light">{{ Str::limit($aspirasi->lokasi, 30) }}</td>
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
                                <span class="badge {{ $statusClass }} fs-6">{{ $statusText }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.aspirasi.show', $aspirasi) }}" 
                                       class="btn btn-sm btn-primary" 
                                       title="Lihat Detail"
                                       style="min-width: 35px;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.aspirasi.destroy', $aspirasi) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger" 
                                                title="Hapus"
                                                style="min-width: 35px;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted-custom py-5">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                <h5>Belum ada aspirasi</h5>
                                <p class="mb-0">aspirasi akan muncul di sini setelah siswa membuat laporan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    @if($inputAspirasis->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $inputAspirasis->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form when filters change
    const dateFromInput = document.getElementById('date_from');
    const dateToInput = document.getElementById('date_to');
    const statusSelect = document.getElementById('status');
    const perPageSelect = document.getElementById('per_page');
    const form = dateFromInput.closest('form');
    
    function autoSubmit() {
        form.submit();
    }
    
    if (dateFromInput) dateFromInput.addEventListener('change', autoSubmit);
    if (dateToInput) dateToInput.addEventListener('change', autoSubmit);
    if (statusSelect) statusSelect.addEventListener('change', autoSubmit);
    if (perPageSelect) perPageSelect.addEventListener('change', autoSubmit);
    
    // Search with debounce
    const searchInput = document.getElementById('search');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                if (searchInput.value.length >= 3 || searchInput.value.length === 0) {
                    form.submit();
                }
            }, 500);
        });
    }
});
</script>
@endpush