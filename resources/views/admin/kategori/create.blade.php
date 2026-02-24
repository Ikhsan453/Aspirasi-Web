@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-custom">
    <h1 class="h2 text-light-custom fade-in">
        <i class="fas fa-plus text-success"></i> Tambah Kategori
    </h1>
</div>

<div class="row justify-content-center fade-in">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 text-light-custom">
                    <i class="fas fa-tag"></i> Form Tambah Kategori
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="ket_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control @error('ket_kategori') is-invalid @enderror" 
                               id="ket_kategori" name="ket_kategori" value="{{ old('ket_kategori') }}" 
                               placeholder="Masukkan nama kategori" maxlength="30" required>
                        @error('ket_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-muted-custom">
                            <i class="fas fa-info-circle"></i> Maksimal 30 karakter
                        </div>
                    </div>

                    <div class="d-flex justify-content-between gap-2">
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary slide-in">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success slide-in">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection