<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Permissions Policy to fix violations -->
    <meta http-equiv="Permissions-Policy" content="unload=(), geolocation=(), microphone=(), camera=()">
    
    <title>@yield('title', 'Admin - aspirasi Web')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body class="fade-in admin-layout">
    <!-- Top Navigation -->
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
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
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
                        <i class="fas fa-comments me-2"></i> aspirasi
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

    <!-- Main Content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <!-- Flash Messages -->
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Error Handler -->
    <script src="{{ asset('js/error-handler.js') }}"></script>
    
    <!-- Custom JS - Clean version without problematic event handlers -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functions
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
            
            // Close sidebar when clicking on overlay
            const overlay = document.getElementById('sidebarOverlay');
            if (overlay) {
                overlay.addEventListener('click', window.closeSidebar);
            }
            
            // Close sidebar when clicking on nav links in mobile
            document.querySelectorAll('.sidebar .nav-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        window.closeSidebar();
                    }
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    window.closeSidebar();
                }
            });

            // Auto dismiss alerts after 5 seconds
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    if (bsAlert) {
                        bsAlert.close();
                    }
                });
            }, 5000);

            // Add loading state to buttons
            document.querySelectorAll('form').forEach(function(form) {
                form.addEventListener('submit', function() {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn && !submitBtn.classList.contains('btn-danger')) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                        submitBtn.disabled = true;
                        
                        // Re-enable after 10 seconds as fallback
                        setTimeout(function() {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }, 10000);
                    }
                });
            });

            // Confirm delete actions
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