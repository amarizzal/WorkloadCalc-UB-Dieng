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
                                    <h5 class="text-white text-capitalize ps-3">Edit Profil</h5>
                                </div>
                            </div>
                            <div class="card-body px-3 pb-2">
                                <section class="container my-1">
                                    <div class="row gx-4 mb-4">
                                        <div class="col-auto">
                                            <div class="avatar avatar-xl position-relative">
                                                <img src="
                                                {{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : asset('assets/img/team-2.jpg') }}
                                                " alt="profile_image"
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
                                    <form action="{{ route('perawat.profil.edit.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="waktu" value="0">
                                        <input type="hidden" name="status" value="Tugas Penunjang">

                                        <div class="mb-3 input-group input-group-static">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_lengkap" value="{{ auth()->user()->nama_lengkap }}" required>
                                        </div>
                                        <div class="mb-3 input-group input-group-static">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                                        </div>
                                        <div class="mb-3 input-group input-group-static">
                                            <label for="nomor_telepon">Nomor Telepon</label>
                                            <input type="text" class="form-control" name="nomor_telepon" value="{{ auth()->user()->nomor_telepon }}" required>
                                        </div>
                                        <div class="mb-3 input-group input-group-static">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ auth()->user()->tanggal_lahir }}" required>
                                        </div>
                                        <div class="mb-3 input-group input-group-static">
                                            <label for="lama_bekerja" >Lama Bekerja</label>
                                            <input type="number" class="form-control" name="lama_bekerja" value="{{ auth()->user()->lama_bekerja }}" required>
                                        </div>
                                        <div class="mb-3 input-group input-group-static">
                                            <label for="posisi" >Posisi</label>
                                            <select name="posisi" id="posisi" class="form-control" required>
                                                <option value="" disabled selected>Pilih Posisi</option>
                                                <option value="perawat_pelaksana" @if (auth()->user()->posisi == 'perawat_pelaksana') selected @endif>Perawat Pelaksana</option>
                                                <option value="ketua_tim" @if (auth()->user()->posisi == 'ketua_tim') selected @endif>Ketua Tim</option>
                                                <option value="kepala_ruangan" @if (auth()->user()->posisi == 'kepala_ruangan') selected @endif>Kepala Ruangan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 input-group input-group-static">
                                            <label for="pendidikan" >Pendidikan</label>
                                            <select name="pendidikan" id="pendidikan" class="form-control" required>
                                                <option value="" disabled selected>Pilih Pendidikan</option>
                                                <option value="diploma" @if (auth()->user()->pendidikan == 'diploma') selected @endif>D III/IV</option>
                                                <option value="sarjana" @if (auth()->user()->pendidikan == 'sarjana') selected @endif>S1/Ners</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 input-group input-group-static">
                                            <label for="level" >Level</label>
                                            <select name="level" id="level" class="form-control" required>
                                                <option value="" disabled selected>Pilih Level</option>
                                                <option value="pk1" @if (auth()->user()->level == 'pk1') selected @endif>PK I</option>
                                                <option value="pk2" @if (auth()->user()->level == 'pk2') selected @endif>PK II</option>
                                                <option value="pk3" @if (auth()->user()->level == 'pk3') selected @endif>PK III</option>
                                                <option value="pk4" @if (auth()->user()->level == 'pk4') selected @endif>PK IV</option>
                                                <option value="pk5" @if (auth()->user()->level == 'pk5') selected @endif>PK V</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 input-group input-group-static">
                                            <label for="status" >Status Kepegawaian</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="" disabled selected>Pilih Status</option>
                                                <option value="asn" @if (auth()->user()->status == 'asn') selected @endif>ASN</option>
                                                <option value="pppk" @if (auth()->user()->status == 'pppk') selected @endif>PPPK</option>
                                                <option value="non_asn" @if (auth()->user()->status == 'non_asn') selected @endif>Non ASN</option>
                                            </select>
                                        </div>
                                        <label for="foto" >Foto (Biarkan kosong jika tidak ingin diganti)</label>
                                        <div class="mb-3 input-group input-group-outline">
                                            <input type="file" name="foto" id="foto" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                    </form>
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
