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

    <!-- Menampilkan laporan sesuai rentang tanggal dengan urutan terbaru -->
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
    @endif
</div>
@endsection
