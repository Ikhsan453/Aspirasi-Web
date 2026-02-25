<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Login Admin - Aspirasi Web</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    
    <style>
        .login-container {
            min-height: 100vh;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }
        
        .login-card {
            background: rgba(30, 41, 59, 0.95);
            border: 1px solid rgba(51, 65, 85, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            margin: 0 auto; /* Memastikan card berada di tengah */
        }
        
        .login-header {
            background: var(--gradient-accent);
            padding: 2rem;
            text-align: center;
            position: relative;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .login-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: white;
        }
        
        .login-body {
            padding: 2.5rem;
        }
        
        .form-control,
        .form-select {
            color: #ffffff !important;
            background: rgba(51, 65, 85, 0.8);
            border: 1px solid rgba(100, 116, 139, 0.5);
            padding: 0.75rem 1rem;
            border-radius: 8px;
        }
        
        .form-control:focus,
        .form-select:focus {
            color: #ffffff !important;
            background: rgba(51, 65, 85, 0.9);
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }
        
        .form-control::placeholder {
            color: rgba(203, 213, 225, 0.5) !important;
        }
        
        .login-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            border: 3px solid #ffffff !important;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 800 !important;
            transition: all 0.3s ease;
            color: #ffffff !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5) !important;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.5) !important;
        }
        
        .login-btn:hover,
        .login-btn:focus,
        .login-btn:active {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.6) !important;
            color: #ffffff !important;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
            border-color: #ffffff !important;
        }
        
        .back-btn {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important;
            border: 2px solid #ffffff !important;
            color: #ffffff !important;
            border-radius: 12px;
            padding: 1rem 1.5rem !important;
            transition: all 0.3s ease;
            text-decoration: none !important;
            font-weight: 700 !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
            font-size: 1rem !important;
            display: block !important;
            width: 100% !important;
        }
        
        .back-btn:hover,
        .back-btn:focus,
        .back-btn:active {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%) !important;
            color: #ffffff !important;
            transform: translateY(-2px) !important;
            text-decoration: none !important;
            border-color: #ffffff !important;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Additional button text fixes */
        .btn.login-btn,
        .btn.login-btn:hover,
        .btn.login-btn:focus,
        .btn.login-btn:active,
        .btn.login-btn:visited {
            color: #ffffff !important;
        }
        
        .btn.back-btn,
        .btn.back-btn:hover,
        .btn.back-btn:focus,
        .btn.back-btn:active,
        .btn.back-btn:visited {
            color: #ffffff !important;
        }
        
        /* Ensure icon color */
        .login-btn i,
        .back-btn i {
            color: #ffffff !important;
        }

        /* Container adjustments untuk centering */
        .container-custom {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="container">
            <!-- Baris ini yang diperbaiki - hanya menggunakan satu kolom dengan offset otomatis -->
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="login-card fade-in">
                        <!-- Header -->
                        <div class="login-header">
                            <div class="login-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3 class="text-white fw-bold mb-2">Admin Panel</h3>
                            <p class="text-white opacity-75 mb-0">
                                Aspirasi Web
                            </p>
                        </div>
                        
                        <!-- Body -->
                        <div class="login-body">
                            <!-- Error Messages -->
                            @if($errors->has('login'))
                                <div class="alert alert-danger slide-in mb-4">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    {{ $errors->first('login') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger slide-in mb-4">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Login Form -->
                            <form action="{{ url('admin/login') }}" method="POST" id="loginForm">
                                @csrf
                                
                                <div class="mb-4">
                                    <input type="text" 
                                           class="form-control @error('username') is-invalid @enderror" 
                                           id="username" 
                                           name="username" 
                                           value="{{ old('username') }}" 
                                           placeholder="Masukkan Username Anda"
                                           required 
                                           autofocus>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Masukkan Password Anda"
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary login-btn" style="color: #ffffff !important;">
                                        <i class="fas fa-sign-in-alt me-2"></i>
                                        Masuk ke Admin Panel
                                    </button>
                                </div>
                            </form>

                            <!-- Back Link -->
                            <div class="text-center">
                                <a href="{{ route('home') }}" class="btn back-btn d-block w-100" style="color: #ffffff !important;">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer Info -->
                    <div class="text-center mt-4">
                        <p class="text-white-50 mb-0">
                            <i class="fas fa-shield-alt me-1"></i>
                            Area khusus administrator sistem
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const submitBtn = form.querySelector('button[type="submit"]');
            
            // Form submission handler
            form.addEventListener('submit', function() {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                submitBtn.disabled = true;
            });
            
            // Auto focus on username field
            document.getElementById('username').focus();
            
            // Enter key handler
            document.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>