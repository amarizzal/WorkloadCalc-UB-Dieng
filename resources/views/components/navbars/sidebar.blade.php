@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center p-3" href=" {{ route('admin.dashboard') }} ">
            <img src="{{ asset('images') }}/logoNWL.png" class="navbar-brand-img h-100" style="max-height: 3rem" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white">Nursing Workload Calculator</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('admin.dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Laporan</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'laporan-hasil' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('admin.laporan.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Hasil</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'laporan-pokok' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('admin.laporan.index2') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">work</i>
                    </div>
                    <span class="nav-link-text ms-1">Tugas Pokok</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'laporan-penunjang' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('admin.laporan.index3') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">cases</i>
                    </div>
                    <span class="nav-link-text ms-1">Tugas Penunjang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'laporan-tambahan' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('admin.laporan.index5') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">add_box</i>
                    </div>
                    <span class="nav-link-text ms-1">Tugas Tambahan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white  {{ $activePage == 'notifications' ? ' active bg-gradient-primary' : '' }}  "
                    hreff="{{ route('notifications') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">Beban Kerja</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'laporan-perawat' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('admin.laporan.index6') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment_ind</i>
                    </div>
                    <span class="nav-link-text ms-1">Per Perawat</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Master</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'master-user' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('admin.master-user') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">masks</i>
                    </div>
                    <span class="nav-link-text ms-1">Perawat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'master-hospital' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('admin.data-rumah-sakit') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">domain_add</i>
                    </div>
                    <span class="nav-link-text ms-1">Data Rumah Sakit</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'master-tindakan' ? ' active bg-gradient-primary' : '' }}" href="{{ route('admin.master-tindakan') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">medical_information</i>
                    </div>
                    <span class="nav-link-text ms-1">Tindakan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'master-shift' ? ' active bg-gradient-primary' : '' }}" href="{{ route('admin.master-shiftkerja') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">Shift Kerja</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'master-ruangan' ? ' active bg-gradient-primary' : '' }}" href="{{ route('admin.master-ruangan') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">room</i>
                    </div>
                    <span class="nav-link-text ms-1">Ruangan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'master-keamanan' ? ' active bg-gradient-primary' : '' }}" href="{{ route('admin.master-keamanan-privasi') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">security</i>
                    </div>
                    <span class="nav-link-text ms-1">Keamanan Privasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'master-panduan' ? ' active bg-gradient-primary' : '' }}" href="#">
                    {{-- {{ route('admin.master-panduan') }} --}}
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">help</i>
                    </div>
                    <span class="nav-link-text ms-1">Panduan</span>
                </a>
            </li>
            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                @csrf
            </form>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn btn-danger w-100"
                href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();" type="button">Sign Out</a>
        </div>
    </div>
</aside>
