<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Permissions Policy to fix violations -->
    <meta http-equiv="Permissions-Policy" content="unload=(), geolocation=(), microphone=(), camera=()">
    
    <title>@yield('title', 'Sistem Aspirasi Web')</title>
    
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
<body class="fade-in">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="fas fa-school me-2 text-light-blue"></i>
                <span class="fw-bold">Sistem Aspirasi Web</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.aspirasi.create') }}">
                            <i class="fas fa-plus-circle me-1"></i> Buat Aspirasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.aspirasi.status') }}">
                            <i class="fas fa-search me-1"></i> Cek Status
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">
                            <i class="fas fa-shield-alt me-1"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="container mb-4">
                <div class="alert alert-success alert-dismissible fade show slide-in" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mb-4">
                <div class="alert alert-danger alert-dismissible fade show slide-in" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="container mb-4">
                <div class="alert alert-danger alert-dismissible fade show slide-in" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-5 py-4" style="background: var(--primary-dark); border-top: 1px solid var(--secondary-blue);">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-light-blue mb-3">
                        <i class="fas fa-school me-2"></i>
                        Sistem Aspirasi Web
                    </h5>
                    <p class="text-muted-custom mb-0">
                        Platform digital untuk melaporkan dan memantau kondisi sarana dan prasarana sekolah.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="mb-3">
                        <a href="#" class="text-muted-custom me-3 text-decoration-none">
                            <i class="fas fa-phone me-1"></i> Kontak
                        </a>
                        <a href="#" class="text-muted-custom me-3 text-decoration-none">
                            <i class="fas fa-envelope me-1"></i> Email
                        </a>
                        <a href="#" class="text-muted-custom text-decoration-none">
                            <i class="fas fa-info-circle me-1"></i> Bantuan
                        </a>
                    </div>
                    <p class="text-muted-custom mb-0">
                        &copy; {{ date('Y') }} Sistem Aspirasi Web. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Error Handler -->
    <script src="{{ asset('js/error-handler.js') }}"></script>
    
    <!-- Custom JS - Clean version without problematic event handlers -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // Add loading state to buttons (exclude pagination forms)
            document.querySelectorAll('form:not(#perPageForm)').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn && !submitBtn.classList.contains('no-loading')) {
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

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (href && href !== '#') {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });

            // Ensure modals work properly
            const modals = document.querySelectorAll('.modal');
            modals.forEach(function(modal) {
                modal.addEventListener('hidden.bs.modal', function () {
                    // Remove backdrop if stuck
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>