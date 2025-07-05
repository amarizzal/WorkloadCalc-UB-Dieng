@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center"><strong>Data Rumah Sakit</strong></h2>

    <form id="dataRumahSakitForm" action="{{ route('admin.data-rumah-sakit.update') }}" method="POST">
        @csrf
        <div class="form-group row my-3">
            <label for="efektif_hari" class="col-sm-2 col-form-label"><strong>Hari Efektif</strong></label>
            <div class="col-sm-10">
            <select required id="efektif_hari" class="form-control" name="efektif_hari">
                <option disabled selected>Pilih hari ...</option>
                @if (isset($hospital) && $hospital->efektif_hari == 365)
                    <option value=365 selected>6 Hari = 365 hari</option>
                    <option value=260>5 Hari = 260 hari</option>
                @elseif (isset($hospital) && $hospital->efektif_hari == 260)
                    <option value=365>6 Hari = 365 hari</option>
                    <option value=260 selected>5 Hari = 260 hari</option>
                @else
                    <option value=365>6 Hari = 365 hari</option>
                    <option value=260>5 Hari = 260 hari</option>
                @endif
            </select>
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="libur_nasional" class="col-sm-2 col-form-label"><strong>Libur Nasional</strong></label>
            <div class="col-sm-10">
            <input required type="number" class="form-control" id="libur_nasional" name="libur_nasional" value="{{ isset($hospital) ? $hospital->libur_nasional : '' }}">
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="cuti_tahunan" class="col-sm-2 col-form-label"><strong>Cuti Tahunan</strong></label>
            <div class="col-sm-10">
            <input required type="number" class="form-control" id="cuti_tahunan" name="cuti_tahunan" value="{{ isset($hospital) ? $hospital->cuti_tahunan : '' }}">
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="rata_rata_sakit" class="col-sm-2 col-form-label"><strong>Rata-rata Sakit</strong></label>
            <div class="col-sm-10">
            <input required type="number" class="form-control" id="rata_rata_sakit" name="rata_rata_sakit" value="{{ isset($hospital) ? $hospital->rata_rata_sakit : '' }}">
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="hari_cuti_lain" class="col-sm-2 col-form-label"><strong>Hari Cuti Lain</strong></label>
            <div class="col-sm-10">
            <input required type="number" class="form-control" id="hari_cuti_lain" name="hari_cuti_lain" value="{{ isset($hospital) ? $hospital->hari_cuti_lain : '' }}">
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="jam_efektif" class="col-sm-2 col-form-label"><strong>Jam Efektif</strong></label>
            <div class="col-sm-10">
            <input required type="number" class="form-control" id="jam_efektif" name="jam_efektif" value="{{ isset($hospital) ? $hospital->jam_efektif : '' }}">
            </div>
        </div>
        <div class="form-group row my-3">
            <label for="waktu_kerja_tersedia" class="col-sm-2 col-form-label"><strong>Waktu Kerja Tersedia</strong></label>
            <div class="col-sm-10">
            <input required type="text" readonly class="form-control bg-light" id="waktu_kerja_tersedia" name="waktu_kerja_tersedia" value="{{ isset($hospital) ? $hospital->waktu_kerja_tersedia : '' }}">
            </div>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-success ml-auto">Simpan</button>
            <button type="button" id="hitungButton" class="btn btn-outline-secondary mr-auto">Hitung</button>
        </div>
    </form>
    
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
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
@endsection
