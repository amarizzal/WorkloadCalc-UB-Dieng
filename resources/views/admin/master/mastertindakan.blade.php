@extends('admin.layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<br>
    <h1 class="mb-4">Manajemen Tindakan dan Waktu</h1>

    <div class="row">
        <!-- Bagian Atas: Form untuk menambah Tindakan dan Waktu -->
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Tindakan dan Waktu</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.master.tindakan.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Kolom Kiri: Jenis Tindakan -->
                            <div class="col-md-6 mb-3">
                                <label for="tindakan" class="form-label">Tindakan</label>
                                <input type="text" class="form-control" id="tindakan" name="tindakan" required>
                            </div>
                            <!-- Kolom Kanan: Waktu (Menit) -->
                            <div class="col-md-6 mb-3">
                                <label for="waktu" class="form-label">Waktu (Menit)</label>
                                <input type="number" class="form-control" id="waktu" name="waktu" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option disabled selected>Pilih Jenis Tindakan</option>
                                    <option value="Tugas Pokok">Tugas Pokok</option>
                                    <option value="Tugas Penunjang">Tugas Penunjang</option>
                                    {{-- <option value="tambahan">Tugas Tambahan</option> --}}
                                </select>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bagian Bawah: Tabel Tindakan dan Waktu -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Tindakan dan Waktu</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Tindakan</th>
                                    <th>Waktu (Menit)</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tindakanWaktu as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tindakan }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->status }}</td> <!-- Tambahan kolom status -->
                                        <td>
                                            <!-- Tombol Edit dan Hapus -->
                                            <a href="{{ route('admin.master.tindakan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <!-- Form hapus dengan method DELETE -->
                                            <form action="{{ route('admin.master.tindakan.delete', $item->id) }}" method="POST" style="display:inline;">
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
