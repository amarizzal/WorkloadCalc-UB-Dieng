<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nursing Workload Counter - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0; /* Menghapus margin di body */
            padding: 0; /* Menghapus padding di body */
            height: 100vh; /* Menjadikan tinggi body 100% dari tinggi layar */
            display: flex;
            justify-content: center;
            align-items: center; /* Menyusun konten di tengah layar */
        }
    
        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 1;
            height: 100%; /* Membuat card mengikuti tinggi layar */
            width: 100%; /* Card mengikuti lebar layar */
            max-width: 500px; /* Mengatur lebar maksimum card */
            margin: 0;
            padding: 2rem; /* Memberikan padding agar konten tidak menempel pada tepi card */
            overflow: hidden;
        }
    
        /* Gradient di card */
        .card::before,
        .card::after {
            content: '';
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            z-index: -1;
            filter: blur(60px);
        }
    
        .card::before {
            top: -140px;
            left: -140px;
            background: radial-gradient(
                circle,
                rgba(255, 198, 88, 1.15) 0%,
                rgba(255, 198, 88, 0.05) 50%,
                transparent 70%
            );
        }
    
        .card::after {
            bottom: -140px;
            right: -140px;
            background: radial-gradient(
                circle,
                rgba(165, 132, 76, 1.15) 0%,
                rgba(165, 132, 76, 0.05) 50%,
                transparent 70%
            );
        }
    
        /* Aturan untuk tampilan kecil (mobile) */
        @media (max-width: 576px) {
            .card {
                margin: 0; /* Menghilangkan margin di tampilan kecil */
                padding: 1rem; /* Memberikan sedikit padding agar tidak menempel ke tepi layar */
            }
        }
    
        /* Aturan untuk tampilan lebih besar (tablet dan atasnya) */
        @media (min-width: 576px) {
            .card {
                width: 100%; /* Card akan mengisi 100% lebar layar */
                margin: 0; /* Menghilangkan margin pada tampilan besar */
                padding: 2rem; /* Memberikan padding agar konten tidak menempel */
            }
        }
    
        .header-section {
            display: flex;
            justify-content: flex-end;
            align-items: flex-start;
            margin-bottom: 2.5rem;
        }
    
        .logo-container {
            text-align: right;
        }
    
        .app-title {
            text-align: right;
            margin-top: -1.2rem;
            line-height: 1.1;
        }
    
        .app-title span {
            display: block;
            font-size: 0.9rem;
            font-weight: bold;
        }
    
        .eye-icon {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    
        .form-control:focus {
            box-shadow: none;
            border-color: #6c757d;
        }
    
        .form-content {
            padding: 0 1.5rem;
        }
    
        .welcome-text {
            margin-bottom: 2.5rem;
        }
    
        .text-muted {
            font-size: 0.8rem;
        }
    
        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
    
    
    
</head>
<body>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <div class="d-flex justify-content-center align-items-center    ">
            <div class="card border-0 p-4">
              
                <!-- Header Section with Logo -->
                <div class="header-section">
                    <div class="logo-container">
                        <img src="images/logofikes.png" alt="FIKES UB" class="img-fluid" style="height: 60px;">
                        <div class="app-title">
                            <span>Nursing Workload</span>
                            <span>Counter</span>
                        </div>
                    </div>
                </div>

                <div class="form-content">
                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h1 class="display-6 fw-bold mb-1">Hai!</h1>
                        <h2 class="display-6 fw-bold mb-4">Selamat Datang</h2>
                        <p class="text-muted">Isilah Data dibawah dengan benar</p>
                    </div>

                   
                    <br>
                    <br>

                    <!-- Login Form -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   class="form-control py-2" 
                                   placeholder="Username, Email atau Nomor Handphone"
                                   required>
                        </div>

                        <div class="mb-3 position-relative">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control py-2" 
                                   placeholder="Password"
                                   required>
                            <span class="eye-icon" onclick="togglePassword()">👁️</span>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label text-muted" for="remember">Ingatkan saya</label>
                            </div>
                            <a href="#" class="text-decoration-none text-muted">Lupa Password?</a>
                        </div>

                        <br><br>

                        <button type="submit" class="btn btn-dark w-100 py-2 mb-4">Masuk</button>
                    </form>
                    <br>
                    <br>
                   
                    <br><br><br>

                    <!-- Register Link -->
                    <div class="text-center">
                        <span class="text-muted">Belum Mempunyai akun? </span>
                        <a href="{{ route('register') }}" class="text-dark text-decoration-none fw-semibold">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</body>
</html>