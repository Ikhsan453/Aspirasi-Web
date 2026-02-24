@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-light fw-bold">
            <i class="fas fa-tags me-2 text-primary"></i>
            Kelola Kategori
        </h1>
        <p class="text-muted-custom mb-0">Kelola kategori Aspirasi sarana dan prasarana</p>
    </div>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-success btn-lg shadow-lg">
        <i class="fas fa-plus-circle me-2"></i>Tambah Kategori
    </a>
</div>

<div class="card fade-in">
    <div class="card-header">
        <h5 class="mb-0 text-white fw-semibold">
            <i class="fas fa-list me-2"></i>
            Daftar Kategori
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-modern mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">
                            <i class="fas fa-hashtag me-1"></i>No
                        </th>
                        <th>
                            <i class="fas fa-tag me-1"></i>Nama Kategori
                        </th>
                        <th class="text-center" style="width: 150px;">
                            <i class="fas fa-chart-bar me-1"></i>Total Aspirasi
                        </th>
                        <th class="text-center" style="width: 120px;">
                            <i class="fas fa-calendar me-1"></i>Dibuat
                        </th>
                        <th class="text-center" style="width: 150px;">
                            <i class="fas fa-cogs me-1"></i>Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $index => $kategori)
                        <tr class="slide-in" style="animation-delay: {{ $index * 0.1 }}s;">
                            <td class="text-center">
                                <span class="badge bg-secondary">{{ $kategoris->firstItem() + $index }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-gradient-accent rounded-circle d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px; min-width: 40px;">
                                        <i class="fas fa-tag text-white"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-light-custom">{{ $kategori->ket_kategori }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                @php
                                    $totalAspirasi = $kategori->inputaspirasis->count();
                                @endphp
                                @if($totalAspirasi > 0)
                                    <span class="badge bg-info fs-6 px-3 py-2">
                                        <i class="fas fa-comments me-1"></i>{{ $totalAspirasi }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary fs-6 px-3 py-2">
                                        <i class="fas fa-minus me-1"></i>0
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="text-light-custom">{{ $kategori->created_at->format('d/m/Y') }}</div>
                                <small class="text-muted-custom">{{ $kategori->created_at->format('H:i') }}</small>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <a href="{{ route('admin.kategori.edit', $kategori) }}" 
                                       class="btn btn-sm btn-warning d-inline-flex align-items-center justify-content-center" 
                                       style="min-width: 35px; height: 35px;"
                                       title="Edit Kategori">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.kategori.destroy', $kategori) }}" 
                                          method="POST" 
                                          class="d-inline m-0"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?\n\n⚠️ PERINGATAN: Semua Aspirasi dengan kategori ini akan ikut terhapus!')">>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger d-inline-flex align-items-center justify-content-center" 
                                                style="min-width: 35px; height: 35px;"
                                                title="{{ $totalAspirasi > 0 ? 'Tidak dapat dihapus - Ada ' . $totalAspirasi . ' Aspirasi' : 'Hapus Kategori' }}"
                                                {{ $totalAspirasi > 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                @if($totalAspirasi > 0)
                                    <div class="mt-2">
                                        <small class="text-warning d-block">
                                            <i class="fas fa-lock me-1"></i>
                                            {{ $totalAspirasi }} Aspirasi aktif
                                        </small>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted-custom">
                                    <i class="fas fa-tags fa-3x mb-3 d-block opacity-50"></i>
                                    <h5 class="mb-2">Belum Ada Kategori</h5>
                                    <p class="mb-3">Mulai dengan menambahkan kategori Aspirasi pertama</p>
                                    <a href="{{ route('admin.kategori.create') }}" class="btn btn-success btn-lg">
                                        <i class="fas fa-plus-circle me-2"></i>Tambah Kategori Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    @if($kategoris->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $kategoris->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection