@extends('admin.layouts.app')

@section('content')
<br>
    <h1 class="mb-4 text-center">Daftar Pengguna</h1>

    <div class="table-responsive">
        <table class="table table-hover table-bordered table-sm shadow-sm rounded">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Usia</th>
                    <th>Ruangan</th>
                    <th>Username</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nomor_telepon }}</td>
                        <td>{{ $user->jenisKelamin->nama ?? 'Tidak Diketahui' }}</td> <!-- Menampilkan jenis kelamin -->
                        <td>{{ $user->usia }}</td>
                        <td>{{ $user->ruangan->nama_ruangan ?? 'Tidak Diketahui' }}</td> <!-- Menampilkan ruangan -->
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

 
@endsection
