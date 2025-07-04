@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Laporan Hasil Tindakan Tugas Penunjang</h2>

    <!-- Form Filter Tanggal -->
    <form method="GET" action="{{ route('admin.laporan.index3') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="tanggal_awal">Tanggal Awal:</label>
                <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" required class="form-control">
            </div>
            <div class="col-md-4">
                <label for="tanggal_akhir">Tanggal Akhir:</label>
                <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" required class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table id="laporanTable" class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Total</th>
                    <th>Tindakan</th>
                    @foreach($perawat as $perawatItem)
                        <th>{{ $perawatItem->nama_lengkap ?? 'Tidak Ada Data' }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($tindakanPenunjang as $tindakan)
                    <tr>
                        <td>{{ $totalTindakan[$tindakan->id] ?? 0 }}</td>
                        <td>{{ $tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                        @foreach($perawat as $perawatItem)
                            <td>{{ $perawatTindakan[$perawatItem->id][$tindakan->id] ?? 0 }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <h4>Rata-rata Waktu Per Tindakan</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tindakan</th>
                    <th>Total Tindakan</th>
                    <th>Rata-rata Waktu (Jam)</th>
                    <th>Standar Workload (SWL)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rataRataWaktu as $tindakanId => $rataWaktu)
                    @if($rataWaktu > 0) <!-- Menampilkan hanya tindakan yang memiliki waktu -->
                        <tr>
                            <td>{{ $laporan->where('tindakan_id', $tindakanId)->first()->tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                            <td>{{ $totalTindakan[$tindakanId] ?? 0 }}</td>
                            <td>{{ number_format($rataWaktu / 60, 2) }} jam</td>
                            <td>{{ number_format($swl[$tindakanId], 2) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
