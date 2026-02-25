@extends('layouts.admin')

@section('title', 'Tambah Siswa')

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

.input-group-text {
    background: var(--secondary-blue);
    border-color: rgba(100, 116, 139, 0.5);
    color: var(--text-light);
}

.form-floating > label {
    color: var(--text-muted);
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label {
    color: var(--accent-blue);
}

.preview-card {
    background: rgba(59, 130, 246, 0.1);
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: 12px;
    padding: 1.5rem;
}

.preview-item {
    text-align: center;
    padding: 1rem;
    background: rgba(51, 65, 85, 0.4);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.preview-item:hover {
    background: rgba(51, 65, 85, 0.6);
    transform: translateY(-2px);
}

.preview-label {
    display: block;
    color: #94a3b8;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.preview-value {
    color: #ffffff;
    font-size: 1.25rem;
    font-weight: 700;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

#previewSection {
    animation: fadeInDown 0.4s ease-out;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header fade-in">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-6 fw-bold mb-2">
                <i class="fas fa-user-plus me-3"></i>
                Tambah Siswa Baru
            </h1>
            <p class="lead mb-0 opacity-75">
                Daftarkan siswa baru ke dalam Aspirasi Web
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
                    Form Data Siswa
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.siswa.store') }}" method="POST" id="siswaForm">
                    @csrf
                    
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
                                   value="{{ old('nis') }}" 
                                   placeholder="Masukkan NIS siswa (maksimal 10 digit)" 
                                   maxlength="10" 
                                   required>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted-custom d-block mt-2">
                                <i class="fas fa-info-circle me-1"></i>
                                Masukkan NIS siswa (maksimal 10 digit angka)
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
                                        <option value="X" {{ old('kelas') == 'X' ? 'selected' : '' }}>Kelas X</option>
                                        <option value="XI" {{ old('kelas') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                                        <option value="XII" {{ old('kelas') == 'XII' ? 'selected' : '' }}>Kelas XII</option>
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
                                        <option value="Teknik Elektronika" {{ old('jurusan') == 'Teknik Elektronika' ? 'selected' : '' }}>Teknik Elektronika</option>
                                        <option value="Teknik Kimia Industri" {{ old('jurusan') == 'Teknik Kimia Industri' ? 'selected' : '' }}>Teknik Kimia Industri</option>
                                        <option value="Kimia Analisis" {{ old('jurusan') == 'Kimia Analisis' ? 'selected' : '' }}>Kimia Analisis</option>
                                        <option value="Teknik Ketenagalistrikan" {{ old('jurusan') == 'Teknik Ketenagalistrikan' ? 'selected' : '' }}>Teknik Ketenagalistrikan</option>
                                        <option value="Teknik Otomotif" {{ old('jurusan') == 'Teknik Otomotif' ? 'selected' : '' }}>Teknik Otomotif</option>
                                        <option value="Teknik Mesin" {{ old('jurusan') == 'Teknik Mesin' ? 'selected' : '' }}>Teknik Mesin</option>
                                        <option value="Pengelasan dan Fabrikasi Logam" {{ old('jurusan') == 'Pengelasan dan Fabrikasi Logam' ? 'selected' : '' }}>Pengelasan dan Fabrikasi Logam</option>
                                        <option value="Teknik Pengembangan Perangkat Lunak dan Gim" {{ old('jurusan') == 'Teknik Pengembangan Perangkat Lunak dan Gim' ? 'selected' : '' }}>Teknik Pengembangan Perangkat Lunak dan Gim</option>
                                        <option value="Teknologi Farmasi" {{ old('jurusan') == 'Teknologi Farmasi' ? 'selected' : '' }}>Teknologi Farmasi</option>
                                    </select>
                                    @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Section -->
                    <div class="form-section" id="previewSection" style="display: none;">
                        <h6><i class="fas fa-eye me-2"></i>Preview Data</h6>
                        <div class="preview-card">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="preview-item">
                                        <label class="preview-label">
                                            <i class="fas fa-id-badge me-2"></i>NIS
                                        </label>
                                        <div class="preview-value" id="previewNis">-</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="preview-item">
                                        <label class="preview-label">
                                            <i class="fas fa-chalkboard me-2"></i>Kelas
                                        </label>
                                        <div class="preview-value" id="previewKelas">-</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="preview-item">
                                        <label class="preview-label">
                                            <i class="fas fa-tools me-2"></i>Jurusan
                                        </label>
                                        <div class="preview-value" id="previewJurusan">-</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-info btn-lg" id="previewBtn">
                                <i class="fas fa-eye me-2"></i>Preview
                            </button>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save me-2"></i>Simpan Data
                            </button>
                        </div>
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
    const previewBtn = document.getElementById('previewBtn');
    const previewSection = document.getElementById('previewSection');
    
    // Form validation
    const nisInput = document.getElementById('nis');
    const kelasSelect = document.getElementById('kelas');
    const jurusanSelect = document.getElementById('jurusan');
    
    // NIS validation
    nisInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
        updatePreview();
    });
    
    // Update preview when inputs change
    function updatePreview() {
        const nisValue = nisInput.value || '-';
        const kelasValue = kelasSelect.value || '-';
        const jurusanValue = jurusanSelect.options[jurusanSelect.selectedIndex].text || '-';
        
        document.getElementById('previewNis').textContent = nisValue;
        document.getElementById('previewKelas').textContent = kelasValue;
        document.getElementById('previewJurusan').textContent = jurusanValue === 'Pilih Jurusan' ? '-' : jurusanValue;
    }
    
    // Preview button
    previewBtn.addEventListener('click', function() {
        updatePreview();
        if (previewSection.style.display === 'none') {
            previewSection.style.display = 'block';
            // Smooth scroll with offset
            setTimeout(() => {
                previewSection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
            this.innerHTML = '<i class="fas fa-eye-slash me-2"></i>Sembunyikan Preview';
            this.classList.remove('btn-info');
            this.classList.add('btn-warning');
        } else {
            previewSection.style.display = 'none';
            this.innerHTML = '<i class="fas fa-eye me-2"></i>Preview';
            this.classList.remove('btn-warning');
            this.classList.add('btn-info');
        }
    });
    
    // Auto update preview when fields change
    [nisInput, kelasSelect, jurusanSelect].forEach(element => {
        element.addEventListener('change', updatePreview);
        element.addEventListener('input', updatePreview);
    });
    
    // Form submission validation
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = [nisInput, kelasSelect, jurusanSelect];
        
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