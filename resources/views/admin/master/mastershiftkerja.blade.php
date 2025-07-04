@extends('admin.layouts.app')

@section('content')
<br>
<br>
    <h1 class="mb-4">Manajemen Shift Kerja</h1>

    <!-- Menampilkan alert jika ada pesan sukses atau error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <!-- Bagian Kiri: Form untuk menambah Shift Kerja -->
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Shift Kerja</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.master.shiftkerja.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_shift" class="form-label">Nama Shift</label>
                            <input type="text" class="form-control" id="nama_shift" name="nama_shift" required>
                        </div>
                        <div class="mb-3">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                            <input type="time" class="form-control" id="waktu_mulai" name="jam_mulai" required>
                        </div>
                        <div class="mb-3">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                            <input type="time" class="form-control" id="waktu_selesai" name="jam_selesai" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Shift</button>
                    </form>
                    
                    
                </div>
            </div>
        </div>

        <!-- Bagian Kanan: Tabel Shift Kerja -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Shift Kerja</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Shift</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shiftKerja as $shift)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $shift->nama_shift }}</td>  <!-- Menggunakan nama_shift -->
                                        <td>{{ $shift->jam_mulai }}</td>    <!-- Menggunakan jam_mulai -->
                                        <td>{{ $shift->jam_selesai }}</td>  <!-- Menggunakan jam_selesai -->
                                        <td>
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('admin.master.shiftkerja.delete', $shift->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
