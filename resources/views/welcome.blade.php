@extends('layouts.app')

@section('title', 'Beranda - Aspirasi Web')

@push('styles')
<style>
.hero-section {
    background: var(--gradient-accent);
    border-radius: 24px;
    padding: 4rem 3rem;
    margin-bottom: 4rem;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.hero-section::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.feature-card {
    background: rgba(30, 41, 59, 0.95);
    border: 1px solid rgba(51, 65, 85, 0.5);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    transition: all 0.4s ease;
    height: 100%;
    overflow: hidden;
    position: relative;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient-accent);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.feature-card:hover::before {
    transform: scaleX(1);
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
    border-color: var(--accent-blue);
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: var(--gradient-accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    transition: all 0.3s ease;
}

.feature-card:hover .feature-icon {
    transform: scale(1.1);
}

.step-circle {
    width: 80px;
    height: 80px;
    background: var(--gradient-accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    position: relative;
    transition: all 0.3s ease;
}

.step-circle:hover {
    transform: scale(1.1);
}

.step-circle::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    border: 2px solid var(--accent-blue);
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    100% { transform: scale(1.2); opacity: 0; }
}

.section-title {
    position: relative;
    display: inline-block;
    margin-bottom: 3rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: var(--gradient-accent);
    border-radius: 2px;
}

.stats-section {
    background: rgba(30, 41, 59, 0.8);
    border-radius: 20px;
    padding: 3rem 2rem;
    margin: 3rem 0;
    backdrop-filter: blur(10px);
}

.stat-item {
    text-align: center;
    padding: 1rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--accent-blue);
    display: block;
}

.cta-section {
    background: var(--gradient-primary);
    border-radius: 20px;
    padding: 3rem 2rem;
    text-align: center;
    border: 1px solid var(--secondary-blue);
}
</style>
@endpush

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="hero-section fade-in">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold text-white mb-4">
                    <i class="fas fa-bullhorn me-3"></i>
                    Sistem Aspirasi Web
                </h1>
                <p class="lead text-white mb-4 opacity-90">
                    Platform digital yang memudahkan siswa untuk melaporkan kerusakan atau masalah sarana dan prasarana sekolah. 
                    Laporkan masalah dengan mudah dan pantau status penanganannya secara real-time.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a class="btn btn-success btn-lg px-4 py-3 shadow-lg" href="{{ route('student.aspirasi.create') }}" style="font-size: 1.2rem; font-weight: 800;">
                        <i class="fas fa-plus-circle me-2"></i>Buat Aspirasi Baru
                    </a>
                    <a class="btn btn-info btn-lg px-4 py-3 shadow-lg" href="{{ route('student.aspirasi.status') }}" style="font-size: 1.2rem; font-weight: 800;">
                        <i class="fas fa-search me-2"></i>Cek Status Aspirasi
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="position-relative">
                    <i class="fas fa-school text-white opacity-25" style="font-size: 12rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    @php
        $totalAspirasi = \App\Models\Inputaspirasi::count();
        $totalKategori = \App\Models\Kategori::count();
        $totalSiswa = \App\Models\Siswa::count();
    @endphp
    <div class="stats-section slide-in">
        <div class="row">
            <div class="col-md-4">
                <div class="stat-item">
                    <span class="stat-number">{{ $totalAspirasi }}</span>
                    <h5 class="text-light mt-2">Total Aspirasi</h5>
                    <p class="text-muted-custom mb-0">Laporan yang telah masuk</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <span class="stat-number">{{ $totalKategori }}</span>
                    <h5 class="text-light mt-2">Kategori Tersedia</h5>
                    <p class="text-muted-custom mb-0">Jenis kerusakan yang dapat dilaporkan</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <span class="stat-number">{{ $totalSiswa }}</span>
                    <h5 class="text-light mt-2">Siswa Terdaftar</h5>
                    <p class="text-muted-custom mb-0">Pengguna aktif sistem</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="text-center mb-5">
        <h2 class="section-title text-light">
            <i class="fas fa-star me-2"></i>Fitur Unggulan
        </h2>
    </div>
    
    <div class="row mb-5">
        <div class="col-lg-4 mb-4">
            <div class="card feature-card slide-in">
                <div class="card-body text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-camera fa-2x text-white"></i>
                    </div>
                    <h5 class="card-title text-light fw-bold mb-3">Upload Foto Bukti</h5>
                    <p class="card-text text-muted-custom">
                        Sertakan foto sebagai bukti untuk memperjelas kondisi kerusakan atau masalah yang dilaporkan. 
                        Foto membantu admin memahami situasi dengan lebih baik.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card feature-card slide-in" style="animation-delay: 0.2s;">
                <div class="card-body text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-history fa-2x text-white"></i>
                    </div>
                    <h5 class="card-title text-light fw-bold mb-3">Tracking Real-time</h5>
                    <p class="card-text text-muted-custom">
                        Pantau perkembangan Aspirasi Anda secara real-time dengan riwayat lengkap mulai dari 
                        menunggu review hingga selesai ditangani.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card feature-card slide-in" style="animation-delay: 0.4s;">
                <div class="card-body text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-tags fa-2x text-white"></i>
                    </div>
                    <h5 class="card-title text-light fw-bold mb-3">Kategori Lengkap</h5>
                    <p class="card-text text-muted-custom">
                        Pilih kategori yang sesuai dengan jenis kerusakan untuk memudahkan proses penanganan 
                        dan mempercepat respon dari pihak sekolah.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="text-center mb-5">
        <h2 class="section-title text-light">
            <i class="fas fa-question-circle me-2"></i>Cara Menggunakan
        </h2>
    </div>
    
    <div class="row mb-5">
        <div class="col-md-3 text-center mb-4">
            <div class="slide-in">
                <div class="step-circle">
                    <span class="h3 mb-0 text-white fw-bold">1</span>
                </div>
                <h5 class="text-light fw-bold">Isi Form Aspirasi</h5>
                <p class="text-muted-custom">
                    Lengkapi data diri dan detail Aspirasi dengan informasi yang jelas dan akurat
                </p>
            </div>
        </div>
        <div class="col-md-3 text-center mb-4">
            <div class="slide-in" style="animation-delay: 0.2s;">
                <div class="step-circle">
                    <span class="h3 mb-0 text-white fw-bold">2</span>
                </div>
                <h5 class="text-light fw-bold">Upload Foto</h5>
                <p class="text-muted-custom">
                    Sertakan foto sebagai bukti pendukung untuk memperjelas kondisi yang dilaporkan
                </p>
            </div>
        </div>
        <div class="col-md-3 text-center mb-4">
            <div class="slide-in" style="animation-delay: 0.4s;">
                <div class="step-circle">
                    <span class="h3 mb-0 text-white fw-bold">3</span>
                </div>
                <h5 class="text-light fw-bold">Submit Laporan</h5>
                <p class="text-muted-custom">
                    Kirim Aspirasi dan dapatkan nomor tracking untuk memantau status
                </p>
            </div>
        </div>
        <div class="col-md-3 text-center mb-4">
            <div class="slide-in" style="animation-delay: 0.6s;">
                <div class="step-circle">
                    <span class="h3 mb-0 text-white fw-bold">4</span>
                </div>
                <h5 class="text-light fw-bold">Pantau Progress</h5>
                <p class="text-muted-custom">
                    Cek status penanganan Aspirasi Anda secara berkala hingga selesai
                </p>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="cta-section slide-in">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="text-light fw-bold mb-3">
                    <i class="fas fa-rocket me-2"></i>
                    Siap Membuat Aspirasi?
                </h3>
                <p class="text-muted-custom mb-4">
                    Jangan biarkan masalah sarana sekolah mengganggu proses belajar. 
                    Laporkan sekarang dan bantu menciptakan lingkungan belajar yang lebih baik.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('student.aspirasi.create') }}" class="btn btn-success btn-lg px-4 shadow-lg" style="font-size: 1.1rem; font-weight: 800;">
                        <i class="fas fa-plus-circle me-2"></i>Mulai Buat Aspirasi
                    </a>
                    <a href="{{ route('student.aspirasi.status') }}" class="btn btn-info btn-lg px-4 shadow-lg" style="font-size: 1.1rem; font-weight: 800;">
                        <i class="fas fa-search me-2"></i>Cek Status Existing
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection