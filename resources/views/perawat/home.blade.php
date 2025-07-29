<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.bottombar activePage="master-keamanan"></x-navbars.bottombar>

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




<div class="menu-grid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Menu</h5>
        <a href="#" class="text-primary text-decoration-none">Show All</a>
    </div>
    <div class="row g-3">
        <div class="col-4">
            <a href="{{ route('perawat.ubahpassword') }}" class="w-100">
                <button class="menu-item w-100">
                    <i class="bi bi-key"></i>
                    <span>Ubah Password</span>
                </button>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('perawat.panduan') }}" class="w-100">
                <button class="menu-item w-100">
                    <i class="bi bi-book"></i>
                    <span>Panduan</span>
                </button>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('perawat.pengaturan') }}" class="w-100">
                <button class="menu-item w-100">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan</span>
                </button>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('perawat.keamananprivasi') }}" class="w-100">
                <button class="menu-item w-100">
                    <i class="bi bi-shield-check"></i>
                    <span>Keamanan dan Privasi</span>
                </button>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('perawat.tentangkami') }}" class="w-100">
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
</div>
</x-layout>