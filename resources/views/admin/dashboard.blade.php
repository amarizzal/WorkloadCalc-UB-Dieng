@extends('admin.layouts.app')

@section('content')
    <h1>Welcome to the Admin Dashboard</h1>
    <p>This is where you can manage your site's data.</p>

    <div class="row align-items-center mx-5" style="min-height: 60vh;">
        <div class="col-md-4 col-12">
            <a class="d-block" href="{{route('admin.master-user')}}" style="text-decoration: none; color: inherit;">
            <img src="images/icon/master.png" alt="FIKES UB" class="text-center mx-auto d-block" style="width: 200px; ">
            <h3 class="text-center"><strong>Master</strong></h3>
            </a>
        </div>
        <div class="col-md-4 col-12">
            <a class="d-block" href="{{route('admin.laporan.index')}}" style="text-decoration: none; color: inherit;">
            <img src="images/icon/laporan.png" alt="FIKES UB" class="text-center mx-auto d-block" style="width: 200px; ">
            <h3 class="text-center"><strong>Laporan</strong></h3>
            </a>
        </div>
        <div class="col-md-4 col-12">
            <a class="d-block" href="#" style="text-decoration: none; color: inherit;">
            <img src="images/icon/dataRumahSakit.png" alt="FIKES UB" class="text-center mx-auto d-block" style="width: 200px; ">
            <h3 class="text-center"><strong>Data Rumah Sakit</strong></h3>
            </a>
        </div>
    </div>
@endsection
