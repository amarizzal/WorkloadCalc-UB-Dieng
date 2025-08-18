<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.bottombar activePage="dashboard"></x-navbars.bottombar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.perawat titlePage="Privasi"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Panduan Perawat</h5>
                                </div>
                            </div>
                            <div class="card-body px-3 pb-2">
                                <section class="container my-1 text-dark text-lg font-weight-bolder">
                                    <h2 class="mb-4">Panduan Perawat</h2>

                                    <ol>
                                        <li>Masuk ke akun (login)<img src="{{ asset('images/panduan-perawat') }}/panduan1.jpeg" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-height: 30rem; display: block;"><img src="{{ asset('images/panduan-perawat') }}/panduan2.jpeg" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-height: 30rem; display: block;">
                                        </li>
                                        <li>Perbarui biodata sesuai kebutuhan.<img src="{{ asset('images/panduan-perawat') }}/panduan3.jpeg" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-height: 30rem; display: block;">
                                        <img src="{{ asset('images/panduan-perawat') }}/panduan4.jpeg" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-height: 30rem; display: block;">
                                        </li>
                                        <li>Pada menu tugas pokok, pilih tindakan lalu tekan Start sebelum memulai dan Stop setelah selesai. Jika lupa mencatat, tentukan tanggal dan waktu lalu klik Simpan.<img src="{{ asset('images/panduan-perawat') }}/panduan5.jpeg" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-height: 30rem; display: block;">
                                        <img src="{{ asset('images/panduan-perawat') }}/panduan6.jpeg" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-height: 30rem; display: block;">
                                        </li>
                                        <li>Pada menu tindakan penunjang, pilih kegiatan dan lengkapi tanggal serta waktu, lalu tentukan apakah kegiatan dilakukan harian, bulanan, atau tahunan.<img src="{{ asset('images/panduan-perawat') }}/panduan7.jpeg" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-height: 30rem; display: block;">
                                        </li>
                                        <li>Pada menu tindakan tambahan, isikan aktivitas tambahan yang telah dilakukan, seperti supervisi, delegasi, atau kegiatan lain yang tidak dikerjakan oleh semua perawat.<img src="{{ asset('images/panduan-perawat') }}/panduan8.jpeg" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-height: 30rem; display: block;">
                                        </li>
                                        <li>Hasil beban kerja dapat dilihat beserta rangkuman seluruh kegiatan<img src="{{ asset('images/panduan-perawat') }}/panduan9.jpeg" alt="Halaman Login" class="img-fluid shadow border-radius-lg text-center mb-5" style="max-height: 30rem; display: block;">
                                        </li>
                                        <li>Keluar dari akun (logout) setelah selesai.
                                        </li>
                                        
                                    </ol>

                                    <h2 class="my-4 text-primary">Video Panduan Perawat</h2>
                                    <iframe  height="315" src="https://www.youtube.com/embed/L2q4nYcwy5Y?si=4unQ1F6FQzpFi0B0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
