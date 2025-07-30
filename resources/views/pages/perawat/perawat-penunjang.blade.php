<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.bottombar activePage="penunjang"></x-navbars.bottombar>
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
                                    <h5 class="text-white text-capitalize ps-3">Tugas Penunjang</h5>
                                </div>
                            </div>
                            <div class="card-body px-3 pb-2">
                                <section class="container my-1">
                                    <h5 class="card-title text-center mb-3">Tambah Jenis Tindakan Penunjang</h5>
                                        <form action="{{ route('perawat.tindakan.store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3 input-group input-group-static">
                                                <label for="select_jenis_tindakan" class="form-label">Jenis Tindakan</label>
                                                <select onchange="selectTindakan(this.value)" class="form-select select2-tindakan" id="select_jenis_tindakan" name="jenis_tindakan" required>
                                                    <option value="" disabled selected>Pilih atau Tambah Tindakan</option>
                                                    @foreach($jenisTindakan as $tindakan)
                                                        <option value="{{ $tindakan->tindakan }}" data-satuan="{{ $tindakan->satuan ? $tindakan->satuan : '' }}" data-kategori="{{ $tindakan->kategori ? $tindakan->kategori : '' }}">{{ $tindakan->tindakan }} - {{ $tindakan->satuan ? $tindakan->satuan : '(belum ada satuan)' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <input type="hidden" name="waktu" value="0">
                                            <input type="hidden" name="status" value="Tugas Penunjang">

                                            <div class="mb-3 input-group input-group-static">
                                                <label for="tanggal">Tanggal</label>
                                                <input type="date" class="form-control" name="tanggal" required>
                                            </div>
                                            <div class="mb-3 input-group input-group-static">
                                                <label for="jam_mulai" >Waktu</label>
                                                <input type="number" class="form-control" name="waktu" placeholder="" required>
                                            </div>
                                            <div class="mb-3 input-group input-group-static">
                                                <label for="satuan" class="ms-0">Satuan</label>
                                                <select name="satuan" id="satuan" class="form-control" required>
                                                    <option value="" disabled selected>Pilih Satuan</option>
                                                    <option value="menit">Menit</option>
                                                    <option value="jam">Jam</option>
                                                    <option value="hari">Hari</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 input-group input-group-static">
                                                <label for="kategori" >Kategori</label>
                                                <select name="kategori" id="kategori" class="form-control" required>
                                                    <option value="" disabled selected>Pilih Kategori</option>
                                                    <option value="harian">Harian</option>
                                                    <option value="mingguan">Mingguan</option>
                                                    <option value="bulanan">Bulanan</option>
                                                    <option value="tahunan">Tahunan</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 input-group input-group-static">
                                                <label for="keterangan" >Keterangan</label>
                                                <textarea class="form-control" name="keterangan" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Simpan Tindakan</button>
                                        </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
                <br><br><br>
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
