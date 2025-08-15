<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="master-shift"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.master titlePage="Shift Kerja"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Shift Kerja table</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div id="button-add" class=" me-3 my-2 text-end">
                                    <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#modal-form"><i
                                            class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah</button>
                                </div>
                                <div class="table-responsive p-0">
                                    <table id="author_table" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Shift</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Waktu</th>
                                                <th class="text-secondary opacity-7">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($shiftKerja as $shift)
                                            <tr>
                                                <td>
                                                    <div class="d-flex ps-4">
                                                        {{-- <div>
                                                            <img src="{{ asset('assets') }}/img/team-2.jpg"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div> --}}
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-md">{{ $shift->nama_shift }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-md font-weight-bold mb-0">{{ $shift->jam_mulai }} - {{ $shift->jam_selesai }}</p>
                                                </td>
                                                <td class="align-middle">
                                                    <form action="{{ route('admin.master.shiftkerja.delete', $shift->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
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
                <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Tambah Shift</h5>
                                <p class="mb-0">Masukkan informasi shift baru</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.master.shiftkerja.store') }}" method="POST" >
                                    @csrf

                                    <div class="mb-3 input-group input-group-static">
                                        <label for="nama_shift">Nama Shift</label>
                                        <input type="text" class="form-control" name="nama_shift" required>
                                    </div>

                                    <div class="mb-3 input-group input-group-static">
                                        <label for="waktu_mulai">Waktu Mulai</label>
                                        <input type="time" class="form-control" name="jam_mulai" required>
                                    </div>

                                    <div class="mb-3 input-group input-group-static">
                                        <label for="waktu_selesai">Waktu Selesai</label>
                                        <input type="time" class="form-control" name="jam_selesai" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @push('js')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                $('#author_table').DataTable({
                    dom: 'frtip', // 'B' untuk Buttons
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
