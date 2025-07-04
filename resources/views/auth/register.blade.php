<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nursing Workload Counter - Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            overflow: hidden;
            height: 100%;
        }

        /* Gradient in card */
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
            background: radial-gradient(circle,
                    rgba(255, 198, 88, 1.15) 0%,
                    rgba(255, 198, 88, 0.05) 50%,
                    transparent 70%);
        }

        .card::after {
            bottom: -140px;
            right: -140px;
            background: radial-gradient(circle,
                    rgba(165, 132, 76, 1.15) 0%,
                    rgba(165, 132, 76, 0.05) 50%,
                    transparent 70%);
        }

        .card form {
            padding: 20px;
            /* Tambahkan padding di sini */
        }

        .card .welcome-text {
            margin: 20px;
            /* Tambahkan margin di sini */
        }

        .card p {
            opacity: 0.5;
            /* Atur opacity sesuai dengan yang diinginkan */
            color: #A0AEC0;
            /* Warna teks yang lebih terang, sesuai dengan warna placeholder */
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
            background: radial-gradient(circle,
                    rgba(255, 198, 88, 1.15) 0%,
                    rgba(255, 198, 88, 0.05) 50%,
                    transparent 70%);
        }

        .card::after {
            bottom: -140px;
            right: -140px;
            background: radial-gradient(circle,
                    rgba(165, 132, 76, 1.15) 0%,
                    rgba(165, 132, 76, 0.05) 50%,
                    transparent 70%);
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

        .form-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2D3748;
            margin-bottom: 0;
            text-align: left;
        }

        .form-subtitle {
            color: #718096;
            margin-bottom: 2rem;
            font-size: 1.25rem;
        }

        .form-label {
            color: #4A5568;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .form-control {
            border: none;
            border-bottom: 1px solid #E2E8F0;
            border-radius: 0;
            padding: 0.75rem 0;
            font-size: 1rem;
            background: transparent;
        }

        .form-control option {
            color: #A0AEC0;
            /* Warna yang lebih terang, sesuai dengan warna placeholder */
            opacity: 0.5;
            /* Atur opacity sesuai dengan yang diinginkan */
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #4299E1;
            background: transparent;
        }

        .form-select {
            border: none;
            border-bottom: 1px solid #E2E8F0;
            border-radius: 0;
            padding: 0.75rem 0;
            font-size: 1rem;
            background-position: right 0 center;
        }

        .form-select:focus {
            box-shadow: none;
            border-color: #4299E1;
        }

        .password-hint {
            font-size: 0.75rem;
            color: #A0AEC0;
            margin-top: 0.25rem;
        }

        .btn-register {
            background: #2D3748;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            width: 100%;
            margin-top: 2rem;
            transition: all 0.2s;
        }

        .btn-register:hover {
            background: #4A5568;
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #718096;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #4299E1;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            color: #2B6CB0;
        }

        .form-control::placeholder {
            color: #A0AEC0;
        }

        .password-toggle {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #A0AEC0;
        }

        .input-group {
            position: relative;
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


        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="card border-0 p-4">

                <div class="header-section">
                    <div class="logo-container">
                        <img src="images/logofikes.png" alt="FIKES UB" class="img-fluid" style="height: 60px;">
                        <div class="app-title">
                            <span>Nursing Workload</span>
                            <span>Counter</span>
                        </div>
                    </div>
                </div>

                <div class="welcome-text">
                    <h1 class="display-6 fw-bold mb-1">Hai!</h1>
                    <h2 class="display-6 fw-bold mb-4">Selamat Datang</h2>
                    <p class="text-muted">Mari Membuat Akun</p>
                </div>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <input id="nama_lengkap" type="text"
                            class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap"
                            placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}" required autofocus>
                        @error('nama_lengkap')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" placeholder="Email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="form-group">
                        <input id="nomor_telepon" type="text"
                            class="form-control @error('nomor_telepon') is-invalid @enderror" name="nomor_telepon"
                            placeholder="Nomor Telepon" value="{{ old('nomor_telepon') }}" required>
                        @error('nomor_telepon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <select id="jenis_kelamin_id"
                            class="form-control @error('jenis_kelamin_id') is-invalid @enderror" name="jenis_kelamin_id"
                            required>
                            <option value="" disabled selected>Jenis Kelamin</option>
                            @foreach ($jenisKelaminList as $jenisKelamin)
                                <option value="{{ $jenisKelamin->id }}"
                                    {{ old('jenis_kelamin_id') == $jenisKelamin->id ? 'selected' : '' }}>
                                    {{ $jenisKelamin->nama }}</option>
                            @endforeach
                        </select>
                        @error('jenis_kelamin_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
<br>
                    
                    <!-- Tanggal Lahir -->
                   <div class="form-group">
    <label for="tanggal_lahir">Tanggal Lahir</label>
    <input id="tanggal_lahir" type="date"
        class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir"
        value="{{ old('tanggal_lahir') }}" required>
    @error('tanggal_lahir')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>



                    <!-- Ruangan -->
                    <div class="form-group">
                        <select id="ruangan_id" class="form-control @error('ruangan_id') is-invalid @enderror"
                            name="ruangan_id" required>
                            <option value="" disabled selected>Ruangan</option>
                            @foreach ($ruanganList as $ruangan)
                                <option value="{{ $ruangan->id }}"
                                    {{ old('ruangan_id') == $ruangan->id ? 'selected' : '' }}>
                                    {{ $ruangan->nama_ruangan }}</option>
                            @endforeach
                        </select>
                        @error('ruangan_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <input id="username" type="text"
                            class="form-control @error('username') is-invalid @enderror" name="username"
                            placeholder="Username" value="{{ old('username') }}" required>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <input id="password" type="password"
                            class="form-control @error('password') is -invalid @enderror" name="password"
                            placeholder="Password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <input id="password_confirmation" type="password" class="form-control"
                            name="password_confirmation" placeholder="Konfirmasi Password" required>
                    </div>

                    <hr>
                    <!-- Foto -->
                    <div class="form-group">
                        <input id="foto" type="file"
                            class="form-control-file @error('foto') is-invalid @enderror" name="foto">
                        @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <hr>

                    <br>
                    <br>
                    <br>


                    <button type="submit" class="btn btn-dark w-100 py-2 mb-4">Daftar</button>

                    <!-- Register Link -->
                    <div class="text-center">
                        <span class="text-muted">Sudah Mempunyai akun? </span>
                        <a href="{{ route('login') }}" class="text-dark text-decoration-none fw-semibold">Masuk</a>
                    </div>

                </form>
            </div>


        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Toggle password visibility
            document.querySelectorAll('.password-toggle').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                });
            });
        </script>
</body>

</html>
