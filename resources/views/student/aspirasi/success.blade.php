@extends('layouts.app')

@section('title', 'Aspirasi Berhasil Dikirim')

@push('styles')
<style>
/* Ensure button text is always visible */
.btn-primary,
.btn-info,
.btn-secondary {
    color: #ffffff !important;
}

.btn-primary:hover,
.btn-info:hover,
.btn-secondary:hover {
    color: #ffffff !important;
}

/* Additional styling for success page */
.success-icon {
    animation: scaleIn 0.5s ease-out;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.card {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                <div class="card-body text-center p-5">
                    <div class="mb-4 success-icon">
                        <i class="fas fa-check-circle fa-5x text-success"></i>
                    </div>
                    <h3 class="mb-3 text-white">Aspirasi Berhasil Dikirim!</h3>
                    <p class="text-muted-custom mb-4">
                        Terima kasih telah melaporkan Aspirasi Anda. Tim kami akan segera menindaklanjuti laporan Anda.
                    </p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('student.aspirasi.status') }}" class="btn btn-primary" style="color: #ffffff !important;">
                            <i class="fas fa-search me-2"></i>Cek Status aspirasi
                        </a>
                        <a href="{{ route('student.aspirasi.create') }}" class="btn btn-info" style="color: #ffffff !important;">
                            <i class="fas fa-plus-circle me-2"></i>Buat Aspirasi Lagi
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-secondary" style="color: #ffffff !important;">
                            <i class="fas fa-home me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
