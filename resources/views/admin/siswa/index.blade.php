@extends('layouts.admin')

@section('title', 'Kelola Siswa')

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
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.5rem;
}

.student-avatar {
    width: 40px;
    height: 40px;
    background: var(--gradient-accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    margin-right: 0.75rem;
}

.action-buttons .btn {
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
}
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header fade-in">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-6 fw-bold mb-2">
                <i class="fas fa-users me-3"></i>
                Kelola Data Siswa
            </h1>
            <p class="lead mb-0 opacity-75">
                Manajemen data siswa yang terdaftar dalam Aspirasi Web
            </p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('admin.siswa.create') }}" class="btn btn-success btn-lg shadow-lg">
                <i class="fas fa-user-plus me-2"></i>Tambah Siswa
            </a>
        </div>
    </div>
</div>

<!-- Statistics Bar -->
<div class="stats-bar slide-in">
    <div class="row text-center">
        <div class="col-md-3">
            <div class="fw-bold text-light fs-4">{{ $siswas->total() }}</div>
            <small class="text-muted-custom">Total Siswa</small>
        </div>
        <div class="col-md-3">
            @php
                $siswaAktif = $siswas->filter(function($siswa) {
                    return $siswa->inputaspirasis->count() > 0;
                })->count();
            @endphp
            <div class="fw-bold text-success fs-4">{{ $siswaAktif }}</div>
            <small class="text-muted-custom">Siswa Aktif</small>
        </div>
        <div class="col-md-3">
            @php
                $totalAspirasi = $siswas->sum(function($siswa) {
                    return $siswa->inputaspirasis->count();
                });
            @endphp
            <div class="fw-bold text-info fs-4">{{ $totalAspirasi }}</div>
            <small class="text-muted-custom">Total Aspirasi</small>
        </div>
        <div class="col-md-3">
            @php
                $rataRata = $siswas->count() > 0 ? round($totalAspirasi / $siswas->count(), 1) : 0;
            @endphp
            <div class="fw-bold text-warning fs-4">{{ $rataRata }}</div>
            <small class="text-muted-custom">Rata-rata per Siswa</small>
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
        <form method="GET" action="{{ route('admin.siswa.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label fw-semibold">
                        <i class="fas fa-search me-1"></i>Pencarian
                    </label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" 
                           placeholder="NIS, nama, kelas, jurusan...">
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
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-refresh"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="alert alert-info py-2 mb-0">
                        <i class="fas fa-info-circle"></i>
                        <strong>{{ $siswas->total() }}</strong> siswa ditemukan
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
                            <i class="fas fa-hashtag me-1"></i>No
                        </th>
                        <th class="text-white fw-semibold">
                            <i class="fas fa-id-card me-1"></i>NIS
                        </th>
                        <th class="text-white fw-semibold">
                            <i class="fas fa-graduation-cap me-1"></i>Kelas
                        </th>
                        <th class="text-white fw-semibold">
                            <i class="fas fa-book me-1"></i>Jurusan
                        </th>
                        <th class="text-white fw-semibold">
                            <i class="fas fa-calendar me-1"></i>Terdaftar
                        </th>
                        <th class="text-white fw-semibold">
                            <i class="fas fa-comments me-1"></i>Aspirasi
                        </th>
                        <th class="text-white fw-semibold">
                            <i class="fas fa-cog me-1"></i>Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $index => $siswa)
                        <tr class="slide-in" style="animation-delay: {{ $index * 0.05 }}s;">
                            <td>
                                <span class="badge bg-secondary">{{ $siswas->firstItem() + $index }}</span>
                            </td>
                            <td class="text-light">
                                <div class="fw-bold">{{ $siswa->nis }}</div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <div class="fw-semibold text-light-custom">{{ $siswa->kelas }}</div>
                                    <small class="text-muted-custom d-block">Kelas</small>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <div class="fw-semibold text-light-custom">{{ $siswa->jurusan }}</div>
                                    <small class="text-muted-custom d-block">Jurusan</small>
                                </div>
                            </td>
                            <td class="text-light">
                                <div>{{ $siswa->created_at->format('d/m/Y') }}</div>
                                <small class="text-muted-custom">{{ $siswa->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                @php
                                    $jumlahAspirasi = $siswa->inputaspirasis->count();
                                    $badgeClass = $jumlahAspirasi > 0 ? 'bg-success' : 'bg-secondary';
                                @endphp
                                <span class="badge {{ $badgeClass }} fs-6">
                                    {{ $jumlahAspirasi }} Aspirasi
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.siswa.edit', $siswa) }}" 
                                       class="btn btn-sm btn-warning" 
                                       title="Edit Data"
                                       style="min-width: 35px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.siswa.destroy', $siswa) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('{{ $siswa->inputaspirasis->count() > 0 ? 'PERINGATAN: Siswa ini memiliki ' . $siswa->inputaspirasis->count() . ' Aspirasi. Menghapus siswa akan menghapus semua Aspirasi terkait. Yakin ingin melanjutkan?' : 'Yakin ingin menghapus siswa ini?' }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm {{ $siswa->inputaspirasis->count() > 0 ? 'btn-danger' : 'btn-danger' }}"
                                                title="{{ $siswa->inputaspirasis->count() > 0 ? 'Hapus Siswa + Aspirasi' : 'Hapus Siswa' }}"
                                                style="min-width: 35px;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                @if($siswa->inputaspirasis->count() > 0)
                                    <div class="mt-1">
                                        <small class="text-warning d-block">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $siswa->inputaspirasis->count() }} Aspirasi
                                        </small>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted-custom py-5">
                                <i class="fas fa-users fa-3x mb-3 d-block"></i>
                                <h5>Belum ada data siswa</h5>
                                <p class="mb-0">Data siswa akan muncul di sini setelah ditambahkan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    @if($siswas->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $siswas->appends(request()->query())->links() }}
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
    const perPageSelect = document.getElementById('per_page');
    const form = dateFromInput.closest('form');
    
    function autoSubmit() {
        form.submit();
    }
    
    if (dateFromInput) dateFromInput.addEventListener('change', autoSubmit);
    if (dateToInput) dateToInput.addEventListener('change', autoSubmit);
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