<x-layout bodyClass="g-sidenav-show  bg-gray-200 pb-5">
    <x-navbars.bottombar activePage="dashboard"></x-navbars.bottombar>

    <!-- Menampilkan alert jika ada pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.perawat titlePage="Dashboard"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="col-lg-4 col-6 col-md-6 mt-4 mb-4 d-flex">
                    <a class="h-100 w-100" href="{{ route('perawat.profil.password') }}">
                        <div class="card z-index-2 "  style="height: 100%">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1 text-center" style="min-height: 7rem">
                                    <i class="material-icons text-white w-100 my-auto" style="font-size: 5rem">key</i>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mb-0 font-weight-bolder text-md">Ubah Password</p>
                                <hr class="dark horizontal">
                                {{-- <div class="d-flex ">
                                    <i class="material-icons text-sm my-auto me-1">schedule</i>
                                    <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
                                </div> --}}
                            </div>
                        </div>

                    </a>
                </div>
                <div class="col-lg-4 col-6 col-md-6 mt-4 mb-4 d-flex">
                    <a class="h-100 w-100" href="{{route('admin.laporan.index')}}">
                        <div class="card z-index-2  " style="height: 100%">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                <div class="bg-gradient-primary shadow-success border-radius-lg py-3 pe-1 text-center" style="min-height: 7rem">
                                    <i class="material-icons text-white w-100 my-auto" style="font-size: 5rem">help</i>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mb-0 font-weight-bolder text-md">Panduan</p>
                                <hr class="dark horizontal">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-6 mt-4 mb-3 d-flex">
                    <a class="h-100 w-100" href="{{ route('perawat.keamananprivasi') }}">
                        <div class="card z-index-2 " style="height: 100%">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                <div class="bg-gradient-primary shadow-dark border-radius-lg py-3 pe-1 text-center" style="min-height: 7rem">
                                    <i class="material-icons text-white w-100 my-auto" style="font-size: 5rem">security</i>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mb-0 font-weight-bolder text-md">Keamanan Privasi</p>
                                <hr class="dark horizontal">
                            </div>
                        </div>

                    </a>
                </div>
                <div class="col-lg-4 col-6 mt-4 mb-3 d-flex">
                    <a class="h-100 w-100" href="{{ route('perawat.tentangkami') }}">
                        <div class="card z-index-2 " style="height: 100%">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                <div class="bg-gradient-primary shadow-dark border-radius-lg py-3 pe-1 text-center" style="min-height: 7rem">
                                    <i class="material-icons text-white w-100 my-auto" style="font-size: 5rem">contact_page</i>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mb-0 font-weight-bolder text-md">Tentang Kami</p>
                                <hr class="dark horizontal">
                            </div>
                        </div>

                    </a>
                </div>
            </div>
        </div>

    {{-- <div class="menu-grid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Menu</h5>
            <a class="h-100 w-100" href="#" class="text-primary text-decoration-none">Show All</a>
        </div>
        <div class="row g-3">
            <div class="col-4">
                <a class="h-100 w-100" href="{{ route('perawat.ubahpassword') }}" class="w-100">
                    <button class="menu-item w-100">
                        <i class="bi bi-key"></i>
                        <span>Ubah Passwordss</span>
                    </button>
                </a>
            </div>
            <div class="col-4">
                <a class="h-100 w-100" href="{{ route('perawat.panduan') }}" class="w-100">
                    <button class="menu-item w-100">
                        <i class="bi bi-book"></i>
                        <span>Panduan</span>
                    </button>
                </a>
            </div>
            <div class="col-4">
                <a class="h-100 w-100" href="{{ route('perawat.pengaturan') }}" class="w-100">
                    <button class="menu-item w-100">
                        <i class="bi bi-gear"></i>
                        <span>Pengaturan</span>
                    </button>
                </a>
            </div>
            <div class="col-4">
                <a class="h-100 w-100" href="{{ route('perawat.keamananprivasi') }}" class="w-100">
                    <button class="menu-item w-100">
                        <i class="bi bi-shield-check"></i>
                        <span>Keamanan dan Privasi</span>
                    </button>
                </a>
            </div>
            <div class="col-4">
                <a class="h-100 w-100" href="{{ route('perawat.tentangkami') }}" class="w-100">
                    <button class="menu-item w-100">
                        <i class="bi bi-person"></i>
                        <span>Tentang Kami</span>
                    </button>
                </a>
            </div>
            <div class="col-4">
                <form action="{{ route('logout') }}" method="POST" class="w-100">
                    @csrf <!-- Token CSRF untuk keamanan -->
                    <button type="submit" class="menu-item w-100">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div> --}}
    <x-footers.auth></x-footers.auth>
    </main>
</x-layout>