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
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Waktu Kegiatan (jam)</th>
                    <th>Faktor (%)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalFaktor = 0;
                @endphp
                @foreach($tindakanPenunjang as $tindakan)
                    <tr>
                        <td>{{ $totalTindakan[$tindakan->id] ?? 0 }}</td>
                        <td>{{ $tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                        <td>{{ $tindakan->satuan ?? '-' }}</td>
                        <td>{{ $tindakan->kategori ?? '-' }}</td>
                        <td>
                            {{ $tindakan->waktu ?? '0' }}
                        </td>
                        <td>
                            @php
                                $totalWaktu = 0;
                                // if($tindakan->satuan == 'jam') {
                                //     $totalWaktu = $tindakan->waktu * 1; 
                                // } elseif($tindakan->satuan == 'menit') {
                                //     $totalWaktu = $tindakan->waktu / 60; 
                                // } elseif($tindakan->satuan == 'hari') {
                                //     $totalWaktu = $tindakan->waktu * 24; 
                                // }
                                if ($tindakan->kategori == 'harian') {
                                    $totalWaktu = $totalWaktu * 264; // 264 hari kerja dalam setahun
                                } elseif ($tindakan->kategori == 'mingguan') {
                                    $totalWaktu = $totalWaktu * 52; // 52 minggu dalam setahun
                                } elseif ($tindakan->kategori == 'bulanan') {
                                    $totalWaktu = $totalWaktu * 12; // 12 bulan dalam setahun
                                } elseif ($tindakan->kategori == 'tahunan') {
                                    $totalWaktu = $totalWaktu; // Sudah dalam satuan tahunan
                                }
                                $faktor = $totalWaktu > 0 ? ($totalWaktu / $hospitalTime) * 100 : 0;
                                $faktor = number_format($faktor, 2);

                                $totalFaktor += $faktor;
                            @endphp
                            {{ $faktor }}
                        </td>
                    </tr>
                @endforeach
                @php
                    // Menghitung rata-rata faktor
                    $totalTindakanForFaktor = count($tindakanPenunjang);
                    $averageFaktor = $totalTindakanForFaktor > 0 ? $totalFaktor / $totalTindakanForFaktor : 0;
                    $averageFaktor = number_format($averageFaktor, 2);
                @endphp
                <tr>
                    <td colspan="5" class="text-end fw-bold">Rata-rata Faktor (%)</td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td>{{ $averageFaktor }}</td>
                    <td class="d-none"></td>
                </tr>
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
                    <th>Allowance Factor (AF)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tindakanPenunjang as $tindakan)
                    @if( isset($tindakan->waktu) && $tindakan->waktu > 0 && !array_key_exists($tindakan->id, $totalTindakan))
                        @continue <!-- Lewati tindakan dengan waktu 0 -->
                    @else   
                        @php
                            
                            $jamTersediaPerTahun = $hospitalTime; // Total jam kerja per tahun
                            $rataWaktu = $tindakan->waktu > 0 ? ($tindakan->waktu / $tindakan->count()) : 0;
                            $swl = $rataWaktu > 0 ? $jamTersediaPerTahun / ($rataWaktu / 60) : 0;
                        @endphp
                        <tr>
                            <td>{{ $tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                            <td>{{ $totalTindakan[$tindakan->id] ?? 0 }}</td>
                            <td>{{ number_format($rataWaktu / 60, 2) }} jam</td>
                            <td>{{ number_format($swl, 2) }}</td>
                            <td>{{ number_format(1 / (1 - ($averageFaktor/100)), 2) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
