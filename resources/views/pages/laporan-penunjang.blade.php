<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="laporan-penunjang"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Tugas Penunjang"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Laporan Tugas Penunjang</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                {{-- filter tanggal --}}
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-between mb-3">
                                        <form action="{{ route('admin.laporan.index3') }}" method="GET" class="row align-items-end justify-content-center w-100">
                                            <div class="col-12 col-md-6 ps-5">
                                                <div class="d-flex align-items-end justify-content-center gap-5">
                                                    <div class="col input-group input-group-static mr-2">
                                                        <label for="start_date" class="me-2">Dari:</label>
                                                        <input type="date" name="start_date" id="start_date" class="form-control me-2" value="">

                                                    </div>
                                                    <div class="col  input-group input-group-static mr-2 align-items-center">
                                                        <label for="end_date" class="me-2">Sampai:</label>
                                                        <input type="date" name="end_date" id="end_date" class="form-control me-2" value="">

                                                    </div>
                                                    <div class="col">

                                                        <button type="submit" class="btn btn-primary ">Filter</button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-md-6 button-datatable"></div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive p-0">
                                    <table id="author_table" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Total</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Tindakan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Satuan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Kategori</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Waktu Kegiatan (jam)</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Faktor (%)</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalFaktor = 0;
                                            @endphp
                                            @foreach($tindakanPenunjang as $tindakan)
                                            <tr>
                                                <td class="text-center pb-auto text-sm">
                                                    <strong class="text-success">{{ $totalTindakan[$tindakan->id] ?? 0 }}</strong>
                                                </td>
                                                <td class="align-middle text-md">
                                                    <strong class="text-dark">{{ $tindakan->tindakan ?? 'Tidak Ada Data' }}</strong>
                                                </td>
                                                <td class="text-center limitid-height text-md">
                                                    <p class="text-md">{{ $tindakan->satuan ?? '-' }}</p>
                                                </td>
                                                <td class="align-middle text-center text-md">
                                                    <p class="">{{ $tindakan->kategori ?? '-' }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @php
                                                        // Menghitung waktu kegiatan dalam jam
                                                        if ($tindakan->satuan == 'jam') {
                                                            $waktuJam = $tindakan->waktu; 
                                                        } elseif ($tindakan->satuan == 'menit') {
                                                            $waktuJam = number_format($tindakan->waktu / 60, 2); 
                                                        } elseif ($tindakan->satuan == 'hari') {
                                                            $waktuJam = number_format($tindakan->waktu * 24, 2); 
                                                        } else {
                                                            $waktuJam = 0; // Jika satuan tidak dikenali
                                                        }
                                                    @endphp
                                                    <strong>{{ $waktuJam }}</strong>
                                                    
                                                </td>
                                                <td class="align-middle text-center text-sm text-danger">
                                                    @php
                                                        $totalWaktu = 0;
                                                        if($tindakan->satuan == 'jam') {
                                                            $totalWaktu = $tindakan->waktu * 1; 
                                                        } elseif($tindakan->satuan == 'menit') {
                                                            $totalWaktu = $tindakan->waktu / 60; 
                                                        } elseif($tindakan->satuan == 'hari') {
                                                            $totalWaktu = $tindakan->waktu * 24; 
                                                        }
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
                                                    <strong class="text-danger">{{ $faktor }}</strong>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @php
                                                // Menghitung rata-rata faktor
                                                $totalTindakanForFaktor = count($tindakanPenunjang);
                                                $averageFaktor = $totalTindakanForFaktor > 0 ? $totalFaktor / $totalTindakanForFaktor : 0;
                                                $averageFaktor = number_format($averageFaktor, 2);
                                            @endphp
                                            <tr class="no-sort">
                                                <td colspan="5" class="text-end fw-bold text-dark">Rata-rata Faktor (%)</td>
                                                <td class="d-none"></td>
                                                <td class="d-none"></td>
                                                <td class="d-none"></td>
                                                <td class="d-none"></td>
                                                <td class="text-center text-danger text-lg"><strong>{{ $averageFaktor }}</strong></td>
                                                <td class="d-none"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Rata-rata Waktu Per Tindakan</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="row mb-0 pb-0">

                                    <div class="col-auto mb-0 pb-0 ms-auto d-flex  button-datatable2"></div>
                                </div>
                                <div class="table-responsive p-0">
                                    <table id="author_table2" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Tindakan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Total Tindakan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Rata-rata Waktu (Jam)</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Allowance Factor (AF)</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalFaktor = 0;
                                            @endphp
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
                                                    <td class="align-middle text-md ps-5">
                                                        <strong class="text-dark">{{ $tindakan->tindakan ?? 'Tidak Ada Data' }}</strong>
                                                    </td>
                                                    <td class="text-center pb-auto text-sm">
                                                        <strong class="text-success">{{ $totalTindakan[$tindakan->id] ?? 0 }}</strong>
                                                    </td>
                                                    <td class="text-center limitid-height text-md">
                                                        <p class="text-md">{{ number_format($rataWaktu / 60, 2) }} jam</p>
                                                    </td>
                                                    <td class="align-middle text-center text-md text-danger">
                                                        <strong class="">{{ number_format(1 / (1 - ($averageFaktor/100)), 2) }}</strong>
                                                    </td>
                                                </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        </script>
        @endpush
</x-layout>
