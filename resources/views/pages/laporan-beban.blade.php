<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="laporan-beban"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Beban Kerja"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Filter Tanggal</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2 mx-4">
                                {{-- <form method="GET" action="{{ route('admin.laporan.index6') }}" class="mb-4">
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
                                </form> --}}
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
                                {{-- <div class="input-group row my-3 mt-5 justify-content-center mx-auto">
                                    <label for="libur_nasional" class="col-md-3 col-12 col-form-label text-md-end text-center text-dark"><strong> Beban Kerja</strong></label>
                                    <div class="col-md-5 col-12">
                                    <input required type="text" class="form-control px-4 font-weight-bolder text-lg text-dark" id="beban_kerja" name="beban_kerja" readonly style="font-size: 2rem;">
                                    </div>
                                 </div> --}}
                            </div>
                        </div>
                    </div>

                    {{-- result --}}
                    <div class="col-12" id="tableContainer">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Laporan Beban Kerja</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2 mx-4">
                                {{-- Beban Kerja --}}
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-between mb-3">
                                        <form action="{{ route('admin.laporan.index') }}" method="GET" class="row align-items-end justify-content-center w-100">
                                            <div class="col-12 col-md-4 ps-5">
                                                <div class="d-flex align-items-end justify-content-center gap-5">
                                                    {{-- <div class="col input-group input-group-static mr-2">
                                                        <label for="start_date" class="me-2">Dari:</label>
                                                        <input type="date" name="start_date" id="start_date" class="form-control me-2" value="">

                                                    </div>
                                                    <div class="col  input-group input-group-static mr-2 align-items-center">
                                                        <label for="end_date" class="me-2">Sampai:</label>
                                                        <input type="date" name="end_date" id="end_date" class="form-control me-2" value="">

                                                    </div> --}}
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
                                                    No</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Nama Perawat</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    IAF</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    AF</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Total Waktu Kerja</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Hasil Beban Kerja</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="tableContent">
                                            
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
                // const table = $('#author_table').DataTable({
                //     dom: 'frtip', // 'B' untuk Buttons
                //     buttons: [
                //         {
                //             extend: 'excel',
                //             className: 'btn btn-outline-success border rounded d-flex align-items-center',
                //             text: '<i class="material-icons">grid_on</i> Excel'
                //         },
                //         {
                //             extend: 'pdf',
                //             className: 'btn btn-outline-danger border rounded d-flex align-items-center',
                //             text: '<i class="material-icons">picture_as_pdf</i> PDF'
                //         },
                //         {
                //             extend: 'print',
                //             className: 'btn btn-outline-dark border rounded d-flex align-items-center',
                //             text: '<i class="material-icons">print</i> Print'
                //         }
                //     ],
                //     pagingType: "simple_numbers", // atau "simple_numbers"
                //     language: {
                //         search: "",
                //         searchPlaceholder: "Cari...",
                //         lengthMenu: "_MENU_ data setiap halaman",
                //         info: "Menampilkan <strong>_START_</strong> sampai <strong>_END_</strong> , total <strong>_TOTAL_</strong> data",
                //     },
                //     columnDefs: [
                //         { targets: 0, orderable: false }  // Kolom pertama tidak bisa diurutkan
                //     ],
                //     rowCallback: function(row, data, index) {
                //         if ($(row).hasClass('no-sort')) {
                //         $(row).removeClass('odd even'); // hilangkan styling zebra
                //         }
                //     },
                //     drawCallback: function(settings) {
                //         // Pindahkan ulang row "no-sort" ke bawah setiap kali redraw
                //         let table = this.api();
                //         let noSortRow = table.rows('.no-sort').nodes();
                //         if (noSortRow.length) {
                //         $(noSortRow).appendTo($(table.table().body()));
                //         }
                //     }
                // });

                // table.buttons().container().appendTo('.button-datatable');

                const search = $('#author_table_wrapper .dt-search');
                search.appendTo('.button-datatable');

                

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

                const tableContainer = document.getElementById('tableContainer');
                const tableContent = document.getElementById('tableContent');

                tableContainer.style.display = 'none';

                let userId = '';


                buttonDataAnalisa.addEventListener('click', function() {

                    const tanggalAwal = document.getElementById('tanggal_awal').value;
                    const tanggalAkhir = document.getElementById('tanggal_akhir').value;
                    // const totalWaktuKerja = 0;

                    // const userId = document.getElementById('user_id').value;

                    if(tanggalAwal === '' || tanggalAkhir === '' ) {
                        alert('Mohon lengkapi tanggal sebelum melakukan analisa data.');
                        return;
                    }

                    // Fetch detail data via AJAX
                    fetch(`/admin/laporan/analisa-data-semua?tanggalAwal=${tanggalAwal}&tanggalAkhir=${tanggalAkhir}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log('Data received from server:', data); // Tampilkan data di console

                            tableContent.innerHTML = ''; // Clear previous data
                            if (data.data.length > 0) {
                                data.data.forEach((item, index) => {
                                    // Update Beban Kerja
                                    let stringBebanKerja = '';
                                    let classBebanKerja = '';
                                    if (item.result < 1.0) {
                                        console.log("tes")
                                        classBebanKerja = 'font-weight-bolder text-warning';
                                        stringBebanKerja = '(Rendah)';
                                    } else if (item.result >= 1.0 && item.result <= 1.1) {
                                        classBebanKerja = 'font-weight-bolder text-success';
                                        stringBebanKerja = '(Normal)';
                                    } else {
                                        classBebanKerja = 'font-weight-bolder text-danger';
                                        stringBebanKerja = '(Tinggi)';
                                    }
                                    const hasil = new Intl.NumberFormat('id-ID', {
                                        minimumFractionDigits: 1,
                                        maximumFractionDigits: 3
                                    }).format(item.result);
                                    const row = `
                                <tr>
                                    <td class="text-center pb-auto text-sm">${index + 1}</td>
                                    <td class="align-middle text-md"><strong class="text-success">${item.user.nama_lengkap}</strong></td>
                                    <td class="text-center limitid-height text-md"><strong class="text-dark">${item.IAF}</strong></td>
                                    <td class="align-middle text-center text-md"><p class="my-0">${item.AF}</p></td>
                                    <td class="align-middle text-center text-md"><p class="my-0">${item.total_waktu_kerja}</p></td>
                                    <td class="${classBebanKerja} align-middle text-center text-sm">${hasil} - ${stringBebanKerja}</td>
                                </tr>
                            `;
                                    tableContent.innerHTML += row;
                                });
                            }
                            tableContainer.style.display = 'block';
                            const table2 = $('#author_table').DataTable({
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
                            table2.buttons().container().appendTo('.button-datatable');
                        })
                        .catch(error => {
                            console.error('Error fetching detail data:', error);
                        });
                });
                });
        </script>
        @endpush
</x-layout>
