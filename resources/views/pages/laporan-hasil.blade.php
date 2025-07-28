<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="laporan-hasil"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Hasil"></x-navbars.navs.auth>
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
                            <div class="card-body px-0 pb-2">
                                {{-- filter tanggal --}}
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-between mb-3">
                                        <form action="{{ route('admin.laporan.index') }}" method="GET" class="row align-items-end justify-content-center w-100">
                                            <div class="col-12 col-md-4 ps-5">
                                                <div class="d-flex align-items-end justify-content-center gap-5">
                                                    <div class="col mr-2">
                                                        <label for="start_date" class="me-2">Dari:</label>
                                                        <input type="date" name="start_date" id="start_date" class="form-control me-2" value="">

                                                    </div>
                                                    <div class="col input-group-outline mr-2 align-items-center">
                                                        <label for="end_date" class="me-2">Sampai:</label>
                                                        <input type="date" name="end_date" id="end_date" class="form-control me-2" value="">

                                                    </div>
                                                    {{-- <div class="col">

                                                        <button type="submit" class="btn btn-primary ">Filter</button>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-md-8 button-datatable"></div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive p-0">
                                    <table id="author_table" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nama Perawat</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Nama Ruangan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Shift Kerja</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tindakan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tanggal</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Jam Mulai</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Jam Berhenti</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Durasi</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($laporan as $index => $data)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        {{-- <div>
                                                            <img src="{{ asset('img') }}/team-2.jpg"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div> --}}
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-md">{{ $data->user->nama_lengkap ?? '-' }}</h6>
                                                            {{-- <p class="text-xs text-secondary mb-0">john@creative-tim.com
                                                            </p> --}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-md text-info font-weight-bold mb-0 text-center">{{ $data->ruangan->nama_ruangan ?? 'Tidak Ada Data' }}</p>
                                                    {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $data->shift->nama_shift ?? 'Tidak Ada Data' }}</p>
                                                </td>
                                                <td class="align-middle text-center limitid-height">
                                                    <span
                                                        class="text-danger text-sm font-weight-bold">{{ $data->tindakan->tindakan ?? 'Tidak Ada Status' }}</span><br>
                                                    <span
                                                    class="text-secondary text-xs font-weight-bold">({{ $data->tindakan->status ?? 'Tidak Ada Status' }})</span>
                                                </td>
                                                {{-- <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $data->tindakan->status ?? 'Tidak Ada Status' }}</span>
                                                </td> --}}
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-dark font-weight-bold mb-0">{{ $data->tanggal }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($data->jam_mulai)->format('H:i:s') }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($data->jam_berhenti)->format('H:i:s') }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0 text-success">{{ floor($data->durasi / 60) }} menit {{ $data->durasi % 60 }} detik</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $data->keterangan ?? 'Tidak Ada Keterangan' }}</p>
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
                        { targets: 4, orderable: false }  // Kolom pertama tidak bisa diurutkan
                    ]
                });
                table.buttons().container().appendTo('.button-datatable');

                const search = $('.dt-search');
                search.appendTo('.button-datatable');

                // Custom search function for date range
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    var startDate = $('#start_date').val();
                    var endDate = $('#end_date').val();
                    var dateColumnIndex = 4; // Kolom tanggal, ubah jika kolom tanggal tidak ada di indeks 6
        
                    var date = data[dateColumnIndex]; // Ambil nilai tanggal dari kolom
        
                    if (startDate && endDate) {
                        // Jika kedua tanggal mulai dan akhir diisi, filter berdasarkan rentang tanggal
                        return (new Date(date) >= new Date(startDate) && new Date(date) <= new Date(endDate));
                    } else if (startDate) {
                        // Jika hanya tanggal mulai yang diisi
                        return new Date(date) >= new Date(startDate);
                    } else if (endDate) {
                        // Jika hanya tanggal akhir yang diisi
                        return new Date(date) <= new Date(endDate);
                    }
                    return true; // Jika tidak ada filter, tampilkan semua baris
                });

                // Filter by date range
                $('#start_date, #end_date').on('change', function() {
                    table.draw();
                });
            });
        </script>
        @endpush
</x-layout>
