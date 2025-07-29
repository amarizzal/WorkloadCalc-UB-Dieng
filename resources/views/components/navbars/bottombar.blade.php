@props(['activePage'])

<style>
    .bottom-nav a {
        border-radius: 10px;
        padding: 10px 10px;
        transition: 0.3s;
    }

    .bottom-nav .nav-active {
        background-color: #f28c00; /* Warna oranye */
        color: white !important;
    }
</style>

<div class="bottom-nav fixed-bottom bg-gradient-dark border-top shadow d-flex justify-content-around py-2">
    <a href="{{ route('perawat.dashboard') }}" 
        class="text-center {{ $activePage == 'dashboard' ? 'nav-active' : 'text-white' }}">
        <i class="material-icons d-block">dashboard</i>
        <small>Dashboard</small>
    </a>

    <a href="{{ route('perawat.timer') }}" 
        class="text-center {{ $activePage == 'pokok' ? 'nav-active' : 'text-white' }}">
        <i class="material-icons d-block">work</i>
        <small>Pokok</small>
    </a>

    <a href="{{ route('perawat.tindakan') }}" 
        class="text-center {{ $activePage == 'penunjang' ? 'nav-active' : 'text-white' }}">
        <i class="material-icons d-block">cases</i>
        <small>Penunjang</small>
    </a>

    <a href="{{ route('perawat.tindakan.tambahan') }}" 
        class="text-center {{ $activePage == 'tambahan' ? 'nav-active' : 'text-white' }}">
        <i class="material-icons d-block">add_box</i>
        <small>Tambahan</small>
    </a>

    <a href="{{ route('perawat.hasil') }}" 
        class="text-center {{ $activePage == 'hasil' ? 'nav-active' : 'text-white' }}">
        <i class="material-icons d-block">table_view</i>
        <small>Hasil</small>
    </a>

    <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
        @csrf
    </form>

    <a href="#" class="text-center text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="material-icons d-block">logout</i>
        <small>Logout</small>
    </a>
</div>
