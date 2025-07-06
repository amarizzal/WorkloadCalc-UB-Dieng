@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Laporan Hasil Tindakan Tambahan</h2>

    <!-- Form Filter Tanggal -->
    <form method="GET" action="{{ route('admin.laporan.index5') }}" class="mb-3">
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
                    <th>Tindakan</th>
                    <th>Nama Perawat</th>
                    <th>Waktu (Jam)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tindakanTambahan as $tindakan)
                    <tr>
                        <td>{{ $tindakan->tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                        <td>{{ $tindakan->user->nama_lengkap ?? '-' }}</td>
                        <td>{{ $tindakan->durasi ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <h4>Ringkasan</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Perawat</th>
                    <th>Total IAS (Jam)</th>
                    <th>IAF (Jam)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPerawat = [];
                    foreach ($tindakanTambahan as $tindakan) {
                        $namaPerawat = $tindakan->user->nama_lengkap ?? 'Tidak Ada Data';
                        $namaTindakan = $tindakan->tindakan->tindakan ?? 'Tidak Ada Data';
                        $durasi = $tindakan->durasi ?? 0;

                        if (!isset($totalPerawat[$namaPerawat])) {
                            $totalPerawat[$namaPerawat] = [];
                        }
                        if (!isset($totalPerawat[$namaPerawat][$namaTindakan])) {
                            $totalPerawat[$namaPerawat][$namaTindakan] = [
                                'frequency' => 0,
                                'durasi' => 0
                            ];
                        }
                        // Increment frequency and sum durasi if tindakan and perawat match
                        $totalPerawat[$namaPerawat][$namaTindakan]['frequency']++;
                        $totalPerawat[$namaPerawat][$namaTindakan]['durasi'] += $durasi;
                    }

                    // Hitung total waktu per perawat
                    $totalPerawatWaktu = [];
                    foreach ($totalPerawat as $namaPerawat => $tindakans) {
                        $totalWaktu = 0;
                        foreach ($tindakans as $tindakan) {
                            $totalWaktu += ($tindakan['frequency'] * $tindakan['durasi']);
                        }
                        $totalPerawatWaktu[$namaPerawat] = $totalWaktu;
                    }
                    $totalPerawat = $totalPerawatWaktu;
                @endphp
                @foreach ($totalPerawat as $namaPerawat => $totalWaktu)
                    <tr>
                        <td>{{ $namaPerawat }}</td>
                        <td>{{ $totalPerawat[$namaPerawat] ?? 0 }}</td>
                        <td>{{ $totalPerawat[$namaPerawat] / $hospitalTime }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
