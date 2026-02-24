@extends('layouts.app')

@section('title', 'Aspirasi Berhasil Dikirim')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle fa-5x text-success"></i>
                    </div>
                    <h3 class="mb-3">Aspirasi Berhasil Dikirim!</h3>
                    <p class="text-muted mb-4">
                        Terima kasih telah melaporkan Aspirasi Anda. Tim kami akan segera menindaklanjuti laporan Anda.
                    </p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('student.aspirasi.status') }}" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Cek Status aspirasi
                        </a>
                        <a href="{{ route('student.aspirasi.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus-circle me-2"></i>Buat Aspirasi Lagi
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
