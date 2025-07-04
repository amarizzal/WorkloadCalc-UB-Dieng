<!-- home.blade.php -->
@extends('perawat.layouts.app')

@section('content')

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

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Ubah Password</h5>
                </div>
                <div class="card-body">
                    <!-- Form untuk ubah password -->
                    <form method="POST" action="{{ route('perawat.ubahpassword.update') }}">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Password Lama</label>
                            <input type="password" name="current_password" id="current_password" class="form-control" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="new_password">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
