@extends('layouts.app')

@section('title', 'Cek Status aspirasi')

@push('styles')
<style>
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
</style>
@endpush

@section('content')
<div class="container">
    <!-- Search Section -->
    <div class="card border-0 shadow-lg mb-4 fade-in" style="background: rgba(30, 41, 59, 0.95); border: 1px solid rgba(51, 65, 85, 0.5) !important; border-radius: 16px;">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <h4 class="mb-1 text-white fw-semibold">
                        <i class="fas fa-search me-2"></i>Cek Status aspirasi
                    </h4>
                    <p class="mb-0 text-muted-custom small">Masukkan NIS untuk melihat aspirasi</p>
                </div>
                <div class="col-lg-8">
                    <form method="POST" action="{{ route('student.aspirasi.check-status') }}" id="searchForm">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col-md-8">
                                <label for="nis" class="form-label fw-semibold text-light small mb-1">
                                    <i class="fas fa-id-card me-1"></i>Nomor Induk Siswa (NIS)
                                </label>
                                <input type="text" class="form-control form-control-lg @error('nis') is-invalid @enderror" 
                                       id="nis" name="nis" value="{{ old('nis', request('nis')) }}" 
                                       required maxlength="10" placeholder="Contoh: 1234567890"
                                       autofocus>
                                @error('nis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(isset($aspirasis))
        <!-- Statistics Bar -->
        <div class="stats-bar slide-in">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="fw-bold text-light fs-4">{{ $totalAspirasi ?? 0 }}</div>
                    <small class="text-muted-custom">Total aspirasi</small>
                </div>
                <div class="col-md-3">
                    <div class="fw-bold text-warning fs-4">{{ $menunggu ?? 0 }}</div>
                    <small class="text-muted-custom">Menunggu</small>
                </div>
                <div class="col-md-3">
                    <div class="fw-bold text-info fs-4">{{ $proses ?? 0 }}</div>
                    <small class="text-muted-custom">Dalam Proses</small>
                </div>
                <div class="col-md-3">
                    <div class="fw-bold text-success fs-4">{{ $selesai ?? 0 }}</div>
                    <small class="text-muted-custom">Selesai</small>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        @if($aspirasis->count() > 0)
            <div class="card data-table-card slide-in">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <h5 class="mb-0 text-white fw-semibold">
                        <i class="fas fa-list me-2"></i>Daftar Aspirasi - NIS: {{ request('nis') }}
                    </h5>
                    <form method="POST" action="{{ route('student.aspirasi.check-status') }}" id="perPageForm" class="d-flex align-items-center gap-2">
                        @csrf
                        <input type="hidden" name="nis" value="{{ request('nis') }}">
                        <label for="per_page" class="text-white mb-0 small">
                            <i class="fas fa-list me-1"></i>Show:
                        </label>
                        <select class="form-select form-select-sm" id="per_page" name="per_page" style="width: 80px;">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: var(--gradient-accent);">
                                <tr>
                                    <th class="text-white fw-semibold">
                                        <i class="fas fa-hashtag me-1"></i>ID
                                    </th>
                                    <th class="text-white fw-semibold">
                                        <i class="fas fa-calendar me-1"></i>Tanggal
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
                                    <th class="text-white fw-semibold text-center">
                                        <i class="fas fa-cog me-1"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aspirasis as $aspirasi)
                                    @php
                                        $status = $aspirasi->aspirasi->status ?? 'Menunggu';
                                        $badgeClass = match($status) {
                                            'Menunggu' => 'bg-warning text-dark',
                                            'Proses' => 'bg-info',
                                            'Selesai' => 'bg-success',
                                            default => 'bg-secondary'
                                        };
                                        $icon = match($status) {
                                            'Menunggu' => 'fa-clock',
                                            'Proses' => 'fa-spinner',
                                            'Selesai' => 'fa-check-circle',
                                            default => 'fa-question'
                                        };
                                    @endphp
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary fs-6">#{{ $aspirasi->id_pelaporan }}</span>
                                        </td>
                                        <td class="text-light">
                                            <div>{{ $aspirasi->created_at->format('d/m/Y') }}</div>
                                            <small class="text-muted-custom">{{ $aspirasi->created_at->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning text-dark fw-semibold">
                                                {{ $aspirasi->kategori->ket_kategori ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="text-light">{{ Str::limit($aspirasi->lokasi, 30) }}</td>
                                        <td>
                                            <span class="badge {{ $badgeClass }} fs-6">
                                                <i class="fas {{ $icon }} me-1"></i>{{ $status }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" 
                                                    class="btn btn-sm btn-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#detailModal{{ $aspirasi->id_pelaporan }}"
                                                    title="Lihat Detail"
                                                    style="min-width: 35px;">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Pagination -->
                @if($aspirasis->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{ $aspirasis->appends(['nis' => request('nis'), 'per_page' => request('per_page', 10)])->links() }}
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-4"></i>
                    <h5 class="text-light mb-2">Tidak Ada Aspirasi</h5>
                    <p class="text-muted-custom mb-4">Tidak ada Aspirasi ditemukan untuk NIS: {{ request('nis') }}</p>
                    <a href="{{ route('student.aspirasi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Buat Aspirasi Baru
                    </a>
                </div>
            </div>
        @endif
    @else
        <div class="card border-0 shadow-sm slide-in">
            <div class="card-body text-center py-5">
                <i class="fas fa-search fa-4x text-primary mb-4"></i>
                <h5 class="text-light mb-2">Cari Aspirasi Anda</h5>
                <p class="text-muted-custom">Masukkan NIS Anda di form di atas untuk melihat semua Aspirasi yang telah dilaporkan</p>
            </div>
        </div>
    @endif

    <!-- Modals Section - Outside all cards -->
    @if(isset($aspirasis) && $aspirasis->count() > 0)
        @foreach($aspirasis as $aspirasi)
            <div class="modal fade" id="detailModal{{ $aspirasi->id_pelaporan }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $aspirasi->id_pelaporan }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content" style="background: rgba(30, 41, 59, 0.98); border: 1px solid rgba(51, 65, 85, 0.5);">
                        <div class="modal-header" style="border-bottom: 1px solid rgba(51, 65, 85, 0.5);">
                            <h5 class="modal-title text-white fw-semibold" id="detailModalLabel{{ $aspirasi->id_pelaporan }}">
                                <i class="fas fa-eye me-2"></i>Detail Aspirasi #{{ $aspirasi->id_pelaporan }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @php
                                $modalStatus = $aspirasi->aspirasi->status ?? 'Menunggu';
                                $modalBadgeClass = match($modalStatus) {
                                    'Menunggu' => 'bg-warning text-dark',
                                    'Proses' => 'bg-info',
                                    'Selesai' => 'bg-success',
                                    default => 'bg-secondary'
                                };
                                $modalIcon = match($modalStatus) {
                                    'Menunggu' => 'fa-clock',
                                    'Proses' => 'fa-spinner',
                                    'Selesai' => 'fa-check-circle',
                                    default => 'fa-question'
                                };
                            @endphp
                            
                            <!-- Informasi aspirasi -->
                            <div class="mb-4">
                                <h6 class="text-white fw-semibold mb-3">
                                    <i class="fas fa-info-circle me-2"></i>Informasi aspirasi
                                </h6>
                                <div style="background: rgba(51, 65, 85, 0.3); border-radius: 12px; padding: 1.5rem;">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <td style="width: 40%; color: rgba(203, 213, 225, 0.9); padding: 0.5rem 0;">
                                                <i class="fas fa-hashtag me-2"></i>ID Pelaporan
                                            </td>
                                            <td style="color: white; padding: 0.5rem 0;">
                                                <strong>#{{ $aspirasi->id_pelaporan }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: rgba(203, 213, 225, 0.9); padding: 0.5rem 0;">
                                                <i class="fas fa-calendar me-2"></i>Tanggal Laporan
                                            </td>
                                            <td style="color: white; padding: 0.5rem 0;">
                                                {{ $aspirasi->created_at->format('d/m/Y H:i') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: rgba(203, 213, 225, 0.9); padding: 0.5rem 0;">
                                                <i class="fas fa-id-card me-2"></i>NIS
                                            </td>
                                            <td style="color: white; padding: 0.5rem 0;">
                                                <strong>{{ $aspirasi->nis }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: rgba(203, 213, 225, 0.9); padding: 0.5rem 0;">
                                                <i class="fas fa-graduation-cap me-2"></i>Kelas
                                            </td>
                                            <td style="color: white; padding: 0.5rem 0;">
                                                {{ $aspirasi->siswa->kelas ?? '-' }} {{ $aspirasi->siswa->jurusan ?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: rgba(203, 213, 225, 0.9); padding: 0.5rem 0;">
                                                <i class="fas fa-tag me-2"></i>Kategori
                                            </td>
                                            <td style="padding: 0.5rem 0;">
                                                <span class="badge bg-warning text-dark px-3 py-2">
                                                    {{ $aspirasi->kategori->ket_kategori ?? '-' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: rgba(203, 213, 225, 0.9); padding: 0.5rem 0;">
                                                <i class="fas fa-info-circle me-2"></i>Status
                                            </td>
                                            <td style="padding: 0.5rem 0;">
                                                <span class="badge {{ $modalBadgeClass }} px-3 py-2">
                                                    <i class="fas {{ $modalIcon }} me-1"></i>{{ $modalStatus }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: rgba(203, 213, 225, 0.9); padding: 0.5rem 0;">
                                                <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                            </td>
                                            <td style="color: white; padding: 0.5rem 0;">
                                                {{ $aspirasi->lokasi }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-4">
                                <h6 class="text-white fw-semibold mb-3">
                                    <i class="fas fa-comment-alt me-2"></i>Keterangan Detail
                                </h6>
                                <div style="background: rgba(51, 65, 85, 0.3); border-radius: 12px; padding: 1.5rem;">
                                    <p class="text-light mb-0" style="line-height: 1.6; white-space: pre-wrap;">{{ $aspirasi->ket }}</p>
                                </div>
                            </div>

                            <!-- Foto -->
                            @if($aspirasi->foto)
                                <div class="mb-4">
                                    <h6 class="text-white fw-semibold mb-3">
                                        <i class="fas fa-camera me-2"></i>Foto Pendukung
                                    </h6>
                                    <div style="background: rgba(51, 65, 85, 0.3); border-radius: 12px; padding: 1rem; text-align: center;">
                                        @php
                                            $fotoPath = public_path('storage/aspirasi/' . $aspirasi->foto);
                                            $fotoExists = file_exists($fotoPath);
                                        @endphp
                                        @if($fotoExists)
                                            <img src="{{ asset('storage/aspirasi/' . $aspirasi->foto) }}" 
                                                 alt="Foto aspirasi" 
                                                 class="img-fluid rounded"
                                                 style="max-height: 400px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);"
                                                 onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'text-warning\'><i class=\'fas fa-exclamation-triangle me-2\'></i>Foto tidak dapat dimuat</div>';">
                                        @else
                                            <div class="text-warning">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                File foto tidak ditemukan: {{ $aspirasi->foto }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="mb-4">
                                    <h6 class="text-white fw-semibold mb-3">
                                        <i class="fas fa-camera me-2"></i>Foto Pendukung
                                    </h6>
                                    <div style="background: rgba(51, 65, 85, 0.3); border-radius: 12px; padding: 1.5rem; text-align: center;">
                                        <div class="text-muted-custom">
                                            <i class="fas fa-image fa-3x mb-2 opacity-50"></i>
                                            <p class="mb-0">Tidak ada foto dilampirkan</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Feedback -->
                            @if($aspirasi->aspirasi && $aspirasi->aspirasi->feedback)
                                <div class="mb-4">
                                    <h6 class="text-white fw-semibold mb-3">
                                        <i class="fas fa-comment-dots me-2"></i>Feedback dari Admin
                                    </h6>
                                    <div style="background: rgba(6, 182, 212, 0.1); border: 1px solid rgba(6, 182, 212, 0.3); border-radius: 12px; padding: 1.5rem;">
                                        <p class="text-light mb-2" style="line-height: 1.6;">{{ $aspirasi->aspirasi->feedback }}</p>
                                        <small class="text-muted-custom">
                                            <i class="fas fa-clock me-1"></i>
                                            Diupdate: {{ $aspirasi->aspirasi->updated_at->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            @endif

                            <!-- Riwayat Status -->
                            @php
                                $statusHistories = \App\Models\AspirasiStatusHistory::where('id_pelaporan', $aspirasi->id_pelaporan)
                                                    ->orderBy('created_at', 'desc')
                                                    ->get();
                            @endphp
                            @if($statusHistories->count() > 0)
                                <div>
                                    <h6 class="text-white fw-semibold mb-3">
                                        <i class="fas fa-history me-2"></i>Riwayat Status
                                    </h6>
                                    <div style="background: rgba(51, 65, 85, 0.3); border-radius: 12px; padding: 1rem;">
                                        @foreach($statusHistories as $history)
                                            <div class="mb-3 pb-3 @if(!$loop->last) border-bottom @endif" style="border-color: rgba(100, 116, 139, 0.3) !important;">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div class="flex-grow-1">
                                                        <span class="badge 
                                                            @switch($history->status)
                                                                @case('Menunggu') bg-warning text-dark @break
                                                                @case('Proses') bg-info @break
                                                                @case('Selesai') bg-success @break
                                                                @default bg-secondary
                                                            @endswitch
                                                            px-3 py-2">
                                                            <i class="fas 
                                                                @switch($history->status)
                                                                    @case('Menunggu') fa-clock @break
                                                                    @case('Proses') fa-spinner @break
                                                                    @case('Selesai') fa-check-circle @break
                                                                    @default fa-question
                                                                @endswitch
                                                                me-1"></i>
                                                            {{ $history->status }}
                                                        </span>
                                                        @if($history->feedback)
                                                            <div class="mt-2">
                                                                <small class="text-light" style="line-height: 1.5;">{{ $history->feedback }}</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="text-end ms-3" style="min-width: 100px;">
                                                        <small class="text-muted-custom d-block">
                                                            <i class="fas fa-clock me-1"></i>
                                                            {{ $history->created_at->format('d/m/Y') }}
                                                        </small>
                                                        <small class="text-muted-custom d-block">
                                                            {{ $history->created_at->format('H:i') }}
                                                        </small>
                                                        @if($history->changed_by)
                                                            <small class="text-muted-custom d-block mt-1">
                                                                <i class="fas fa-user me-1"></i>
                                                                {{ $history->changed_by }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer" style="border-top: 1px solid rgba(51, 65, 85, 0.5);">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit when per_page changes
    const perPageSelect = document.getElementById('per_page');
    const perPageForm = document.getElementById('perPageForm');
    
    if (perPageSelect && perPageForm) {
        perPageSelect.addEventListener('change', function() {
            // Show loading indicator
            const loadingText = document.createElement('small');
            loadingText.className = 'text-white ms-2';
            loadingText.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            this.parentElement.appendChild(loadingText);
            
            // Submit form
            perPageForm.submit();
        });
    }

    // Fix modal backdrop issue
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(button) {
        button.addEventListener('click', function() {
            // Remove any stuck backdrops
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        });
    });

    // Ensure modal closes properly
    document.querySelectorAll('.modal').forEach(function(modal) {
        modal.addEventListener('hidden.bs.modal', function () {
            // Clean up any stuck elements
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        });
    });
});
</script>
@endpush
