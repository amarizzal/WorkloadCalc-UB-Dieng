@props(['titlePage'])

<link id="pagestyle" href="{{ asset('css/custom-datatables.css') }}" rel="stylesheet" />

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-1 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid row py-1 px-1">
        <nav aria-label="breadcrumb" class="col-6 ps-2">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0  ">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Perawat</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><strong>{{ $titlePage }}</strong></li>
            </ol>
            {{-- <h6 class="font-weight-bolder mb-0">{{ $titlePage }}</h6> --}}
        </nav>
        <div class="col-6 mt-sm-0 mt-2" id="navbar">
            {{-- <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                    <label class="form-label">Type here...</label>
                    <input type="text" class="form-control">
                </div>
            </div> --}}
            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                @csrf
            </form>
            <ul class="navbar-nav  justify-content-end ms-md-auto pe-md-3">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="d-flex px-1 py-1">
                            <div>
                                <img src="{{ asset('assets') }}/img/team-2.jpg"
                                    class="avatar avatar-sm me-1 border-radius-lg"
                                    alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm text-truncate" style="max-width: 120px;">{{ auth()->user()->nama_lengkap }}</h6>
                                <p class="text-xs text-secondary mb-0 text-truncate" style="max-width: 120px;">{{ auth()->user()->email }}
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
