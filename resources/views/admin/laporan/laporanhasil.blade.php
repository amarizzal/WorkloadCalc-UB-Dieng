@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Laporan Tindakan Perawat</h2>

    <div class="row">
        <div class="col-md-6">
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" class="form-control">
        </div>
    </div>
    <br>
    

    <div class="table-responsive">
        <table id="laporanTable" class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Perawat</th>
                    <th class="text-center">Nama Ruangan</th>
                    <th class="text-center">Shift Kerja</th>
                    <th class="text-center">Tindakan</th>
                    <th class="text-center">Status Tindakan</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Jam Mulai</th>
                    <th class="text-center">Jam Berhenti</th>
                    <th class="text-center">Durasi</th>
                    <th class="text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan as $index => $data)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $data->user->nama_lengkap ?? 'Tidak Ada Data' }}</td>
                        <td class="text-center">{{ $data->ruangan->nama_ruangan ?? 'Tidak Ada Data' }}</td>
                        <td class="text-center">{{ $data->shift->nama_shift ?? 'Tidak Ada Data' }}</td>
                        <td class="text-center">{{ $data->tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                        <td class="text-center">{{ $data->tindakan->status ?? 'Tidak Ada Status' }}</td>
                        <td class="text-center">{{ $data->tanggal }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($data->jam_mulai)->format('H:i:s') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($data->jam_berhenti)->format('H:i:s') }}</td>
                        <td class="text-center">{{ floor($data->durasi / 60) }} menit {{ $data->durasi % 60 }} detik</td>
                        <td class="text-center">{{ $data->keterangan ?? 'Tidak Ada Keterangan' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
