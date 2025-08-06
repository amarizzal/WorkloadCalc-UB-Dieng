<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.bottombar activePage="dashboard"></x-navbars.bottombar>
        <style>
            /* Tampilan lebih seperti input Bootstrap */
            .select2-container--default .select2-selection--single {
                border: 1px solid #ced4da;
                font-size: 0.8rem;


            }

            /* Fokus pada dropdown */
            .select2-container--default .select2-selection--single:focus {
                border-color: #80bdff;
                outline: 0;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            /* Styling utama untuk container timer */
            .timer-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 200px;
                width: 200px;
                position: relative;
                margin: 20px auto;
            }

            /* SVG Lingkaran */
            .countdown-circle {
                position: relative;
                width: 100px;
                height: 100px;
            }

            .countdown-circle svg {
                position: absolute;
                top: 0;
                left: 0;
                transform: rotate(-90deg);
                width: 100px;
                height: 100px;
            }

            .countdown-circle circle {
                fill: none;
                stroke-width: 8;
            }

            .background-circle {
                stroke: #f0f0f0;
            }

            .progress-circle {
                stroke: #ed8b00;
                /* Warna biru untuk progress */
                stroke-dasharray: 283;
                stroke-dashoffset: 283;
                transition: stroke-dashoffset 0.2s linear;
            }

            /* Teks Timer */
            #timer-text {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 18px;
                font-weight: bold;
                color: #333;
            }

            /* Tombol di bawah timer */
            /* .mt-4.text-center button {
                width: 100px;
                height: 40px;
                font-size: 16px;
                margin: 5px;
                border-radius: 5px;
                border: 1px solid #007bff;
                background-color: #007bff;
                color: white;
                cursor: pointer;
                transition: background-color 0.3s;
            } */

            .mt-4.text-center button:disabled {
                background-color: #cccccc;
                cursor: not-allowed;
            }

            .mt-4.text-center button:hover:not(:disabled) {
                background-color: #ed8b00;
            }

            /* Penataan tombol jika menggunakan Flexbox */
            .mt-4.text-center {
                display: flex;
                justify-content: center;
                gap: 15px;
            }

            #timerDetails {
                display: none;
                /* Tetap disembunyikan secara default */
                margin-top: 20px;
                padding: 15px;
                background-color: #f9f9f9;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                width: 300px;
                max-width: 90%;
                /* Pastikan tetap proporsional di layar kecil */
                margin-left: auto;
                margin-right: auto;
                overflow-y: auto;
                /* Tambahkan scrolling jika konten melebihi ukuran */
                max-height: calc(100vh - 80px);
                /* Pastikan tidak melebihi tinggi layar */
                z-index: 100;
                /* Untuk menjaga layer di atas elemen lain */
                position: relative;
                /* Agar tetap mengikuti konteks */
            }

            /* Styling untuk paragraf dalam timerDetails */
            #timerDetails p {
                font-size: 16px;
                color: #333;
                margin: 10px 0;
                word-wrap: break-word;
                /* Untuk mencegah teks panjang keluar area */
            }

            #timerDetails .time-label {
                font-weight: bold;
            }

            /* Style untuk teks hasil */
            #stopTime,
            #duration {
                font-size: 18px;
                color: #ed8b00;
                font-weight: bold;
                text-align: center;
            }
        </style>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.perawat titlePage="Penunjang"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Profil</h5>
                                </div>
                            </div>
                            <div class="card-body px-3 pb-2">
                                <section class="container my-1">
                                    <div class="row gx-4 mb-2">
                                        <div class="col-auto">
                                            <div class="avatar avatar-xl position-relative">
                                                <img src="{{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : asset('assets/img/team-2.jpg') }}" alt="profile_image"
                                                    class="w-100 border-radius-lg shadow-sm">
                                            </div>
                                        </div>
                                        <div class="col-auto my-auto">
                                            <div class="h-100">
                                                <h5 class="mb-1">
                                                    {{ auth()->user()->nama_lengkap }}
                                                </h5>
                                                <p class="mb-0 font-weight-normal text-sm">
                                                    {{ auth()->user()->role }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-12 col-xl-4">
                                                <div class="card card-plain h-100">
                                                    <div class="card-header pb-0 p-3">
                                                        <div class="row">
                                                            <div class="col-md-8 d-flex align-items-center">
                                                                <h6 class="mb-0">Profile Information</h6>
                                                            </div>
                                                            <div class="col-md-4 text-end">
                                                                <a href="{{ route('perawat.profil.edit')}}">
                                                                    <i class="material-icons text-secondary text-sm"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Edit Profile">edit</i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body p-3">
                                                        <hr class="horizontal gray-light my-1">
                                                        <ul class="list-group">
                                                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                                    class="text-dark">Nama Lengkap:</strong> &nbsp; {{ auth()->user()->nama_lengkap ?? '-' }}</li>
                                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                                    class="text-dark">Nomor:</strong> &nbsp; {{ auth()->user()->nomor_telepon ?? '-' }}</li>
                                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                                    class="text-dark">Email:</strong> &nbsp; {{ auth()->user()->email ?? '-' }}</li>
                                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                                    class="text-dark">Pendidikan:</strong> &nbsp; {{ auth()->user()->pendidikan ?? '-'}}</li>
                                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                                    class="text-dark">Tanggal Lahir:</strong> &nbsp; {{ auth()->user()->tanggal_lahir ?? '-' }}</li>
                                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                                    class="text-dark">Ruangan:</strong> &nbsp; {{ auth()->user()->ruangan->nama_ruangan ?? '-' }}</li>
                                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                                    class="text-dark">Usia:</strong> &nbsp; {{ \Carbon\Carbon::parse(auth()->user()->tanggal_lahir)->age ?? '-' }} tahun</li>
                                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                                    class="text-dark">Lama Bekerja:</strong> &nbsp; {{ auth()->user()->lama_bekerja ?? '-' }} tahun</li>
                                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                                    class="text-dark">Posisi:</strong> &nbsp; 
                                                                    @if (auth()->user()->posisi == "perawat_pelaksana")
                                                                        Perawat Pelaksana
                                                                    @elseif (auth()->user()->posisi == "ketua_tim")
                                                                        Ketua Tim
                                                                    @elseif (auth()->user()->posisi == "kepala_ruangan")
                                                                        Kepala Ruangan
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </li>
                                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                                    class="text-dark">Pendidikan:</strong> &nbsp; 
                                                                    @if (auth()->user()->pendidikan == "diploma")
                                                                        D III/IV
                                                                    @elseif (auth()->user()->pendidikan == "sarjana")
                                                                        S1/Ners
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </li>
                                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                                    class="text-dark">Level:</strong> &nbsp; 
                                                                    @if (auth()->user()->level == "pk1")
                                                                        PK I
                                                                    @elseif (auth()->user()->level == "pk2")
                                                                        PK II
                                                                    @elseif (auth()->user()->level == "pk3")
                                                                        PK III
                                                                    @elseif (auth()->user()->level == "pk4")
                                                                        PK IV
                                                                    @elseif (auth()->user()->level == "pk5")
                                                                        PK V
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </li>
                                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                                    class="text-dark">Status:</strong> &nbsp; {{ auth()->user()->status ?? '-' }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
        </main>

        @push('js')
        <script>
            $(document).ready(function() {
                // Inisialisasi Select2 dengan fitur tagging (bisa input manual)
                $('.select2-tindakan').select2({
                    tags: true,
                    placeholder: "Pilih atau Tambah Tindakan",
                    allowClear: true
                });

                // Event handler untuk menampilkan form sesuai pilihan dropdown utama
                $('#jenis_tindakan').change(function () {
                    let tindakanLain = $('#form_tindakan_lain');
                    let tindakanTambahan = $('#form_tindakan_tambahan');

                    tindakanLain.addClass('d-none');
                    tindakanTambahan.addClass('d-none');

                    if ($(this).val() === 'tindakan_lain') {
                        tindakanLain.removeClass('d-none');
                    } else if ($(this).val() === 'tindakan_tambahan') {
                        tindakanTambahan.removeClass('d-none');
                    }
                });

                // Fungsi untuk mengisi satuan dan kategori berdasarkan tindakan yang dipilih
                window.selectTindakan = function(value) {
                    // Ambil data tindakan yang dipilih
                    let selectedOption = $('#select_jenis_tindakan option[value="' + value + '"]');
                    if (selectedOption.length) {
                        let satuan = selectedOption.data('satuan');
                        let kategori = selectedOption.data('kategori');
                        console.log(satuan);
                        console.log(kategori);

                        // Set nilai satuan dan kategori pada form
                        if (satuan ) {
                            $('#satuan').val(satuan).trigger('change');
                            $('#satuan').prop('disabled', true);
                        } else {
                            $('#satuan').prop('enabled', true);

                        }
                        if (kategori) {
                            $('#kategori').val(kategori).trigger('change');
                            $('#kategori').prop('disabled', true);
                        }
                        // set agar disabled
                    } else {
                        // Jika tidak ada data, kosongkan input
                        $('#satuan').val('').trigger('change');
                        $('#kategori').val('').trigger('change');
                        // set agar disabled
                        $('#satuan').prop('enabled', false);
                        $('#kategori').prop('enabled', false);
                    }
                };
            });
        </script>
        @endpush
</x-layout>
