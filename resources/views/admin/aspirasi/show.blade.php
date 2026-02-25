@extends('layouts.admin')

@section('title', 'Detail Aspirasi')

@push('styles')
<style>
.page-header {
    background: var(--gradient-accent);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    color: white;
}

.detail-card {
    background: rgba(30, 41, 59, 0.95);
    border: 1px solid rgba(51, 65, 85, 0.5);
    border-radius: 16px;
    backdrop-filter: blur(10px);
}

.info-table {
    background: rgba(51, 65, 85, 0.3);
    border-radius: 12px;
    padding: 1.5rem;
}

.info-table .table {
    margin-bottom: 0;
}

.info-table .table td {
    border: none;
    padding: 0.75rem 0;
    color: var(--text-light);
    vertical-align: middle;
}

.info-table .table td:first-child {
    font-weight: 600;
    color: rgba(203, 213, 225, 0.9);
    width: 40%;
}

.info-table .table td:last-child {
    color: rgba(241, 245, 249, 0.95);
}

.status-form-card {
    background: rgba(30, 41, 59, 0.95);
    border: 1px solid rgba(51, 65, 85, 0.5);
    border-radius: 16px;
    backdrop-filter: blur(10px);
    position: sticky;
    top: 2rem;
}

.history-card {
    background: rgba(30, 41, 59, 0.95);
    border: 1px solid rgba(51, 65, 85, 0.5);
    border-radius: 16px;
    backdrop-filter: blur(10px);
}

.photo-container {
    background: rgba(51, 65, 85, 0.3);
    border-radius: 12px;
    padding: 1rem;
    text-align: center;
}

