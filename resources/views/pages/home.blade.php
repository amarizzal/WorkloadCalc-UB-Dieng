@props(['bodyClass'])
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nursing Workload</title>
    <link rel="icon" type="image/png" href="{{ asset('images/Logo nursing workload.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/custom-datatables.css') }}" rel="stylesheet" />
    <style>
        body {
            font-family: "League Spartan", sans-serif;
        }

        h1 {
            font-family: "League Spartan", sans-serif !important;
            word-break: break-word;
        }

        h2 {
            font-family: "Raleway", sans-serif !important;
            word-break: break-word;
        }

        .text-primary {
            font-family: "League Spartan", sans-serif !important;
            color: #1c2a59 !important;
        }

        .text-sec {
            font-family: "Raleway", sans-serif !important;
        }

        .bg-dark-blue {
            background-color: #1c2a59;
        }

        .text-yellow {
            color: #ffc736;
        }

        .text-dark {
            color: #000000 !important;
        }

        .bg-yellow {
            background-color: #ffc736;
        }

        .icon-box {
            border-radius: 20px;
            padding: 30px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #1c2a59;
            width: 100%;
            max-width: 300px;
            margin: auto;
        }

        .rounded-16 {
            border-radius: 50px;
        }

        .rounded-xl {
            border-radius: 100px;
        }

        .w-500 {
            font-weight: 500;
        }

        .nav-itemm {
            color: grey;
            font-weight: 700;
            font-family: "Raleway", sans-serif !important;
            font-size: 20px;
        }

        .active {
            color: white;
            font-weight: 700;
        }

        /* Responsif font */
        h1.text-yellow {
            font-size: clamp(2rem, 8vw, 7rem);
        }

        h1.text-primary {
            font-size: clamp(2rem, 6vw, 5rem);
        }

        /* Logo */
        .logo-img {
            max-height: 80px;
            height: auto;
            width: auto;
        }

        /* Iframe responsif */
        iframe {
            width: 100%;
            height: 300px;
        }

        /* Tombol responsif */
        @media (max-width: 576px) {
            h1 {
                font-size: 2rem !important;
            }

            h2 {
                font-size: 1.5rem !important;
            }

            .btn {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <section class="bg-dark-blue text-white py-3">
        <div class="row justify-content-end px-3">
            <div class="col-auto">
                <a href="#" class="text-sec nav-itemm active">Beranda</a>
                <a href="{{ route('login')}}" class="mx-3 text-sec nav-itemm">Login</a>
            </div>
        </div>
    </section>

    <section class="bg-dark-blue text-white py-3">
        <div class="container bg-dark-blue d-flex flex-wrap align-items-center">
            <img src="{{asset('images/Logo_Universitas_Brawijaya.svg.png')}}" alt="Logo" class="mb-3 logo-img" loading="lazy">
            <img src="{{asset('images/Logo nursing workload.png')}}" alt="Logo" class="ms-3 mb-3 border-radius-lg img-rounded logo-img" loading="lazy">
        </div>
    </section>

    <!-- Hero Section -->
    <section class="bg-dark-blue text-white py-5">
        <div class="container px-3 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            <div class="col-md-6">
                <h1 class="text-yellow fw-bold">Nursing Workload</h1>
                <h1 class="text-white fw-bold">Analysis System</h1>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{asset('images/illustration.gif')}}" alt="Nurse" class="img-fluid mt-4 mt-lg-0 w-50 w-md-50 text-center mx-auto bg-yellow">
            </div>
        </div>
    </section>

    <!-- Login Role Section -->
    {{-- <section class="bg-yellow py-5">
        <div class="container d-flex flex-column flex-md-row gap-5 justify-content-center">
            <div class="icon-box text-center">
                <img src="{{ asset('images/1.png')}}" alt="Admin" style="height: 150px;" loading="lazy">
                <h3 class="mt-3 fw-bold text-primary">ADMIN</h3>
            </div>
            <div class="icon-box text-center">
                <img src="{{ asset('images/2.png')}}" alt="Perawat" style="height: 150px;" loading="lazy">
                <h3 class="mt-3 fw-bold text-primary">PERAWAT</h3>
            </div>
        </div>
    </section> --}}

    <!-- Tentang Kami -->
    <section class="py-5" style="background-color: #faf1d8">
        <div class="container">
            <div class="p-4 rounded-16 border border-dark">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-6 col-12">
                        <h1 class="fw-bold text-primary">Tentang Kami</h1>
                        <p class="text-dark text-sec w-500" style="font-size: 1.5rem">Nursing Workload Analysis System adalah aplikasi digital yang dikembangkan untuk membantu perawat dan manajemen rumah sakit dalam menghitung dan menganalisis beban kerja secara akurat dan efisien. Aplikasi ini dirancang berdasarkan pendekatan ilmiah dan metode <em>Workload Indicators of Staffing Need (WISN)</em> termodifikasi yang direkomendasikan oleh World Health Organization (WHO).</p>
                    </div>
                    <div class="col-md-6 col-12 text-center">
                        <img src="{{asset('images/Logo nursing workload.png')}}" alt="Logo" class="img-fluid w-50 rounded-16 mx-auto my-auto" style="max-height: 300px;" loading="lazy">
                    </div>
                </div>
                <a href="{{ route('login')}}" class="btn btn-dark mt-2 text-lg rounded-xl">LEARN MORE</a>
            </div>
        </div>
    </section>

    <!-- Panduan -->
    <section class="py-5" style="background: linear-gradient(90deg, #1c2a59, #ffc736); color: white;">
        <div class="container px-3 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            <div class="col-md-6 col-12">
                <h1 class="fw-bold text-white">Panduan</h1>
                <p class="text-sec text-lg w-500">Pelajari cara menggunakan aplikasi Nursing Workload untuk menghitung dan menganalisis beban kerja perawat secara mudah dan akurat.</p>
                <a href="{{ route('login')}}" class="btn btn-light mt-2 text-lg rounded-xl">AKSES DISINI</a>
            </div>
            <div class="col-md-6 col-12 text-center">
                <img src="{{ asset('images/3.png')}}" alt="Guide" class="img-fluid mt-4 mt-lg-0 rounded-16 w-50" style="max-height: 300px;" loading="lazy">
            </div>
        </div>
    </section>

    <!-- Kontak Kami -->
    <footer class="bg-dark-blue text-white py-5">
        <div class="container px-3 d-flex flex-column flex-lg-row justify-content-between align-items-center">
            <div class="col-md-6 col-12">
                <h1 class="text-yellow fw-bold">Hubungi Kami</h1>
                <h2 class="mb-1 text-sec text-white fw-bold"><strong>Fakultas Ilmu Kesehatan Universitas Brawijaya</strong></h2>
                <p class="mb-1 text-lg text-sec w-500">Kampus 2 - Jl. Puncak Dieng Eksklusif, Malang, Jawa Timur</p>
                <p class="mb-1 text-lg text-sec w-500">Telp: 0818-0320-7119</p>
                <p class="mb-1 text-lg text-sec w-500">Email: nursingworkloadub@gmail.com</p>
            </div>
            <div class="col-md-6 col-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5345.5599908483!2d112.58967731177933!3d-7.968963679400827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78830fed5c2d17%3A0x4fb7fb1bbc34039!2sFakultas%20Ilmu%20Kesehatan%20Universitas%20Brawijaya!5e1!3m2!1sid!2sid!4v1753711663614!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
</body>

</html>