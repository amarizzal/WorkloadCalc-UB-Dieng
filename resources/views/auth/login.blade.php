<x-layout bodyClass="bg-gray-200">
    <style>
        /* Hilangkan warna autofill Chrome/Safari */
            input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0px 1000px none inset !important; /* ganti 'white' sesuai bg input */
            -webkit-text-fill-color: #000 !important; /* warna teks */
            transition: background-color 5000s ease-in-out 0s;
            }
    </style>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                {{-- <x-navbars.navs.guest signin='static-sign-in' signup='static-sign-up'></x-navbars.navs.guest> --}}
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('{{ asset('images/gambar-fikes.jpg')}}'); background-position: center;">
            <span class="mask bg-gradient-dark opacity-9"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Nursing Workload Counter</h4>
                                    {{-- <div class="row mt-3">
                                        <div class="col-2 text-center ms-auto">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-facebook text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center px-1">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-github text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center me-auto">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-google text-white text-lg"></i>
                                            </a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control"  
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" required>
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Password</label>
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        <i id="icon-eye" class="material-icons position-absolute top-50 end-2 translate-middle-y rounded-lg z-index-99 m-1" style="cursor: pointer; z-index: 10;" onclick="togglePassword()">visibility</i>
                                    </div>
                                    {{-- <div class="form-check form-switch d-flex align-items-center mb-3">
                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                        <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember
                                            me</label>
                                    </div> --}}
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">LOGIN</button>
                                    </div>
                                    <p class="mt-4 text-sm text-center">

                                        <a href="{{ route('home')}}"
                                            class="text-primary text-gradient font-weight-bold">Kembali ke Beranda</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.guest></x-footers.guest>
        </div>
    </main>

    @push('js')
        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('password');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    document.getElementById('icon-eye').innerHTML = 'visibility_off';
                } else {
                    passwordInput.type = 'password';
                    document.getElementById('icon-eye').innerHTML = 'visibility';
                }
            }
            document.addEventListener("DOMContentLoaded", function () {
            });
        </script>
        @endpush

</x-layout>
