<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="master-user"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.master titlePage="Perawat"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">User table</h5>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div id="button-add" class=" me-3 my-3 text-end">
                                    <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#modal-form"><i
                                            class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                        User</button>
                                </div>
                                <div class="table-responsive p-0">
                                    <table id="author_table" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nama Lengkap</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Role</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Username</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nomor Telepon</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Terdaftar pada</th>
                                                <th class="text-secondary opacity-7">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('assets/img/team-2.jpg') }}"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $user->nama_lengkap }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $user->email }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $user->role }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $user->ruangan->nama_ruangan ?? '-' }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold text-secondary mb-0">{{ $user->username ?? '-' }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $user->nomor_telepon }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</span>
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
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h5 class="">Tambah user</h5>
                            <p class="mb-0">Masukkan informasi user baru</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.master-user-post') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="waktu" value="0">
                                <input type="hidden" name="status" value="Tugas Penunjang">

                                <div class="mb-3 input-group input-group-static">
                                    <label for="role" >Role</label>
                                    <select name="role" id="role" class="form-control" >
                                        <option value="" disabled selected>Pilih Role</option>
                                        <option value="admin" >admin</option>
                                        <option value="perawat" >perawat</option>
                                    </select>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" name="password" required>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama_lengkap" required>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email"  required>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="nomor_telepon"  required>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir"  required>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="lama_bekerja" >Lama Bekerja</label>
                                    <input type="number" class="form-control" name="lama_bekerja"  required>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="jenis_kelamin_id" >Jenis Kelamin</label>
                                    <select name="jenis_kelamin_id" id="jenis_kelamin_id" class="form-control" >
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        @foreach ($jenisKelamin as $jk)
                                            <option value="{{ $jk->id }}">{{ $jk->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="ruangan_id" >Ruangan</label>
                                    <select name="ruangan_id" id="ruangan_id" class="form-control" >
                                        <option value="" disabled selected>Pilih Ruangan</option>
                                        @foreach ($ruangan as $r)
                                            <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="posisi" >Posisi</label>
                                    <select name="posisi" id="posisi" class="form-control" >
                                        <option value="" disabled selected>Pilih Posisi</option>
                                        <option value="perawat_pelaksana">Perawat Pelaksana</option>
                                        <option value="ketua_tim">Ketua Tim</option>
                                        <option value="kepala_ruangan">Kepala Ruangan</option>
                                    </select>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="pendidikan" >Pendidikan</label>
                                    <select name="pendidikan" id="pendidikan" class="form-control" >
                                        <option value="" disabled selected>Pilih Pendidikan</option>
                                        <option value="diploma" >D III/IV</option>
                                        <option value="sarjana" >S1/Ners</option>
                                    </select>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="level" >Level</label>
                                    <select name="level" id="level" class="form-control" >
                                        <option value="" disabled selected>Pilih Level</option>
                                        <option value="pk1" >PK I</option>
                                        <option value="pk2" >PK II</option>
                                        <option value="pk3" >PK III</option>
                                        <option value="pk4" >PK IV</option>
                                        <option value="pk5" >PK V</option>
                                    </select>
                                </div>
                                <div class="mb-3 input-group input-group-static">
                                    <label for="status" >Status Kepegawaian</label>
                                    <select name="status" id="status" class="form-control" >
                                        <option value="" disabled selected>Pilih Status</option>
                                        <option value="asn" >ASN</option>
                                        <option value="pppk" >PPPK</option>
                                        <option value="non_asn" >Non ASN</option>
                                    </select>
                                </div>
                                <label for="foto" >Foto</label>
                                <div class="mb-3 input-group input-group-outline">
                                    <input type="file" name="foto" id="foto" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Tambah banyak user sekaligus?
                            <a href="javascript:;" class="text-info text-gradient font-weight-bold" data-bs-toggle="modal" data-bs-target="#modal-form-multiple">Tambah</a>
                            </p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-form-multiple" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h5 class="">Tambah user</h5>
                            <p class="mb-0">Masukkan informasi user baru</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.master-user-import') }}" method="POST" enctype="multipart/form-data">
                                @csrf


                                <label for="excel" >Data User</label>
                                <div class="mb-3 input-group input-group-outline">
                                    <input type="file" name="excel" id="excel" class="form-control" accept=".xls,.xlsx" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                <a href="{{ route('admin.master-user-template')}}" class="btn btn-outline-success w-100">Contoh file</a>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Tambah satu user?
                            <a href="javascript:;" class="text-info text-gradient font-weight-bold" data-bs-toggle="modal" data-bs-target="#modal-form">Tambah</a>
                            </p>
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
                    dom: 'Bfrtip', // 'B' untuk Buttons
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
                        { targets: 5, orderable: false }  // Kolom pertama tidak bisa diurutkan
                    ]
                });
            });
        </script>
        @endpush
</x-layout>
