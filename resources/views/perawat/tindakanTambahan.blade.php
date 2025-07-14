@extends('perawat.layouts.app')

@section('content')
<div class="container mt-4">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    

    <!-- Form untuk Tindakan Tambahan -->
    <div class="card shadow-sm mt-3" id="form_tindakan_tambahan">
        <div class="card-body">
            <h5 class="card-title text-center">Tambah Jenis Tindakan Tambahan</h5>
            <form action="{{ route('perawat.tindakan.storeTambahan') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="select_jenis_tindakan" class="form-label">Jenis Tindakan</label>
                    <select onchange="selectTindakan(this.value)" class="form-select select2-tindakan" id="select_jenis_tindakan" name="jenis_tindakan" required>
                        <option value="" disabled selected>Pilih atau Tambah Tindakan</option>
                        @foreach($jenisTindakan as $tindakan)
                            <option value="{{ $tindakan->tindakan }}" data-satuan="{{ $tindakan->satuan }}" data-kategori="{{ $tindakan->kategori }}">{{ $tindakan->tindakan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div>
                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu (Jam)</label>
                    <input type="number" class="form-control" name="waktu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan CDN Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<style>
/* Styling khusus untuk Select2 */
.select2-container {
    width: 100% !important; /* Pastikan Select2 mengikuti lebar parent */
}

.select2-selection {
    height: 38px !important; /* Sesuaikan dengan tinggi input Bootstrap */
    border-radius: 5px;
    border: 1px solid #ced4da;
    display: flex;
    align-items: center;
}

.select2-selection__rendered {
    padding-left: 12px;
    font-size: 14px;
    color: #212529 !important;
}

.select2-selection__arrow {
    height: 36px;
    right: 8px;
}

.select2-dropdown {
    border-radius: 5px;
    border: 1px solid #ced4da;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.select2-results__option {
    padding: 8px 12px;
    font-size: 14px;
}

.select2-results__option--highlighted {
    background-color: #007bff !important;
    color: white !important;
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
}

/* Hover efek untuk dropdown */
.select2-results__option:hover {
    background-color: #f8f9fa;
    color: #212529;
}
</style>

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

            // Set nilai satuan dan kategori pada form
            $('#satuan').val(satuan).trigger('change');
            $('#kategori').val(kategori).trigger('change');
            // set agar disabled
            $('#satuan').prop('disabled', true);
            $('#kategori').prop('disabled', true);
        } else {
            // Jika tidak ada data, kosongkan input
            $('#satuan').val('').trigger('change');
            $('#kategori').val('').trigger('change');
            // set agar disabled
            $('#satuan').prop('disabled', false);
            $('#kategori').prop('disabled', false);
        }
    };
});
</script>

@endsection
