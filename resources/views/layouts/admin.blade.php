<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta http-equiv="Permissions-Policy" content="unload=(), geolocation=(), microphone=(), camera=()">
    
    <title>@yield('title', 'Admin - Aspirasi Web')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body class="fade-in admin-layout">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-shield-alt me-2 text-light-blue"></i>
                <span class="fw-bold">Admin Panel</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" onclick="toggleSidebar()">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    @auth('admin')
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-2"></i>
                                <span>{{ Auth::guard('admin')->user()->username }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="background: var(--primary-blue); border: 1px solid var(--secondary-blue);">
                                <li><a class="dropdown-item text-light" href="{{ route('home') }}">
                                    <i class="fas fa-home me-2"></i> Lihat Website
                                </a></li>
                                <li><hr class="dropdown-divider" style="border-color: var(--secondary-blue);"></li>
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-light">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @auth('admin')
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <nav class="sidebar" id="sidebar">
        <div class="position-sticky">
            <div class="mb-4 text-center">
                <div class="bg-gradient-accent rounded-circle d-inline-flex align-items-center justify-content-center" 
                     style="width: 60px; height: 60px;">
                    <i class="fas fa-user-shield text-white fs-4"></i>
                </div>
                <h6 class="mt-2 mb-0 text-light">Admin Dashboard</h6>
                <small class="text-muted-custom">{{ Auth::guard('admin')->user()->username }}</small>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" 
                       href="{{ route('admin.kategori.index') }}">
                        <i class="fas fa-tags me-2"></i> Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}" 
                       href="{{ route('admin.siswa.index') }}">
                        <i class="fas fa-users me-2"></i> Data Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}" 
                       href="{{ route('admin.aspirasi.index') }}">
                        <i class="fas fa-comments me-2"></i> Aspirasi
                    </a>
                </li>
                
                <hr class="border-custom my-3">
                
                <li class="nav-item">
                    <a class="nav-link text-muted-custom" href="{{ route('home') }}">
                        <i class="fas fa-external-link-alt me-2"></i> Lihat Website
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    @endauth

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show slide-in mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show slide-in mb-4" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show slide-in mb-4" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.toggleSidebar = function() {
                if (window.innerWidth < 768) {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebarOverlay');
                    if (sidebar && overlay) {
                        sidebar.classList.toggle('show');
                        overlay.classList.toggle('show');
                    }
                }
            };
            
            window.closeSidebar = function() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                if (sidebar && overlay) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                }
            };
            
            const overlay = document.getElementById('sidebarOverlay');
            if (overlay) {
                overlay.addEventListener('click', window.closeSidebar);
            }
            
            document.querySelectorAll('.sidebar .nav-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        window.closeSidebar();
                    }
                });
            });
            
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    window.closeSidebar();
                }
            });

            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    if (bsAlert) {
                        bsAlert.close();
                    }
                });
            }, 5000);

            document.querySelectorAll('form').forEach(function(form) {
                form.addEventListener('submit', function() {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn && !submitBtn.classList.contains('btn-danger')) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                        submitBtn.disabled = true;
                        setTimeout(function() {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }, 10000);
                    }
                });
            });

            document.querySelectorAll('.btn-danger').forEach(function(btn) {
                if (btn.textContent.includes('Hapus')) {
                    btn.addEventListener('click', function(e) {
                        if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                            e.preventDefault();
                        }
                    });
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>