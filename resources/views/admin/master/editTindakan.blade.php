@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Edit Tindakan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.master.tindakan.update', $tindakan->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Menandakan bahwa ini adalah request PUT -->

                        <div class="mb-4">
                            <label for="tindakan" class="form-label fw-bold">Tindakan</label>
                            <input type="text" class="form-control border-primary" id="tindakan" name="tindakan" value="{{ $tindakan->tindakan }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="waktu" class="form-label fw-bold">Waktu (Menit)</label>
                            <input type="number" class="form-control border-primary" id="waktu" name="waktu" value="{{ $tindakan->waktu }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select class="form-control border-primary" id="status" name="status" required>
                                <option value="Tugas Pokok" {{ $tindakan->status == 'Tugas Pokok' ? 'selected' : '' }}>Tugas Pokok</option>
                                <option value="Tugas Penunjang" {{ $tindakan->status == 'Tugas Penunjang' ? 'selected' : '' }}>Tugas Penunjang</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.master-tindakan') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Perbarui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
