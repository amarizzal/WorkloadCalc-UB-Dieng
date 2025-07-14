
<!-- layouts/bottomnav.blade.php -->
<div class="bottom-nav">
    <div class="row g-0">
        <div class="col">
            <a href="{{ route('perawat.dashboard') }}" class="nav-item {{ request()->routeIs('perawat.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house"></i>
                <span>Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('perawat.timer') }}" class="nav-item {{ request()->routeIs('perawat.timer') ? 'active' : '' }}">
                <i class="bi bi-clock"></i>
                <span>Tugas Pokok</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('perawat.tindakan') }}" class="nav-item {{ request()->routeIs('perawat.tindakan') ? 'active' : '' }}">
                <i class="bi bi-pencil-square"></i>
                <span>Tugas Penunjang</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('perawat.tindakan.tambahan') }}" class="nav-item {{ request()->routeIs('perawat.tindakan.tambahan') ? 'active' : '' }}">
                <i class="bi bi-plus-square"></i>
                <span>Tugas Tambahan</span>
            </a>
        </div>
        
        <div class="col">
            <a href="{{ route('perawat.hasil') }}" class="nav-item {{ request()->routeIs('perawat.hasil') ? 'active' : '' }}">
                <i class="bi bi-file-text"></i>
                <span>Hasil</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('perawat.profil') }}" class="nav-item {{ request()->routeIs('perawat.profil') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i>
                <span>Profil</span>
            </a>
        </div>
    </div>
</div>