@extends('layouts.app')

@section('title', 'Buat Aspirasi')

@push('styles')
<style>
.create-header {
    background: var(--gradient-accent);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    color: white;
    box-shadow: var(--shadow-lg);
    position: relative;
    overflow: hidden;
}

.create-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.form-card {
    background: rgba(30, 41, 59, 0.95);
    border: 1px solid rgba(51, 65, 85, 0.5);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    box-shadow: var(--shadow-xl);
    overflow: hidden;
}

.form-section {
    background: rgba(51, 65, 85, 0.3);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid rgba(100, 116, 139, 0.3);
    transition: all 0.3s ease;
}

.form-section:hover {
    border-color: var(--accent-blue);
    background: rgba(51, 65, 85, 0.4);
    transform: translateY(-2px);
}

.form-section-title {
    color: var(--accent-blue);
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-section-title i {
    width: 30px;
    height: 30px;
    background: var(--gradient-accent);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

/* Regular form controls - no floating labels */
.form-label {
    color: #ffffff !important;
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control,
.form-select {
    color: #ffffff !important;
    background: rgba(51, 65, 85, 0.8);
    border: 1px solid rgba(100, 116, 139, 0.5);
    padding: 0.75rem 1rem;
}

.form-control:focus,
.form-select:focus {
    color: #ffffff !important;
    background: rgba(51, 65, 85, 0.9);
    border-color: var(--accent-blue);
    box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
}

.form-control::placeholder,
.form-select::placeholder {
    color: rgba(203, 213, 225, 0.5) !important;
}

.form-select option {
    background: #1e293b;
    color: #ffffff;
}

.preview-box {
    background: rgba(15, 23, 42, 0.8);
    border: 2px dashed rgba(59, 130, 246, 0.5);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.preview-box:hover {
    border-color: var(--accent-blue);
    background: rgba(15, 23, 42, 0.9);
}

.preview-box.has-image {
    border-style: solid;
    border-color: var(--success);
    padding: 1rem;
}

.preview-image {
    max-height: 300px;
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
    transition: all 0.3s ease;
}

.preview-image:hover {
    transform: scale(1.02);
}

.upload-icon {
    font-size: 3rem;
    color: var(--accent-blue);
    margin-bottom: 1rem;
    opacity: 0.7;
}

.nis-verification {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

.fade-in {
    animation: fadeIn 0.6s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.required-badge {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    font-size: 0.7rem;
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    font-weight: 700;
    margin-left: 0.5rem;
}

.submit-section {
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 2rem;
}

.btn-submit {
    background: var(--gradient-accent);
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-weight: 700;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.6);
}

.btn-back {
    background: rgba(51, 65, 85, 0.8);
    border: 1px solid rgba(100, 116, 139, 0.5);
    border-radius: 12px;
    padding: 1rem 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: rgba(51, 65, 85, 1);
    transform: translateY(-2px);
}

.char-counter {
    font-size: 0.85rem;
    color: var(--text-muted);
    text-align: right;
    margin-top: 0.25rem;
}

.char-counter.warning {
    color: var(--warning);
}

.char-counter.danger {
    color: var(--danger);
}

/* Ensure all form inputs have readable text */
#aspirasiForm input,
#aspirasiForm select,
#aspirasiForm textarea {
    color: #ffffff !important;
}

#aspirasiForm input::placeholder,
#aspirasiForm textarea::placeholder {
    color: rgba(203, 213, 225, 0.5) !important;
}

#aspirasiForm select option {
    background: #1e293b;
    color: #ffffff;
}
</style>
@endpush

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="create-header fade-in">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-2 fw-bold">
                    <i class="fas fa-bullhorn me-2"></i>Buat Aspirasi Baru
                </h2>
                <p class="mb-0 opacity-75">
                    Sampaikan Aspirasi Anda tentang sarana dan prasarana sekolah
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="text-white-50">
                    <i class="fas fa-calendar-alt me-2"></i>
                    {{ now()->format('d F Y') }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="form-card fade-in">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('student.aspirasi.store') }}" enctype="multipart/form-data" id="aspirasiForm">
                        @csrf
                        
                        <!-- Section 1: Identitas -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-user"></i>
                                Identitas Pelapor
                            </div>
                            
                            <label for="nis" class="form-label text-white fw-semibold">
                                <i class="fas fa-id-card me-2"></i>Nomor Induk Siswa (NIS)
                                <span class="required-badge">WAJIB</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nis') is-invalid @enderror" 
                                   id="nis" 
                                   name="nis" 
                                   value="{{ old('nis') }}" 
                                   placeholder="Masukkan NIS Anda"
                                   required 
                                   maxlength="10">
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="nis-info" class="mt-3"></div>
                        </div>

                        <!-- Section 2: Detail aspirasi -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-clipboard-list"></i>
                                Detail Aspirasi
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="id_kategori" class="form-label text-white fw-semibold">
                                        <i class="fas fa-tag me-2"></i>Kategori
                                        <span class="required-badge">WAJIB</span>
                                    </label>
                                    <select class="form-select @error('id_kategori') is-invalid @enderror" 
                                            id="id_kategori" 
                                            name="id_kategori"
                                            required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                                {{ $kategori->ket_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="lokasi" class="form-label text-white fw-semibold">
                                        <i class="fas fa-map-marker-alt me-2"></i>Lokasi Kejadian
                                        <span class="required-badge">WAJIB</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('lokasi') is-invalid @enderror" 
                                           id="lokasi" 
                                           name="lokasi" 
                                           value="{{ old('lokasi') }}" 
                                           placeholder="Contoh: Ruang Kelas XII IPA 1"
                                           required 
                                           maxlength="50">
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="char-counter" id="lokasi-counter">0 / 50</div>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <label for="ket" class="form-label text-white fw-semibold">
                                    <i class="fas fa-comment-alt me-2"></i>Keterangan Detail
                                    <span class="required-badge">WAJIB</span>
                                </label>
                                <textarea class="form-control @error('ket') is-invalid @enderror" 
                                          id="ket" 
                                          name="ket" 
                                          rows="5"
                                          placeholder="Jelaskan secara detail kondisi atau masalah yang ingin dilaporkan..."
                                          required>{{ old('ket') }}</textarea>
                                @error('ket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted-custom d-block mt-2">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Jelaskan secara detail kondisi atau masalah yang ingin dilaporkan
                                </small>
                            </div>
                        </div>

                        <!-- Section 3: Foto Pendukung -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-camera"></i>
                                Foto Pendukung (Opsional)
                            </div>
                            
                            <input type="file" 
                                   class="d-none @error('foto') is-invalid @enderror" 
                                   id="foto" 
                                   name="foto" 
                                   accept="image/jpeg,image/png,image/jpg,image/gif">
                            
                            <div class="preview-box" id="preview-box" onclick="document.getElementById('foto').click()">
                                <div id="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <h5 class="text-white mb-2">Klik untuk upload foto</h5>
                                    <p class="text-muted-custom mb-0">
                                        <i class="fas fa-info-circle me-1"></i>
                                        JPG, PNG, GIF - Maksimal 2MB
                                    </p>
                                </div>
                                <div id="preview-container" style="display: none;">
                                    <img id="preview-image" src="" alt="Preview" class="preview-image">
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="event.stopPropagation(); removeImage()">
                                            <i class="fas fa-trash me-2"></i>Hapus Foto
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            @error('foto')
                                <div class="text-danger mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit Section -->
                        <div class="submit-section">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary btn-submit w-100">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Aspirasi
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('student.aspirasi.index') }}" class="btn btn-secondary btn-back w-100">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // NIS verification
    const nisInput = document.getElementById('nis');
    const infoDiv = document.getElementById('nis-info');
    
    nisInput.addEventListener('blur', function() {
        const nis = this.value.trim();
        
        if (nis.length > 0) {
            infoDiv.innerHTML = `
                <div class="alert alert-info mb-0 nis-verification">
                    <i class="fas fa-spinner fa-spin me-2"></i>
                    Memverifikasi NIS...
                </div>
            `;
            
            fetch(`/api/check-nis/${nis}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        infoDiv.innerHTML = `
                            <div class="alert alert-success mb-0 nis-verification">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>NIS Valid!</strong> Kelas ${data.student.kelas} ${data.student.jurusan}
                            </div>
                        `;
                    } else {
                        infoDiv.innerHTML = `
                            <div class="alert alert-warning mb-0 nis-verification">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                ${data.message}
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    infoDiv.innerHTML = `
                        <div class="alert alert-danger mb-0 nis-verification">
                            <i class="fas fa-times-circle me-2"></i>
                            Gagal memverifikasi NIS. Silakan coba lagi.
                        </div>
                    `;
                });
        } else {
            infoDiv.innerHTML = '';
        }
    });
    
    // Character counter for lokasi
    const lokasiInput = document.getElementById('lokasi');
    const lokasiCounter = document.getElementById('lokasi-counter');
    
    lokasiInput.addEventListener('input', function() {
        const length = this.value.length;
        const max = 50;
        lokasiCounter.textContent = `${length} / ${max}`;
        
        if (length > max * 0.9) {
            lokasiCounter.classList.add('danger');
            lokasiCounter.classList.remove('warning');
        } else if (length > max * 0.7) {
            lokasiCounter.classList.add('warning');
            lokasiCounter.classList.remove('danger');
        } else {
            lokasiCounter.classList.remove('warning', 'danger');
        }
    });
    
    // Image preview
    const fotoInput = document.getElementById('foto');
    const previewBox = document.getElementById('preview-box');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    
    fotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Check file size (2MB = 2097152 bytes)
            if (file.size > 2097152) {
                alert('⚠️ Ukuran file terlalu besar! Maksimal 2MB');
                this.value = '';
                return;
            }
            
            // Check file type
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('⚠️ Format file tidak valid! Gunakan JPG, PNG, atau GIF');
                this.value = '';
                return;
            }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                uploadPlaceholder.style.display = 'none';
                previewContainer.style.display = 'block';
                previewBox.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Remove image function
    window.removeImage = function() {
        fotoInput.value = '';
        uploadPlaceholder.style.display = 'block';
        previewContainer.style.display = 'none';
        previewBox.classList.remove('has-image');
    };
    
    // Form submission
    const form = document.getElementById('aspirasiForm');
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim Aspirasi...';
        submitBtn.disabled = true;
    });
});
</script>
@endpush
