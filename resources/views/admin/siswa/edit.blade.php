@extends('layouts.admin')

@section('title', 'Edit Siswa')

@push('styles')
<style>
.page-header {
    background: var(--gradient-accent);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    color: white;
}

.form-card {
    background: rgba(30, 41, 59, 0.95);
    border: 1px solid rgba(51, 65, 85, 0.5);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    box-shadow: var(--shadow-lg);
}

.form-section {
    background: rgba(51, 65, 85, 0.3);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-section h6 {
    color: var(--accent-blue);
    margin-bottom: 1rem;
    font-weight: 600;
}
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header fade-in">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-6 fw-bold mb-2">
                <i class="fas fa-user-edit me-3"></i>
                Edit Data Siswa
            </h1>
            <p class="lead mb-0 opacity-75">
                Perbarui informasi siswa di Aspirasi Web
            </p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card form-card slide-in">
            <div class="card-header">
                <h5 class="mb-0 text-white fw-semibold">
                    <i class="fas fa-user-edit me-2"></i>
                    Form Edit Siswa
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.siswa.update', $siswa) }}" method="POST" id="siswaForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Identitas Section -->
                    <div class="form-section">
                        <h6><i class="fas fa-id-card me-2"></i>Identitas Siswa</h6>
                        
                        <div class="mb-3">
                            <label for="nis" class="form-label text-white fw-semibold">
                                <i class="fas fa-id-badge me-2"></i>Nomor Induk Siswa (NIS)
                                <span class="badge bg-danger ms-2">WAJIB</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('nis') is-invalid @enderror" 
                                   id="nis" 
                                   name="nis" 
                                   value="{{ old('nis', $siswa->nis) }}" 
                                   placeholder="Masukkan NIS siswa (maksimal 10 digit)" 
                                   maxlength="10" 
                                   required>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted-custom d-block mt-2">
                                <i class="fas fa-info-circle me-1"></i>
                                NIS siswa (maksimal 10 digit angka)
                            </small>
                        </div>
                    </div>

                    <!-- Academic Section -->
                    <div class="form-section">
                        <h6><i class="fas fa-graduation-cap me-2"></i>Informasi Akademik</h6>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kelas" class="form-label text-white fw-semibold">
                                        <i class="fas fa-chalkboard me-2"></i>Kelas
                                        <span class="badge bg-danger ms-2">WAJIB</span>
                                    </label>
                                    <select class="form-select form-select-lg @error('kelas') is-invalid @enderror" 
                                            id="kelas" name="kelas" required>
                                        <option value="">-- Pilih Kelas --</option>
                                        <option value="X" {{ old('kelas', $siswa->kelas) == 'X' ? 'selected' : '' }}>Kelas X</option>
                                        <option value="XI" {{ old('kelas', $siswa->kelas) == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                                        <option value="XII" {{ old('kelas', $siswa->kelas) == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                                    </select>
                                    @error('kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jurusan" class="form-label text-white fw-semibold">
                                        <i class="fas fa-tools me-2"></i>Jurusan/Kompetensi Keahlian
                                        <span class="badge bg-danger ms-2">WAJIB</span>
                                    </label>
                                    <select class="form-select form-select-lg @error('jurusan') is-invalid @enderror" 
                                            id="jurusan" name="jurusan" required>
                                        <option value="">-- Pilih Jurusan --</option>
                                        <option value="Teknik Elektronika" {{ old('jurusan', $siswa->jurusan) == 'Teknik Elektronika' ? 'selected' : '' }}>Teknik Elektronika</option>
                                        <option value="Teknik Kimia Industri" {{ old('jurusan', $siswa->jurusan) == 'Teknik Kimia Industri' ? 'selected' : '' }}>Teknik Kimia Industri</option>
                                        <option value="Kimia Analisis" {{ old('jurusan', $siswa->jurusan) == 'Kimia Analisis' ? 'selected' : '' }}>Kimia Analisis</option>
                                        <option value="Teknik Ketenagalistrikan" {{ old('jurusan', $siswa->jurusan) == 'Teknik Ketenagalistrikan' ? 'selected' : '' }}>Teknik Ketenagalistrikan</option>
                                        <option value="Teknik Otomotif" {{ old('jurusan', $siswa->jurusan) == 'Teknik Otomotif' ? 'selected' : '' }}>Teknik Otomotif</option>
                                        <option value="Teknik Mesin" {{ old('jurusan', $siswa->jurusan) == 'Teknik Mesin' ? 'selected' : '' }}>Teknik Mesin</option>
                                        <option value="Pengelasan dan Fabrikasi Logam" {{ old('jurusan', $siswa->jurusan) == 'Pengelasan dan Fabrikasi Logam' ? 'selected' : '' }}>Pengelasan dan Fabrikasi Logam</option>
                                        <option value="Teknik Pengembangan Perangkat Lunak dan Gim" {{ old('jurusan', $siswa->jurusan) == 'Teknik Pengembangan Perangkat Lunak dan Gim' ? 'selected' : '' }}>Teknik Pengembangan Perangkat Lunak dan Gim</option>
                                        <option value="Teknologi Farmasi" {{ old('jurusan', $siswa->jurusan) == 'Teknologi Farmasi' ? 'selected' : '' }}>Teknologi Farmasi</option>
                                    </select>
                                    @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('siswaForm');
    const nisInput = document.getElementById('nis');
    
    // NIS validation - only numbers
    nisInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
    
    // Form submission validation
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = [
            nisInput, 
            document.getElementById('kelas'), 
            document.getElementById('jurusan')
        ];
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi!');
        }
    });
});
</script>
@endpush