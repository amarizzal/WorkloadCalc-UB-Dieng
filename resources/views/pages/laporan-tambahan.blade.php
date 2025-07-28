<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="laporan-tambahan"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Tugas Tambahan"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Laporan Tugas Tambahan</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                {{-- filter tanggal --}}
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-between mb-3">
                                        <form action="{{ route('admin.laporan.index5') }}" method="GET" class="row align-items-end justify-content-center w-100">
                                            <div class="col-12 col-md-6 ps-5">
                                                <div class="d-flex align-items-end justify-content-center gap-5">
                                                    <div class="col mr-2">
                                                        <label for="start_date" class="me-2">Dari:</label>
                                                        <input type="date" name="start_date" id="start_date" class="form-control me-2" value="">

                                                    </div>
                                                    <div class="col input-group-outline mr-2 align-items-center">
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
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Tindakan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nama Perawat</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Waktu (jam)</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tindakanTambahan as $tindakan)
                                            <tr>
                                                <td class="align-middle text-md ps-4">
                                                    <strong class="text-dark">{{ $tindakan->tindakan->tindakan ?? 'Tidak Ada Data' }}</strong>
                                                </td>
                                                <td class="text-center limitid-height text-md">
                                                    <p class="text-md">{{ $tindakan->user->nama_lengkap ?? '-' }}</p>
                                                </td>
                                                <td class="align-middle text-center text-md">
                                                    <p class="">{{ $tindakan->durasi ?? '-' }}</p>
                                                </td>
                                                
                                            </tr>
                                            @endforeach
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
                                    <h5 class="text-white text-capitalize ps-3">Ringkasan</h5>
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
                                                    Nama Perawat</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Total IAS (Jam)</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    IAF (Jam)</th>
                                                
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
                                                <td class="align-middle text-md ps-5">
                                                    <strong class="text-dark">{{ $namaPerawat }}</strong>
                                                </td>
                                                <td class="text-center pb-auto text-sm">
                                                    <strong class="text-success">{{ $totalPerawat[$namaPerawat] ?? 0 }}</strong>
                                                </td>
                                                <td class="align-middle text-center text-md text-danger">
                                                    <strong class="">{{ $totalPerawat[$namaPerawat] / $hospitalTime }}</strong>
                                                </td>
                                            </tr>
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
