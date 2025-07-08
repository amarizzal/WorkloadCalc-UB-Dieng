@extends('perawat.layouts.app')

@section('content')
<Style>
    @media (max-width: 576px) {
        .card {
            margin-bottom: 20px;
        }

        form .form-control,
        form .btn {
            font-size: 14px;
        }

        h5.card-title {
            font-size: 18px;
        }
    }

    .card-header {
        cursor: pointer;
    }
</Style>

<!-- Menampilkan alert jika ada success atau error -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container mt-4">
    <!-- Form Filter Rentang Tanggal -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('perawat.hasil') }}" method="GET">
                <div class="row">
                    <div class="col-md-5">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-5">
                        <label for="end_date">Tanggal Akhir</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tugas Pokok --}}
    <h4>Tugas Pokok</h4>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-dark">
                <th>Tindakan</th>
                <th>Tanggal</th>
                <th>Mulai</th>
                <th>Berhenti</th>
                <th>Durasi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @if ($laporan->where('tindakan.status', 'Tugas Pokok')->count() > 0)
                @foreach ($laporan->where('tindakan.status', 'Tugas Pokok') as $data)
                    <tr>
                        <td class="text-center">{{ $data->tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                        <td class="text-center">{{ $data->tanggal }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($data->jam_mulai)->format('H:i:s') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($data->jam_berhenti)->format('H:i:s') }}</td>
                        <td class="text-center">{{ floor($data->durasi / 60) }} menit {{ $data->durasi % 60 }} detik</td>
                        <td class="text-center">{{ $data->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">Tidak ada tindakan pokok yang ditemukan.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Tugas Penunjang --}}
    <h4>Tugas Penunjang</h4>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-dark">
                <th>Tindakan</th>
                <th>Tanggal</th>
                <th>Mulai</th>
                <th>Berhenti</th>
                <th>Durasi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @if ($laporan->where('tindakan.status', 'Tugas Penunjang')->count() > 0)
                @foreach ($laporan->where('tindakan.status', 'Tugas Penunjang') as $data)
                    <tr>
                        <td class="text-center">{{ $data->tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                        <td class="text-center">{{ $data->tanggal }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($data->jam_mulai)->format('H:i:s') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($data->jam_berhenti)->format('H:i:s') }}</td>
                        <td class="text-center">{{ floor($data->durasi / 60) }} menit {{ $data->durasi % 60 }} detik</td>
                        <td class="text-center">{{ $data->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">Tidak ada tindakan penunjang yang ditemukan.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Tugas Tambahan --}}
    <h4>Tugas Tambahan</h4>
    <table class="table table-striped table-bordered mb-5">
        <thead>
            <tr class="table-dark">
                <th>Tindakan</th>
                <th>Tanggal </th>
                <th>Waktu </th>
                <th>Keterangan </th>
            </tr>
        </thead>
        <tbody>
            @if ($laporan->where('tindakan.status', 'tambahan')->count() > 0)
                @foreach ($laporan->where('tindakan.status', 'tambahan') as $data)
                    <tr>
                        <td>{{ $tindakan->tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                        <td>{{ $tindakan->tanggal ?? '-' }}</td>
                        <td>{{ $tindakan->waktu ?? '-' }}</td>
                        <td>{{ $tindakan->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">Tidak ada tindakan penunjang yang ditemukan.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Hasil Analisa Data --}}
    @if ($recordAnalisa)
        <h4 class="mt-4">Hasil Analisa Data <span style="font-size: 0.6em;" class="text-sm">({{ \Carbon\Carbon::parse($recordAnalisa->created_at)->format('d/m/Y') }})</span></h4> 
        <p>Tindakan pokok pada <strong>{{ \Carbon\Carbon::parse($recordAnalisa->tanggal_awal)->format('d/m/Y') }}</strong> -> <strong>{{ \Carbon\Carbon::parse($recordAnalisa->tanggal_akhir)->format('d/m/Y') }}</strong></p>
        <table class="table table-bordered  table-striped">
            <thead>
                <tr class="">
                    <th>Tindakan</th>
                    <th>Frekuensi</th>
                    <th>SWL (Jam)</th>
                    <th>Hasil (Jam)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalHasil = 0;
                    $grouped = $recordAnalisa->laporanTindakan->groupBy('tindakan_id');
                @endphp
                @foreach($grouped as $tindakan)
                    <tr>
                        {{-- @foreach($tindakan as $perawatItem) --}}
                            @php
                                // Kelompokkan laporan berdasarkan tindakan_id
                                

                                // dd($tindakan);

                                // Total jam semua laporan untuk tindakan ini
                                $totalJamTindakan = collect($tindakan)->sum(function ($laporan) {
                                    $mulai = \Carbon\Carbon::parse($laporan->jam_mulai);
                                    $berhenti = \Carbon\Carbon::parse($laporan->jam_berhenti);
                                    return $mulai->floatDiffInHours($berhenti);
                                });
                            @endphp
                        {{-- @endforeach --}}
                        
                        <td>
                            <strong>{{ $tindakan->first()->tindakan->tindakan ?? 'Tidak Ada Data' }}</strong>

                        </td>
                        <td class="text-center">
                            <strong>{{ $tindakan->count() }}</strong>
                        </td>
                        <td class="text-center">
                            @if ($tindakan->count() > 0)
                                <strong>{{ number_format($totalJamTindakan, 2) }}</strong>
                            @else
                                <strong>0</strong>
                            @endif

                            @if ($tindakan->count() > 0)
                                
                                <div class="collapse" id="collapse{{ $tindakan->first()->id }}">
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
                            {{ number_format($totalJamTindakan * $tindakan->count(), 3) }}
                            @php
                                $totalHasil += number_format(number_format($totalJamTindakan, 3) * $tindakan->count(), 2)
                            @endphp
                        </td>
                        @php
                            $grouped = [];
                        @endphp
                    </tr>
                @endforeach
                {{-- @foreach($rataRataWaktu as $tindakanId => $rataWaktu)
                    <tr>
                        <td>{{ $laporan->where('tindakan_id', $tindakanId)->first()->tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                        <td>{{ number_format($rataWaktu, 2) }} jam</td>
                        <td>{{ number_format($swl[$tindakanId], 2) }}</td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
        <div class="form-group row my-3 mt-5 align-items-center">
            <label for="libur_nasional" class="col-sm-3 col-form-label"><strong>Total Waktu Kerja</strong></label>
            <div class="col-sm-9">
            <input required type="number" class="form-control form-control-lg" id="total_waktu_kerja" name="total_waktu_kerja" value="{{ $recordAnalisa->total_waktu_kerja }}" readonly style="font-size: 2rem;">
            </div>
        </div>
        <div class="form-group row my-5 mt-5 align-items-center">
            <label for="libur_nasional" class="col-sm-3 col-form-label"><strong>Beban Kerja</strong></label>
            <div class="col-sm-9">
            <input required type="text" class="form-control form-control-lg
            @php
                if ($recordAnalisa->beban_kerja < 1.0) {
                $bebanKerjaClass = 'bg-warning';
                $stringBebanKerja = '(Rendah)';
                } else if ($recordAnalisa->beban_kerja >= 1.0 && $recordAnalisa->beban_kerja <= 1.1) {
                $bebanKerjaClass = 'bg-success';
                $stringBebanKerja = '(Normal)';
                } else {
                $bebanKerjaClass = 'bg-danger';
                $stringBebanKerja = '(Tinggi)';
                }
            @endphp
            {{ $bebanKerjaClass ?? '' }}" id="beban_kerja" name="beban_kerja" value="{{ $recordAnalisa->beban_kerja }} {{ $stringBebanKerja ?? '' }}" readonly style="font-size: 2rem;">
            </div>
        </div>
    @endif

    {{-- <!-- Menampilkan laporan sesuai rentang tanggal dengan urutan terbaru -->
    @if ($laporan->isEmpty())
        <div class="alert alert-warning text-center">
            Tidak ada laporan tindakan untuk periode {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}.
        </div>
    @else
        <div class="row">
            @php
                $previousDate = null;
            @endphp
            @foreach ($laporan as $laporanItem)
                @php
                    $currentDate = \Carbon\Carbon::parse($laporanItem->jam_berhenti)->format('Y-m-d');
                @endphp

                @if ($currentDate != $previousDate)
                    <div class="col-12">
                        <h4 class="text-center mb-4">---------- {{ \Carbon\Carbon::parse($laporanItem->jam_berhenti)->format('d-m-Y') }} ----------</h4>
                    </div>
                @endif

                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header" id="heading{{ $laporanItem->id }}" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $laporanItem->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $laporanItem->id }}">
                            <h5 class="card-title d-flex justify-content-between">
                                <span>{{ $laporanItem->tindakan ? $laporanItem->tindakan->tindakan : 'N/A' }}</span>
                                <span>{{ \Carbon\Carbon::parse($laporanItem->jam_berhenti)->format('H:i') }}</span>
                            </h5>
                        </div>

                        <div id="collapse{{ $laporanItem->id }}" class="collapse"
                            aria-labelledby="heading{{ $laporanItem->id }}" data-bs-parent=".row">
                            <div class="card-body">
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($laporanItem->jam_berhenti)->format('d-m-Y') }}</p>

                                @php
                                    $durasiMenit = floor($laporanItem->durasi / 60);
                                    $durasiDetik = $laporanItem->durasi % 60;
                                @endphp
                                <p><strong>Durasi:</strong> {{ $durasiMenit }} menit {{ $durasiDetik }} detik</p>

                                <p><strong>Shift:</strong> {{ $laporanItem->shift ? $laporanItem->shift->nama_shift : 'N/A' }}</p>
                                <p><strong>Status:</strong> {{ $laporanItem->durasi ? 'Selesai' : 'Belum Selesai' }}</p>
                                <p><strong>Jam Berhenti:</strong> {{ \Carbon\Carbon::parse($laporanItem->jam_berhenti)->format('H:i') }}</p>

                                @if ($laporanItem->keterangan)
                                    <div class="mt-3">
                                        <p><strong>Keterangan:</strong> {{ $laporanItem->keterangan }}</p>
                                    </div>
                                @else
                                    <div class="mt-3">
                                        <form action="{{ route('perawat.keterangan.store', $laporanItem->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <textarea class="form-control" name="keterangan" placeholder="Masukkan keterangan..." rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-2">Simpan Keterangan</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $previousDate = $currentDate;
                @endphp
            @endforeach
        </div>
    @endif --}}
</div>
@endsection
