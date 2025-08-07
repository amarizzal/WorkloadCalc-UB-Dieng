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
                                    <h5 class="text-white text-capitalize ps-3">Keamanan & Privasi</h5>
                                </div>
                            </div>
                            <div class="card-body px-3 pb-2">
                                <section class="container my-1">
                                    <h2 class="mb-4">Kebijakan Privasi</h2>

                                    <p>Aplikasi <strong>Nursing Workload</strong> adalah sistem aplikasi yang dikembangkan untuk membantu perhitungan beban kerja perawat secara digital. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi informasi pribadi Anda.</p>

                                    <p>Dengan mengakses atau menggunakan aplikasi Nursing Workload, Anda menyatakan telah membaca, memahami, dan menyetujui ketentuan dalam Kebijakan Privasi ini. Jika Anda tidak menyetujui salah satu bagian dari kebijakan ini, mohon untuk tidak melanjutkan penggunaan aplikasi.</p>

                                    <h4>A. Pengumpulan dan Penggunaan Data Anda</h4>
                                    <p>Kami mengumpulkan data pribadi yang Anda berikan secara langsung maupun tidak langsung saat menggunakan aplikasi, meliputi:</p>

                                    <p><strong>Data yang Anda berikan secara langsung, seperti:</strong></p>
                                    <ul>
                                        <li>Nama lengkap</li>
                                        <li>Nomor Induk Perawat atau ID pengguna</li>
                                        <li>Unit atau ruangan kerja</li>
                                        <li>Email aktif</li>
                                        <li>Informasi jam kerja dan jadwal shift</li>
                                    </ul>

                                    <p><strong>Data yang dikumpulkan secara otomatis saat Anda menggunakan aplikasi:</strong></p>
                                    <ul>
                                        <li>Log penggunaan aplikasi</li>
                                        <li>Alamat IP perangkat</li>
                                        <li>Jenis perangkat dan sistem operasi</li>
                                    </ul>

                                    <h4>B. Penggunaan Data</h4>
                                    <p>Data Anda digunakan untuk keperluan berikut:</p>
                                    <ul>
                                        <li>Melakukan perhitungan dan analisis beban kerja berdasarkan data yang dimasukkan.</li>
                                        <li>Menyediakan laporan evaluasi dan histori perhitungan beban kerja.</li>
                                        <li>Memberikan dukungan teknis dan operasional aplikasi.</li>
                                        <li>Meningkatkan kualitas dan pengalaman pengguna dalam menggunakan aplikasi.</li>
                                        <li>Memenuhi kewajiban hukum atau permintaan otoritas berwenang bila diperlukan.</li>
                                    </ul>

                                    <h4>C. Pengungkapan Informasi</h4>
                                    <p>Kami tidak akan membagikan informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali diwajibkan oleh hukum, peraturan yang berlaku, atau jika dibutuhkan oleh institusi kesehatan mitra dengan jaminan kerahasiaan yang memadai.</p>

                                    <h4>D. Hak Pengguna</h4>
                                    <p>Anda berhak untuk mengakses, memperbarui, dan menghapus data pribadi Anda yang tersimpan dalam sistem aplikasi Nursing Workload. Anda juga dapat mengajukan permintaan penghapusan akun atau berhenti menggunakan layanan kapan saja melalui email resmi pengembang.</p>

                                    <h4>E. Perubahan Kebijakan</h4>
                                    <p>Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Setiap perubahan akan diinformasikan melalui aplikasi atau kanal resmi lainnya. Dengan tetap menggunakan aplikasi setelah kebijakan diperbarui, Anda dianggap telah menyetujui perubahan tersebut.</p>

                                    <h4>F. Kontak</h4>
                                    <p>Untuk pertanyaan, keluhan, atau permintaan terkait kebijakan privasi ini, Anda dapat menghubungi kami melalui:</p>
                                    <p><strong>Email:</strong> <a href="mailto:nursingworkloadub@gmail.com">nursingworkloadub@gmail.com</a></p>
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
