<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="master-hospital"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.master titlePage="Data Rumah Sakit"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Data Rumah Sakit</h5>
                                </div>
                            </div>
                            <div class="card-body px-3 pb-2">
                                <form id="dataRumahSakitForm" action="{{ route('admin.data-rumah-sakit.update') }}" method="POST" class="">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="input-group input-group-outline mx-auto row my-1">
                                                <label for="efektif_hari" class=" col-form-label text-dark"><strong>Hari Efektif</strong></label>
                                                <div class="">
                                                <select required id="efektif_hari" class="form-control" name="efektif_hari">
                                                    <option disabled selected>Pilih hari ...</option>
                                                    @if (isset($hospital) && $hospital->efektif_hari == 312)
                                                        <option value=312 selected>6 Hari = 312 hari</option>
                                                        <option value=260>5 Hari = 260 hari</option>
                                                    @elseif (isset($hospital) && $hospital->efektif_hari == 260)
                                                        <option value=312>6 Hari = 312 hari</option>
                                                        <option value=260 selected>5 Hari = 260 hari</option>
                                                    @else
                                                        <option value=312>6 Hari = 312 hari</option>
                                                        <option value=260>5 Hari = 260 hari</option>
                                                    @endif
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group input-group-outline mx-auto row my-1">
                                                <label for="libur_nasional" class=" col-form-label text-dark"><strong>Libur Nasional</strong></label>
                                                <div class="">
                                                <input required type="number" class="form-control" id="libur_nasional" name="libur_nasional" value="{{ isset($hospital) ? $hospital->libur_nasional : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group input-group-outline mx-auto row my-1">
                                                <label for="cuti_tahunan" class=" col-form-label text-dark"><strong>Cuti Tahunan</strong></label>
                                                <div class="">
                                                <input required type="number" class="form-control" id="cuti_tahunan" name="cuti_tahunan" value="{{ isset($hospital) ? $hospital->cuti_tahunan : '' }}">
                                                </div>
                                            </div>
    
                                        </div>
                                    </div>
                                    <div class="input-group input-group-outline mx-auto row my-1">
                                        <label for="rata_rata_sakit" class=" col-form-label text-dark"><strong>Rata-rata Sakit</strong></label>
                                        <div class="">
                                        <input required type="number" class="form-control" id="rata_rata_sakit" name="rata_rata_sakit" value="{{ isset($hospital) ? $hospital->rata_rata_sakit : '' }}">
                                        </div>
                                    </div>
                                    <div class="input-group input-group-outline mx-auto row my-1">
                                        <label for="hari_cuti_lain" class=" col-form-label text-dark"><strong>Hari Cuti Lain</strong></label>
                                        <div class="">
                                        <input required type="number" class="form-control" id="hari_cuti_lain" name="hari_cuti_lain" value="{{ isset($hospital) ? $hospital->hari_cuti_lain : '' }}">
                                        </div>
                                    </div>
                                    <div class="input-group input-group-outline mx-auto row my-1">
                                        <label for="jam_efektif" class=" col-form-label text-dark"><strong>Jam Efektif</strong></label>
                                        <div class="">
                                        <input required type="number" class="form-control" id="jam_efektif" name="jam_efektif" value="{{ isset($hospital) ? $hospital->jam_efektif : '' }}">
                                        </div>
                                    </div>
                                    <div class="input-group input-group-outline mx-auto row my-1">
                                        <label for="waktu_kerja_tersedia" class=" col-form-label text-danger"><strong>Waktu Kerja Tersedia</strong></label>
                                        <div class="">
                                        <input required type="text" readonly class="form-control bg-light font-weight-bolder text-danger" id="waktu_kerja_tersedia" name="waktu_kerja_tersedia" value="{{ isset($hospital) ? $hospital->waktu_kerja_tersedia : '' }}">
                                        </div>
                                    </div>
                                    <div class="input-group input-group-outline mx-auto text-center justify-content-center mt-5">
                                        <button type="submit" class="btn btn-success ml-auto">Simpan</button>
                                        <button type="button" id="hitungButton" class="btn btn-outline-secondary mr-auto">Hitung</button>
                                    </div>
                                </form>
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
