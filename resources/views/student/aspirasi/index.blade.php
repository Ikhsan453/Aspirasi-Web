@extends('layouts.app')

@section('title', 'Aspirasi Siswa')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header text-center py-4">
                    <h3 class="mb-0"><i class="fas fa-bullhorn me-2"></i>Sistem Aspirasi Siswa</h3>
                </div>
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-clipboard-list fa-5x text-primary mb-3"></i>
                        <p class="lead">Sampaikan Aspirasi Anda mengenai sarana dan prasarana sekolah</p>
                    </div>

                    <div class="d-grid gap-3">
                        <a href="{{ route('student.aspirasi.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle me-2"></i>Buat Aspirasi Baru
                        </a>
                        <a href="{{ route('student.aspirasi.status') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-search me-2"></i>Cek Status aspirasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
