<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    @class(['text-20', 'font-size' => '10rem'])
        <x-navbars.sidebar activePage="master-keamanan"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.master titlePage="Keamanan & Privasi"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Panduan Admin</h5>
                                </div>
                            </div>
                            <div class="card-body px-4 pb-2 text-dark text-lg font-weight-bolder">
    
                                <h5>Panduan Admin</h5>
                                <ol>
                                    <li>Buka <a href="https://nursingworkload.click">https://nursingworkload.click</a></li>
                                    <li>Login dan masukkan username dan password <img src="{{ asset('images/panduan-admin') }}/panduan1.png" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-width: 50rem"></li>
                                    <li>
                                    Lengkapi data pada fitur masing-masing
                                    <p class="text-dark text-lg font-weight-bolder">Fitur:</p>
                                    <ol type="A">
                                        <li>
                                        Master<br>
                                        Melakukan pengaturan data sesuai standar rumah sakit masing-masing
                                        <img src="{{ asset('images/panduan-admin') }}/panduan2.png" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-width: 50rem">
                                        <ol>
                                            <li>Perawat: Mengatur daftar pengguna <img src="{{ asset('images/panduan-admin') }}/panduan3.png" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-width: 50rem"></li>
                                            <li>Data Rumah Sakit: Mengelola jam kerja efektif<img src="{{ asset('images/panduan-admin') }}/panduan4.png" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-width: 50rem"></li>
                                            <li>Tindakan: Mengatur daftar tindakan perawat<img src="{{ asset('images/panduan-admin') }}/panduan5.png" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-width: 50rem"></li>
                                            <li>Shift Kerja: Menetapkan jadwal dan durasi kerja setiap shift<img src="{{ asset('images/panduan-admin') }}/panduan6.png" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-width: 50rem"></li>
                                            <li>Ruangan: Menetapkan ruangan di rumah sakit<img src="{{ asset('images/panduan-admin') }}/panduan7.png" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-width: 50rem"></li>
                                        </ol>
                                        </li>
                                        <li>
                                        Laporan<br>
                                        Melihat dan mengunduh laporan setiap tindakan
                                        <img src="{{ asset('images/panduan-admin') }}/panduan8.png" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-width: 50rem">
                                        <ol type="a">
                                            <li>Klik unduh sesuai jenis file yang diinginkan <img src="{{ asset('images/panduan-admin') }}/panduan9.png" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-width: 50rem"></li>
                                            <li>Tentukan tanggal yang diinginkan untuk analisa data beban kerja dan klik “Analisa Data” agar semua perawat dapat melihat Beban Kerja masing-masing <img src="{{ asset('images/panduan-admin') }}/panduan10.png" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-width: 50rem"></li>
                                        </ol>
                                        </li>
                                    </ol>
                                    </li>
                                </ol>
 

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
                // Update the "Waktu Kerja Tersedia" field when the form is submitted
                $('#dataRumahSakitForm').on('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission
                    
                    // Get the values from the input fields
                    var efektifHari = parseInt($('select[name="efektif_hari"]').val());
                    var liburNasional = parseInt($('input[name="libur_nasional"]').val());
                    var cutiTahunan = parseInt($('input[name="cuti_tahunan"]').val());
                    var rataRataSakit = parseInt($('input[name="rata_rata_sakit"]').val());
                    var hariCutiLain = parseInt($('input[name="hari_cuti_lain"]').val());
                    var jamEfektif = parseInt($('input[name="jam_efektif"]').val());

                    // Calculate Waktu Kerja Tersedia
                    var waktuKerjaTersedia = (efektifHari - (liburNasional + cutiTahunan + rataRataSakit + hariCutiLain)) * jamEfektif;

                    // Set the value in the readonly input field
                    $('input[name="waktu_kerja_tersedia"]').val(waktuKerjaTersedia);

                    event.target.submit(); // Submit the form after calculation
                });

                // Calculate Waktu Kerja Tersedia when the "Hitung" button is clicked
                $('#hitungButton').on('click', function() {
                    // Get the values from the input fields
                    var efektifHari = parseInt($('select[name="efektif_hari"]').val());
                    var liburNasional = parseInt($('input[name="libur_nasional"]').val());
                    var cutiTahunan = parseInt($('input[name="cuti_tahunan"]').val());
                    var rataRataSakit = parseInt($('input[name="rata_rata_sakit"]').val());
                    var hariCutiLain = parseInt($('input[name="hari_cuti_lain"]').val());
                    var jamEfektif = parseInt($('input[name="jam_efektif"]').val());

                    // Calculate Waktu Kerja Tersedia
                    var waktuKerjaTersedia = (efektifHari - (liburNasional + cutiTahunan + rataRataSakit + hariCutiLain)) * jamEfektif;

                    // Set the value in the readonly input field
                    $('input[name="waktu_kerja_tersedia"]').val(waktuKerjaTersedia);
                    console.log("Waktu Kerja Tersedia: " + waktuKerjaTersedia);
                    console.log('tes');
                });
            });
        </script>
        @endpush
</x-layout>
