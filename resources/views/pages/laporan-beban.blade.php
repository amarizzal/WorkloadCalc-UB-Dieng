<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="laporan-perawat"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Per Perawat"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Laporan Tindakan Perawat</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2 mx-4">
                                <form method="GET" action="{{ route('admin.laporan.index6') }}" class="mb-4">
                                    <div class="input-group input-group-outline mb-4">
                                        <label for="exampleFormControlSelect1" class="ms-0 form-label">Pilih Perawat</label>
                                        <select class="form-control mt-5"name="user_id" id="user_id" onchange="this.form.submit()">
                                            <option value="">-- Pilih Perawat --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
                                                    {{ $user->nama_lengkap }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $totalHasil = 0;
                @endphp
                @if ($selectedUserId)
                {{-- Tugas Pokok --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Tugas Pokok</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tindakan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tanggal</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                     Mulai</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                     Berhenti</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Durasi</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Keterangan</th>
                                                
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
                                                            <td class="ps-4">
                                                                <strong class="text-dark">
                                                                {{ $data->tindakan->tindakan ?? 'Tidak Ada Data' }} </strong>
                                                            </td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tugas Penunjang --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Tugas Penunjang</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="row mb-0 pb-0">

                                    <div class="col-auto mb-0 pb-0 ms-auto d-flex  button-datatable2"></div>
                                </div>
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tindakan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tanggal</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                     Satuan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Kategori</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Waktu</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Keterangan</th>
                                                
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
                                                            <td class="ps-4">
                                                                <strong class="text-dark">
                                                                {{ $tindakan->tindakan->tindakan ?? 'Tidak Ada Data' }} </strong>
                                                            </td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Tugas Tambahan --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Tugas Tambahan</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="row mb-0 pb-0">

                                    <div class="col-auto mb-0 pb-0 ms-auto d-flex  button-datatable2"></div>
                                </div>
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tindakan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tanggal</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Waktu</th>
                                                
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
                                                            <td class="ps-4">
                                                                <strong class="text-dark">
                                                                {{ $tindakan->tindakan->tindakan ?? 'Tidak Ada Data' }} </strong>
                                                            </td>
                                                            <td>{{ $tindakan->tanggal ?? '-' }}</td>
                                                            <td>{{ $tindakan->durasi ?? '-' }} Jam</td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{--  Ringkasan --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Ringkasan</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="row mb-0 pb-0">

                                    <div class="col-auto mb-0 pb-0 ms-auto d-flex  button-datatable2"></div>
                                </div>
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tindakan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Frekuensi</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                     SWL (Jam)</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                     Hasil (Jam)</th>
                                                
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
                                                    {{-- tindakan --}}
                                                    <td class="ps-4">
                                                        <strong class="text-dark">
                                                        {{ $tindakan->tindakan ?? 'Tidak Ada Data' }} </strong>
                                                    </td>

                                                    {{-- frekuensi --}}
                                                    <td class="text-center">
                                                        <strong>{{ $tindakan->laporanTindakan->count() }}</strong>
                                                    </td>

                                                    {{-- swl --}}
                                                    <td class="text-center">
                                                        @if ($tindakan->laporanTindakan->count() > 0)
                                                            <strong>{{ number_format(number_format($totalJamTindakan, 3)/$tindakan->laporanTindakan->count(), 3) }}</strong>
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
                                                            $hasilAngka = $totalJamTindakan * $tindakan->laporanTindakan->count();
                                                            $totalHasilPerTindakan = number_format($hasilAngka, 3)

                                                        @endphp
                                                        <strong class="text-danger">
                                                        {{ $totalHasilPerTindakan }} </strong>
                                                        @php
                                                            $totalHasil += $hasilAngka;
                                                        @endphp
                                                    </td>
                                                    @php
                                                        $grouped = [];
                                                    @endphp
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Analisa Data  --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Analisa Data</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="row mb-0 pb-0 justify-content-center align-items-center">
                                    <div class="col-12">


                                    <form id="dataRumahSakitForm" action="{{ route('admin.data-rumah-sakit.update') }}" method="POST" class="mx-auto d-block">
                                        @csrf
                                        <div class="input-group my-3 mt-2 mx-auto row justify-content-center mx-auto">
                                            @php
                                                $totalHasilString = number_format($totalHasil, 3)
                                            @endphp
                                            <label for="libur_nasional" class="col-sm-3 col-form-label text-md-end text-center text-dark"><strong>Total Waktu Kerja</strong></label>
                                            <div class="col-sm-5">
                                            <input required type="text" class="form-control px-4 font-weight-bolder text-lg" id="total_waktu_kerja" name="total_waktu_kerja" value="{{ $totalHasilString }}" readonly>
                                            </div>
                                        </div>
                                    </form>
                                    </div>

                                </div>
                                {{-- Beban Kerja --}}
                                <div class="row justify-content-center mt-1 px-4">
                                    <p class="mt-2 text-danger font-weight-bolder text-center">Pilih tanggal untuk analisa data</p>
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
                                <div class="form-group row my-3 mt-5 mx-auto">
                                    <div class="col-auto mx-auto">
                                        <button type="button" id="analisaDataButton" class="btn btn-danger font-weight-bolder text-lg"><strong>ANALISA DATA</strong></button>
                                    </div>
                                </div>
                                <div class="input-group row my-3 mt-5 justify-content-center mx-auto">
                                    <label for="libur_nasional" class="col-md-3 col-12 col-form-label text-md-end text-center text-dark"><strong> Beban Kerja</strong></label>
                                    <div class="col-md-5 col-12">
                                    <input required type="text" class="form-control px-4 font-weight-bolder text-lg text-dark" id="beban_kerja" name="beban_kerja" readonly style="font-size: 2rem;">
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>

                @else
                    <strong class="text-center mt-4 text-danger mx-auto d-block">Silakan pilih perawat dari dropdown di atas untuk melihat laporan.</strong>
                @endif


                <x-footers.auth></x-footers.auth>
            </div>
        </main>

        @push('js')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const table = $('#author_table').DataTable({
                    dom: 'frtip', // 'B' untuk Buttons
                    buttons: [
                        {
                            extend: 'excel',
                            className: 'btn btn-outline-success border rounded d-flex align-items-center',
                            text: '<i class="material-icons">grid_on</i> Excel'
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-outline-danger border rounded d-flex align-items-center',
                            text: '<i class="material-icons">picture_as_pdf</i> PDF'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-outline-dark border rounded d-flex align-items-center',
                            text: '<i class="material-icons">print</i> Print'
                        }
                    ],
                    pagingType: "simple_numbers", // atau "simple_numbers"
                    language: {
                        search: "",
                        searchPlaceholder: "Cari...",
                        lengthMenu: "_MENU_ data setiap halaman",
                        info: "Menampilkan <strong>_START_</strong> sampai <strong>_END_</strong> , total <strong>_TOTAL_</strong> data",
                    },
                    columnDefs: [
                        { targets: 0, orderable: false }  // Kolom pertama tidak bisa diurutkan
                    ],
                    rowCallback: function(row, data, index) {
                        if ($(row).hasClass('no-sort')) {
                        $(row).removeClass('odd even'); // hilangkan styling zebra
                        }
                    },
                    drawCallback: function(settings) {
                        // Pindahkan ulang row "no-sort" ke bawah setiap kali redraw
                        let table = this.api();
                        let noSortRow = table.rows('.no-sort').nodes();
                        if (noSortRow.length) {
                        $(noSortRow).appendTo($(table.table().body()));
                        }
                    }
                });

                table.buttons().container().appendTo('.button-datatable');

                const search = $('#author_table_wrapper .dt-search');
                search.appendTo('.button-datatable');

                const table2 = $('#author_table2').DataTable({
                    dom: 'frtip', // 'B' untuk Buttons
                    pagingType: "simple_numbers", // atau "simple_numbers"
                    language: {
                        search: "",
                        searchPlaceholder: "Cari...",
                        lengthMenu: "_MENU_ data setiap halaman",
                        info: "Menampilkan <strong>_START_</strong> sampai <strong>_END_</strong> , total <strong>_TOTAL_</strong> data",
                    },
                    rowCallback: function(row, data, index) {
                        if ($(row).hasClass('no-sort')) {
                        $(row).removeClass('odd even'); // hilangkan styling zebra
                        }
                    },
                    drawCallback: function(settings) {
                        // Pindahkan ulang row "no-sort" ke bawah setiap kali redraw
                        let table = this.api();
                        let noSortRow = table.rows('.no-sort').nodes();
                        if (noSortRow.length) {
                        $(noSortRow).appendTo($(table.table().body()));
                        }
                    }
                });

                table2.buttons().container().appendTo('.button-datatable2');

                const search2 = $('#author_table2_wrapper .dt-search');
                search2.appendTo('.button-datatable2');
            });

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
                    const totalWaktuKerja = @json($totalHasil);

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
                            const hasil = new Intl.NumberFormat('id-ID', {
                                minimumFractionDigits: 1,
                                maximumFractionDigits: 3
                            }).format(data.result);
                            bebanKerja.value = `${hasil} ${stringBebanKerja}`;
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
        @endpush
</x-layout>
