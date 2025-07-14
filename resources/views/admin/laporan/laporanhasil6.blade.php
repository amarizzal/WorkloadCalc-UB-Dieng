@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Laporan Tindakan Perawat Per User</h2>

        <!-- Dropdown untuk memilih user -->
        <form method="GET" action="{{ route('admin.laporan.index6') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="user_id" class="form-label">Pilih Perawat:</label>
                    <select name="user_id" id="user_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Pilih Perawat --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
                                {{ $user->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                    @if ($users->count() == 0)
                        <label for="user_id" class="form-label text-danger">Belum ada perawat yang melakukan tindakan.</label>
                    @endif
                </div>
            </div>
        </form>

        @if ($selectedUserId)
                {{-- Show tindakan, separate by status --}}

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
                        @if (isset($tindakanGrouped['Tugas Penunjang']))
                            @if (count($tindakanGrouped['Tugas Pokok']) == 0)
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada tindakan pokok yang ditemukan.</td>
                                </tr>
                            @else
                                @foreach ($tindakanGrouped['Tugas Pokok'] as $data)
                                    <tr>
                                        <td class="text-center">{{ $data->tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                                        <td class="text-center">{{ $data->tanggal }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($data->jam_mulai)->format('H:i:s') }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($data->jam_berhenti)->format('H:i:s') }}</td>
                                        <td class="text-center">{{ floor($data->durasi / 60) }} menit {{ $data->durasi % 60 }} detik</td>
                                        <td class="text-center">{{ $data->keterangan ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @endif
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
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <th>Waktu</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($tindakanGrouped['Tugas Penunjang']))
                            @if (count($tindakanGrouped['Tugas Penunjang']) == 0)
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada tindakan penunjang yang ditemukan.</td>
                                </tr>
                            @else
                                @foreach ($tindakanGrouped['Tugas Penunjang'] as $tindakan)
                                    <tr>
                                        <td>{{ $tindakan->tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                                        <td>{{ $tindakan->tanggal ?? '-' }}</td>
                                        <td>{{ $tindakan->tindakan->satuan ?? '-' }}</td>
                                        <td>{{ $tindakan->tindakan->kategori ?? '-' }}</td>
                                        <td class="text-center">{{ $tindakan->tindakan->waktu ?? '-' }} {{ $tindakan->tindakan->waktu ? $tindakan->tindakan->satuan : '-' }}</td>
                                        <td>{{ $tindakan->keterangan ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada tindakan penunjang yang ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                {{-- Tugas Tambahan --}}
                <h4>Tugas Tambahan</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="table-dark">
                            <th>Tindakan</th>
                            <th>Tanggal </th>
                            <th>Waktu </th>
                            <th>Keterangan </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($tindakanGrouped['tambahan']))
                            @if (count($tindakanGrouped['tambahan']) == 0)
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada tindakan tambahan yang ditemukan.</td>
                                </tr>
                            @else
                                @foreach ($tindakanGrouped['tambahan'] as $tindakan)
                                    <tr>
                                        <td>{{ $tindakan->tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                                        <td>{{ $tindakan->tanggal ?? '-' }}</td>
                                        <td>{{ $tindakan->waktu ?? '-' }}</td>
                                        <td>{{ $tindakan->keterangan ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada tindakan tambahan yang ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                   <!-- Bagian Bawah: Rata-rata Waktu dan SWL -->
            <h4 class="mt-4">Ringkasan</h4>
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
                    @endphp
                    @foreach($tindakanPokok as $tindakan)
                        <tr>
                            @foreach($tindakanPokok as $perawatItem)
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
                            
                            <td>
                                <strong>{{ $tindakan->tindakan ?? 'Tidak Ada Data' }}</strong>

                            </td>
                            <td class="text-center">
                                <strong>{{ $tindakan->laporanTindakan->count() }}</strong>
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
                                @php
                                    $totalHasilPerTindakan = number_format($totalJamTindakan * $tindakan->laporanTindakan->count(), 3);
                                @endphp
                                {{ $totalHasilPerTindakan }}
                                @php
                                    $totalHasil += $totalHasilPerTindakan;
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

            {{-- analisa data --}}
            <form id="dataRumahSakitForm" action="{{ route('admin.data-rumah-sakit.update') }}" method="POST">
                @csrf
                <div class="form-group row my-3 mt-5">
                    <label for="libur_nasional" class="col-sm-3 col-form-label"><strong>Total Waktu Kerja</strong></label>
                    <div class="col-sm-9">
                    <input required type="number" class="form-control" id="total_waktu_kerja" name="total_waktu_kerja" value="{{ $totalHasil }}" readonly>
                    </div>
                </div>
            </form>


            {{-- Beban Kerja --}}
            <div class="row justify-content-center mt-5">
                <h4 class="mt-4">Analisa Data</h4>
                <div class="col-md-4">
                    <label for="tanggal_awal">Tanggal Awal:</label>
                    <input id="tanggal_awal" type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" required class="form-control"
                        {{-- max="{{ \Carbon\Carbon::today()->subDays(30)->subDay()->format('Y-m-d') }}"> --}}>
                </div>
                <div class="col-md-4">
                    <label for="tanggal_akhir">Tanggal Akhir:</label>
                    <input id="tanggal_akhir" type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" required class="form-control"
                        {{-- max="{{ \Carbon\Carbon::today()->subDays(30)->subDay()->format('Y-m-d') }}"> --}}>
                </div>
            </div>
            <div class="form-group row my-3 mt-5">
                <div class="col-auto mx-auto">
                    <button type="button" id="analisaDataButton" class="btn btn-danger"><strong>ANALISA DATA</strong></button>
                </div>
            </div>
            <div class="form-group row my-3 mt-5 align-items-center">
                <label for="libur_nasional" class="col-sm-3 col-form-label"><strong> Beban Kerja</strong></label>
                <div class="col-sm-9">
                <input required type="text" class="form-control" id="beban_kerja" name="beban_kerja" readonly style="font-size: 2rem;">
                </div>
            </div>

        @else
            <p class="text-center mt-4">Silakan pilih perawat dari dropdown di atas untuk melihat laporan.</p>
        @endif
    </div>

    <!-- Script untuk AJAX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.tindakan-detail');
            const buttonDataAnalisa = document.querySelector('#analisaDataButton');
            const detailContainer = document.getElementById('detailTindakanContainer');
            const detailBody = document.getElementById('detailTindakanBody');
            const bebanKerja = document.getElementById('beban_kerja');
            let userId = '';

            links.forEach(link => {
                link.addEventListener('click', function() {
                    const tindakanId = this.getAttribute('data-tindakan-id');
                    userId = this.getAttribute('data-user-id');

                    // Clear previous details
                    detailBody.innerHTML = '';
                    detailContainer.style.display = 'none';

                    // Fetch detail data via AJAX
                    fetch(`/admin/laporan/detail-tindakan/${tindakanId}/${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log('Data received from server:', data); // Tampilkan data di console

                            detailBody.innerHTML = ''; // Clear previous data
                            if (data.length > 0) {
                                data.forEach((item, index) => {
                                    const row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.tanggal}</td>
                                    <td>${item.durasi}</td>
                                    <td>${item.keterangan}</td>
                                    <td>${item.shift}</td>
                                    <td>${item.jam_mulai}</td>
                                    <td>${item.jam_berhenti}</td>
                                </tr>
                            `;
                                    detailBody.innerHTML += row;
                                });
                            }
                            detailContainer.style.display = 'block';
                        })
                        .catch(error => {
                            console.error('Error fetching detail data:', error);
                        });
                });
            });

            buttonDataAnalisa.addEventListener('click', function() {

                const tanggalAwal = document.getElementById('tanggal_awal').value;
                const tanggalAkhir = document.getElementById('tanggal_akhir').value;
                const totalWaktuKerja = document.getElementById('total_waktu_kerja').value;

                const userId = document.getElementById('user_id').value;

                if(tanggalAwal === '' || tanggalAkhir === '' || totalWaktuKerja === '') {
                    alert('Mohon lengkapi tanggal sebelum melakukan analisa data.');
                    return;
                }

                // Fetch detail data via AJAX
                fetch(`/admin/laporan/analisa-data/${userId}?tanggalAwal=${tanggalAwal}&tanggalAkhir=${tanggalAkhir}&totalWaktuKerja=${totalWaktuKerja}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Data received from server:', data); // Tampilkan data di console
                        
                        // Update Beban Kerja
                        let stringBebanKerja = '';
                        if (data.result < 1.0) {
                            bebanKerja.classList.add('bg-warning');
                            bebanKerja.classList.remove('bg-success', 'bg-danger');
                            stringBebanKerja = '(Rendah)';
                        } else if (data.result >= 1.0 && data.result <= 1.1) {
                            bebanKerja.classList.add('bg-success');
                            bebanKerja.classList.remove('bg-warning', 'bg-danger');
                            stringBebanKerja = '(Normal)';
                        } else {
                            bebanKerja.classList.remove('bg-success', 'bg-warning');
                            bebanKerja.classList.add('bg-danger');
                            stringBebanKerja = '(Tinggi)';
                        }
                        bebanKerja.value = `${data.result} ${stringBebanKerja}`;
                        // detailBody.innerHTML = ''; // Clear previous data
                        // if (data.length > 0) {
                        //     data.forEach((item, index) => {
                        //         const row = `
                        //     <tr>
                        //         <td>${index + 1}</td>
                        //         <td>${item.tanggal}</td>
                        //         <td>${item.durasi}</td>
                        //         <td>${item.keterangan}</td>
                        //         <td>${item.shift}</td>
                        //         <td>${item.jam_mulai}</td>
                        //         <td>${item.jam_berhenti}</td>
                        //     </tr>
                        // `;
                        //         detailBody.innerHTML += row;
                        //     });
                        // }
                        // detailContainer.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error fetching detail data:', error);
                    });
            });
        });
    </script>
@endsection
