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
                                    <h5 class="text-white text-capitalize ps-3">Tentang Kami</h5>
                                </div>
                            </div>
                            <div class="card-body px-3 pb-2">
                                <section class="container my-1">
                                    <h2 class="mb-4">Tentang Kami</h2>

                                    <p><strong>Nursing Workload</strong> merupakan aplikasi berbasis web yang dikembangkan sebagai media bantu dalam menganalisis beban kerja tenaga keperawatan secara objektif dan sistematis. Aplikasi ini mengadaptasi metode Workload Indicators of Staffing Need (WISN) yang dikeluarkan oleh World Health Organization (WHO), dengan tujuan mendukung perencanaan kebutuhan SDM keperawatan yang lebih tepat dan objektif</p>

                                    <p>Aplikasi ini dirancang dan dikembangkan oleh tim mahasiswa dan dosen dari Universitas Brawijaya, dengan latar belakang keilmuan di bidang keperawatan, manajemen rumah sakit, dan teknologi informasi kesehatan. Pengembangan ini merupakan bagian dari upaya untuk menyediakan perangkat digital yang aplikatif, terstandar, dan relevan dengan kebutuhan layanan kesehatan di Indonesia.</p>

                                    <h4 class="my-2">Tim Pengembang:</h4>
                                    <div class="row" style="min-height: 10rem">
                                        
                                        <div class="col-md-4 col-12 mt-7">
                                            <div class="card card-profile" style="height: 100%;">
                                                <div class="row justify-content-center">
                                                    <div class="col-12 order-lg-2 mx-auto">
                                                    <div class="mt-n6 mt-lg-n6 mb-4 mb-lg-0 text-center">
                                                        <img src="{{ asset('assets/img/member/member1.png') }}" class="rounded-circle border border-5 border-primary mx-auto" style="object-fit: cover; object-position:center; width: 180px; height: 180px;">
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="text-center mt-2">
                                                        <h5 class="text-primary">
                                                            Ns. Ike Nesdia Rahmawati
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mt-7">
                                            <div class="card card-profile" style="height: 100%;">
                                                <div class="row justify-content-center">
                                                    <div class="col-12 order-lg-2 mx-auto">
                                                    <div class="mt-n6 mt-lg-n6 mb-4 mb-lg-0 text-center">
                                                        <img src="{{ asset('assets/img/member/member2.png') }}" class="rounded-circle border border-5 border-primary mx-auto" style="object-fit: cover; object-position:top; width: 180px; height: 180px;">
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="text-center mt-2">
                                                        <h5 class="text-primary">
                                                            Farida Kholishoti Amali
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mt-7">
                                            <div class="card card-profile" style="height: 100%;">
                                                <div class="row justify-content-center">
                                                    <div class="col-12 order-lg-2 mx-auto">
                                                    <div class="mt-n6 mt-lg-n6 mb-4 mb-lg-0 text-center">
                                                        <img src="{{ asset('assets/img/member/member3.png') }}" class="rounded-circle border border-5 border-primary mx-auto" style="object-fit: cover; object-position:top; width: 180px; height: 180px;">
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="text-center mt-2">
                                                        <h5 class="text-primary">
                                                            Tria Armanaena
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                   
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
