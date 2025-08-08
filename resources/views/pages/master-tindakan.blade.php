<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="master-tindakan"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.master titlePage="Tindakan"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Tindakan table</h5>
                                </div>
                                <div class=" me-3 my-3 text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i
                                            class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                        Tindakan</a>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table id="author_table" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tindakan</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Status</th>
                                                <th class="text-secondary opacity-7">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tindakanWaktu as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        {{-- <div>
                                                            <img src="{{ asset('assets') }}/img/team-2.jpg"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div> --}}
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $item->tindakan }}</h6>
                                                            {{-- <p class="text-xs text-secondary mb-0">{{ $user->email }}
                                                            </p> --}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($item->status == 'Tugas Pokok')
                                                        <span class="badge badge-sm bg-gradient-success">Pokok</span>
                                                    @elseif ($item->status == 'Tugas Penunjang')
                                                        <span class="badge badge-sm bg-gradient-info">Penunjang</span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-secondary">Tambahan</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;"
                                                        class="text-warning font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Ubah
                                                    </a>
                                                    <a href="javascript:;"
                                                        class="ms-4 text-danger font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Hapus
                                                    </a>
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
                $('#author_table').DataTable({
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
                        { targets: 2, orderable: false }  // Kolom pertama tidak bisa diurutkan
                    ]
                });
            });
        </script>
        @endpush
</x-layout>
