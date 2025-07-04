@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Laporan Hasil Tindakan Tugas Pokok (Lain-Lain)</h2>

    <div class="table-responsive">
        <table id="laporanTable" class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Perawat</th>
                    @foreach($tindakanLainLain as $tindakan)
                        <th>{{ $tindakan->tindakan ?? 'Tidak Ada Data' }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($perawatTindakan as $userId => $tindakanJumlah)
                    <tr>
                        <td>{{ $laporan->where('user_id', $userId)->first()->user->nama_lengkap ?? 'Tidak Ada Data' }}</td>
                        @foreach($tindakanLainLain as $tindakan)
                            <td>{{ $tindakanJumlah[$tindakan->id] ?? 0 }}</td>
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
