@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Laporan Hasil Tindakan Tugas Pokok</h2>

    <!-- Form Filter Tanggal -->
    <form method="GET" action="{{ route('admin.laporan.index2') }}" class="mb-3">
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
                    <th class="text-center">Detail</th>
                    <th class="text-center">Tindakan</th>
                    <th class="text-center">Frekuensi</th>
                    <th class="text-center">Waktu (Jam)</th>
                    <th class="text-center">SWL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tindakanPokok as $tindakan)
                    <tr>
                        @foreach($tindakan->laporanTindakan as $perawatItem)
                            @php
                                // Kelompokkan laporan berdasarkan user_id
                                $grouped = $tindakan->laporanTindakan->groupBy('user_id');

                                // Total jam semua laporan untuk tindakan ini
                                $totalJamTindakan = collect($tindakan->laporanTindakan)->sum(function ($laporan) {
                                    $mulai = \Carbon\Carbon::parse($laporan->jam_mulai);
                                    $berhenti = \Carbon\Carbon::parse($laporan->jam_berhenti);
                                    return $mulai->floatDiffInHours($berhenti);
                                });
                            @endphp
                        @endforeach
                        <td class="text-center">
                            <button class="btn btn-info btn-sm" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $tindakan->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $tindakan->id }}">
                                <i class="fas fa-caret-down"></i>
                            </button>
                        </td>
                        <td>
                            <strong>{{ $tindakan->tindakan ?? 'Tidak Ada Data' }}</strong>

                            @if ($tindakan->laporanTindakan->count() > 0)
                            <div class="collapse" id="collapse{{ $tindakan->id }}">
                                <span style="display:block; margin-top:2px;"></span>
                                @if (!collect($grouped)->isEmpty())
                                    @foreach($grouped as $userId => $laporanGroup)
                                        @php
                                            $user = $laporanGroup->first()->user;
                                        @endphp
                                        <p class="my-2">{{ $user->nama_lengkap ?? 'Tidak Ada Data' }}</p>
                                    @endforeach
                                    
                                @endif
                            </div>
                            @endif
                        </td>
                        <td class="text-center">
                            <strong>{{ $tindakan->laporanTindakan->count() }}</strong>
                            @if ($tindakan->laporanTindakan->count() > 0)
                                <div class="collapse" id="collapse{{ $tindakan->id }}">
                                    <span style="display:block; margin-top:2px;"></span>
                                    @if (!collect($grouped)->isEmpty())
                                        @foreach($grouped as $userId => $laporanGroup)
                                            @php
                                                $user = $laporanGroup->first()->user;
                                            @endphp
                                            <p class="text-center my-2">{{ $laporanGroup->count() }}</p>
                                        @endforeach
                                        
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($tindakan->laporanTindakan->count() > 0)
                                <strong>{{ number_format($totalJamTindakan, 2) }}</strong>
                            @else
                                <strong>0</strong>
                            @endif

                            @if ($tindakan->laporanTindakan->count() > 0)
                                
                                <div class="collapse" id="collapse{{ $tindakan->id }}">
                                    <span style="display:block; margin-top:2px;"></span>

                                    @foreach ($grouped as $nama => $items)
                                        @php
                                            $totalJam = $items->sum(function ($laporan) {
                                                $mulai = \Carbon\Carbon::parse($laporan->jam_mulai);
                                                $berhenti = \Carbon\Carbon::parse($laporan->jam_berhenti);
                                                return $mulai->floatDiffInHours($berhenti); // Menghasilkan dalam satuan jam desimal
                                            });
                                        @endphp

                                        <p class="text-center my-2">{{ number_format($totalJam, 2) }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($tindakan->laporanTindakan->count() > 0)
                                <strong>{{ number_format($totalJamTindakan, 2)/$tindakan->laporanTindakan->count() }}</strong>
                            @else
                                <strong>0</strong>
                            @endif
                        </td>
                        @php
                            $grouped = [];
                        @endphp
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
