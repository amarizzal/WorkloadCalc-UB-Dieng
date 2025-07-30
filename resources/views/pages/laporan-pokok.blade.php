<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="laporan-pokok"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Tugas Pokok"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Laporan Tugas Pokok</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                {{-- filter tanggal --}}
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-between mb-3">
                                        <form action="{{ route('admin.laporan.index2') }}" method="GET" class="row align-items-end justify-content-center w-100">
                                            <div class="col-12 col-md-6 ps-5">
                                                <div class="d-flex align-items-end justify-content-center gap-5">
                                                    <div class="col input-group input-group-static mr-2">
                                                        <label for="start_date" class="me-2">Dari:</label>
                                                        <input type="date" name="start_date" id="start_date" class="form-control me-2" value="">

                                                    </div>
                                                    <div class="col input-group input-group-static mr-2 align-items-center">
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
                                                    Action</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Tindakan</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Frekuensi</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Waktu (Jam)</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    SWL</th>
                                                
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
                                                <td class="text-center pb-auto text-sm">
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $tindakan->id }}" aria-expanded="false"
                                                        data-bs-toggle="collapse"
                                                        aria-controls="collapse{{ $tindakan->id }}">
                                                            <i class="material-icons" style="font-size: 2rem">arrow_drop_down</i>
                                                    </button>
                                                </td>
                                                <td class="align-middle text-center text-md">
                                                    <strong class="text-dark">{{ $tindakan->tindakan ?? 'Tidak Ada Data' }}</strong>

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
                                                <td class="text-center limitid-height text-md">
                                                    <strong class="text-info text-md">{{ $tindakan->laporanTindakan->count() }}</strong>
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
                                                <td class="align-middle text-center text-md">
                                                    @if ($tindakan->laporanTindakan->count() > 0)
                                                        <strong class="text-info">{{ number_format($totalJamTindakan, 3) }}</strong>
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

                                                                <p class="text-center my-2">{{ number_format($totalJam, 3) }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center text-sm text-danger">
                                                    @if ($tindakan->laporanTindakan->count() > 0)
                                                        <strong>{{ number_format(number_format($totalJamTindakan, 3)/$tindakan->laporanTindakan->count(), 3) }}</strong>
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
                    ]
                });

                table.buttons().container().appendTo('.button-datatable');

                const search = $('.dt-search');
                search.appendTo('.button-datatable');
            });
        </script>
        @endpush
</x-layout>
