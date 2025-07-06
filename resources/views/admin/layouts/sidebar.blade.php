<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>


            {{--  --}}
            <a class="nav-link {{ request()->routeIs('admin.master-*') ? 'active' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Master
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ request()->routeIs('admin.master-*') ? 'show' : '' }}" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link {{ request()->routeIs('admin.master-user') ? 'active' : '' }}" href="{{ route('admin.master-user') }}">Master User</a>
                    <a class="nav-link {{ request()->routeIs('admin.master-tindakan') ? 'active' : '' }}" href="{{ route('admin.master-tindakan') }}">Master Tindakan</a>
                    <a class="nav-link {{ request()->routeIs('admin.master-shiftkerja') ? 'active' : '' }}" href="{{ route('admin.master-shiftkerja') }}">Master Shift Kerja</a>
                    <a class="nav-link {{ request()->routeIs('admin.master-work-status') ? 'active' : '' }}" href="{{ route('admin.master-work-status') }}">Master Work Status</a>
                    <a class="nav-link {{ request()->routeIs('admin.master-ruangan') ? 'active' : '' }}" href="{{ route('admin.master-ruangan') }}">Master Ruangan</a>
                    <a class="nav-link {{ request()->routeIs('admin.master-keamanan-privasi') ? 'active' : '' }}" href="{{ route('admin.master-keamanan-privasi') }}">Master Keamanan Privasi</a>
                    <a class="nav-link {{ request()->routeIs('admin.master-panduan') ? 'active' : '' }}" href="{{ route('admin.master-panduan') }}">Master Panduan</a>
                </nav>
            </div>
            {{--  --}}
            <a class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Laporan
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ request()->routeIs('admin.laporan.*') ? 'show' : '' }}" id="collapsePages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link {{ request()->routeIs('admin.laporan.index') ? 'active' : '' }}" href="{{ route('admin.laporan.index') }}">Laporan Hasil</a>
                    <a class="nav-link {{ request()->routeIs('admin.laporan.index2') ? 'active' : '' }}" href="{{ route('admin.laporan.index2') }}">Laporan Tugas Pokok</a>
                    <a class="nav-link {{ request()->routeIs('admin.laporan.index3') ? 'active' : '' }}" href="{{ route('admin.laporan.index3') }}">Laporan Tugas Penunjang</a>
                    <!-- <a class="nav-link" href="{{ route('admin.laporan.index4') }}">Laporan Tugas Lain Lain</a> -->
                    <a class="nav-link {{ request()->routeIs('admin.laporan.index5') ? 'active' : '' }}" href="{{ route('admin.laporan.index5') }}">Laporan Tugas Tambahan</a>
                    <a class="nav-link {{ request()->routeIs('admin.laporan.index6') ? 'active' : '' }}" href="{{ route('admin.laporan.index6') }}">Laporan per Perawat</a>

                </nav>
                
            </div>
            <a class="nav-link {{ request()->routeIs('admin.data-rumah-sakit') ? 'active' : '' }}" href="{{ route('admin.data-rumah-sakit') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-hospital"></i></div>
                Data Rumah Sakit
            </a>
            {{-- <div class="sb-sidenav-menu-heading">Addons</div>
            <a class="nav-link" href="charts.html">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Charts
            </a>
            <a class="nav-link" href="tables.html">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tables
            </a> --}}
        </div>
    </div>
  
</nav>