.photo-container img {
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
}
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header fade-in">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-6 fw-bold mb-2">
                <i class="fas fa-eye me-3"></i>
                Detail Aspirasi #{{ $inputAspirasi->id_pelaporan }}
            </h1>
            <p class="lead mb-0 opacity-75">
                Informasi lengkap dan kelola status Aspirasi
            </p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <!-- Basic Information -->
        <div class="card detail-card mb-4 slide-in">
            <div class="card-header">
                <h5 class="mb-0 text-white fw-semibold">
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi Aspirasi
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-table mb-3 mb-md-0">
                            <table class="table">
                                <tr>
                                    <td><i class="fas fa-hashtag me-2"></i>ID Pelaporan:</td>
                                    <td class="text-white"><strong>#{{ $inputAspirasi->id_pelaporan }}</strong></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-calendar me-2"></i>Tanggal Aspirasi:</td>
                                    <td class="text-white">{{ $inputAspirasi->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-info-circle me-2"></i>Status:</td>
                                    <td>
                                        @php
                                            $currentStatus = $inputAspirasi->aspirasi;
                                            $currentStatusText = $currentStatus ? $currentStatus->status : 'Menunggu';
                                            $statusClass = match($currentStatusText) {
                                                'Menunggu' => 'bg-warning text-dark',
                                                'Proses' => 'bg-info',
                                                'Selesai' => 'bg-success',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-3 py-2">{{ $currentStatusText }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-table">
                            <table class="table">
                                <tr>
                                    <td><i class="fas fa-user me-2"></i>NIS Pelapor:</td>
                                    <td class="text-white"><strong>{{ $inputAspirasi->nis }}</strong></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-graduation-cap me-2"></i>Kelas:</td>
                                    <td class="text-white">{{ $inputAspirasi->siswa->kelas ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-book me-2"></i>Jurusan:</td>
                                    <td class="text-white">{{ $inputAspirasi->siswa->jurusan ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="info-table">
                            <table class="table">
                                <tr>
                                    <td style="width: 20%;"><i class="fas fa-tag me-2"></i>Kategori:</td>
                                    <td>
                                        <span class="badge bg-warning text-dark px-3 py-2 fs-6" style="display: inline-block; white-space: normal; text-align: left; line-height: 1.4;">
                                            {{ $inputAspirasi->kategori->ket_kategori }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-map-marker-alt me-2"></i>Lokasi:</td>
                                    <td class="text-white">{{ $inputAspirasi->lokasi }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="card detail-card mb-4 slide-in">
            <div class="card-header">
                <h5 class="mb-0 text-white fw-semibold">
                    <i class="fas fa-comment-alt me-2"></i>
                    Keterangan Detail
                </h5>
            </div>
            <div class="card-body">
                <div class="info-table">
                    <p class="text-light mb-0" style="line-height: 1.6;">{{ $inputAspirasi->ket }}</p>
                </div>
            </div>
        </div>

        <!-- Photo -->
        @if($inputAspirasi->foto)
        <div class="card detail-card mb-4 slide-in">
            <div class="card-header">
                <h5 class="mb-0 text-white fw-semibold">
                    <i class="fas fa-camera me-2"></i>
                    Foto Pendukung
                </h5>
            </div>
            <div class="card-body">
                <div class="photo-container">
                    <img src="{{ asset('storage/aspirasi/' . $inputAspirasi->foto) }}" 
                         class="img-fluid" 
                         style="max-height: 400px;" 
                         alt="Foto Aspirasi">
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Status Update Form -->
        <div class="card status-form-card mb-4 slide-in">
            <div class="card-header">
                <h5 class="mb-0 text-white fw-semibold">
                    <i class="fas fa-cogs me-2"></i>
                    Update Status
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.aspirasi.update-status', $inputAspirasi) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">
                            <i class="fas fa-info-circle me-1"></i>Status
                        </label>
                        <select class="form-select form-select-lg @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="Menunggu" {{ $currentStatusText == 'Menunggu' ? 'selected' : '' }}>
                                Menunggu Review
                            </option>
                            <option value="Proses" {{ $currentStatusText == 'Proses' ? 'selected' : '' }}>
                                Dalam Proses
                            </option>
                            <option value="Selesai" {{ $currentStatusText == 'Selesai' ? 'selected' : '' }}>
                                Selesai Ditangani
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="feedback" class="form-label fw-semibold">
                            <i class="fas fa-comment me-1"></i>Feedback
                        </label>
                        <textarea class="form-control @error('feedback') is-invalid @enderror" 
                                  id="feedback" name="feedback" rows="4" 
                                  placeholder="Berikan feedback atau keterangan tambahan...">{{ old('feedback', $currentStatus->feedback ?? '') }}</textarea>
                        @error('feedback')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save me-2"></i>Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Current Feedback -->
        @if($currentStatus && $currentStatus->feedback)
        <div class="card history-card mb-4 slide-in">
            <div class="card-header">
                <h6 class="mb-0 text-white fw-semibold">
                    <i class="fas fa-comment me-2"></i>Feedback Terakhir
                </h6>
            </div>
            <div class="card-body">
                <div class="info-table">
                    <p class="text-light mb-2">{{ $currentStatus->feedback }}</p>
                    <small class="text-muted-custom">
                        <i class="fas fa-clock me-1"></i>
                        Diupdate: {{ $currentStatus->updated_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
        @endif

        <!-- Status History -->
        @php
            $statusHistories = \App\Models\AspirasiStatusHistory::where('id_pelaporan', $inputAspirasi->id_pelaporan)
                                ->orderBy('created_at', 'desc')
                                ->get();
        @endphp
        @if($statusHistories->count() > 0)
        <div class="card history-card slide-in">
            <div class="card-header">
                <h6 class="mb-0 text-white fw-semibold">
                    <i class="fas fa-history me-2"></i>Riwayat Status
                </h6>
            </div>
            <div class="card-body">
                @foreach($statusHistories as $history)
                    <div class="timeline-item @if($loop->first) bg-primary @endif mb-2">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="badge 
                                    @switch($history->status)
                                        @case('Menunggu') bg-warning text-dark @break
                                        @case('Proses') bg-info @break
                                        @case('Selesai') bg-success @break
                                        @default bg-secondary
                                    @endswitch
                                ">{{ $history->status }}</span>
                                @if($history->feedback)
                                    <div class="mt-1">
                                        <small class="text-light">{{ $history->feedback }}</small>
                                    </div>
                                @endif
                            </div>
                            <div class="text-end">
                                <small class="text-muted-custom">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $history->created_at->format('d/m H:i') }}
                                </small>
                                @if($history->changed_by)
                                    <br>
                                    <small class="text-muted-custom">
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
</div>
@endsection