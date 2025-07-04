@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Laporan Tindakan Perawat Per User</h2>

        <!-- Dropdown untuk memilih user -->
        <form method="GET" action="{{ route('admin.laporan.index6') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="user_id" class="form-label">Pilih Perawat:</label>
                    <select name="user_id" id="user_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Pilih Perawat --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
                                {{ $user->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        @if ($selectedUserId)
                <!-- Tabel Tengah: Tindakan dan Jumlah Tindakan -->
                <h4>Jumlah Tindakan</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tindakan</th>
                            <th>Jumlah Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tindakanJumlah as $tindakanId => $jumlah)
                            <tr>
                                <td>
                                    <a href="javascript:void(0);" class="tindakan-detail" data-tindakan-id="{{ $tindakanId }}"
                                        data-user-id="{{ $selectedUserId }}">
                                        {{ $laporan->where('tindakan_id', $tindakanId)->first()->tindakan->tindakan ?? 'Tidak Ada Data' }}
                                    </a>
                                </td>
                                <td>{{ $jumlah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                   <!-- Bagian Bawah: Rata-rata Waktu dan SWL -->
            <h4>Rata-rata Waktu dan SWL</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tindakan</th>
                        <th>Rata-rata Waktu (Jam)</th>
                        <th>Standar Workload (SWL)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rataRataWaktu as $tindakanId => $rataWaktu)
                        <tr>
                            <td>{{ $laporan->where('tindakan_id', $tindakanId)->first()->tindakan->tindakan ?? 'Tidak Ada Data' }}</td>
                            <td>{{ number_format($rataWaktu, 2) }} jam</td>
                            <td>{{ number_format($swl[$tindakanId], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>




                <!-- Bagian untuk Detail Tindakan -->
                <div id="detailTindakanContainer" class="mt-4" style="display: none;">
                    <h4>Detail Tindakan</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Durasi</th>
                                <th>Keterangan</th>
                                <th>Shift</th>
                                <th>Jam Mulai</th>
                                <th>Jam Berhenti</th>
                            </tr>
                        </thead>
                        <tbody id="detailTindakanBody">
                            <!-- Detail tindakan akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
        @else
            <p class="text-center mt-4">Silakan pilih perawat dari dropdown di atas untuk melihat laporan.</p>
        @endif
    </div>

    <!-- Script untuk AJAX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.tindakan-detail');
            const detailContainer = document.getElementById('detailTindakanContainer');
            const detailBody = document.getElementById('detailTindakanBody');

            links.forEach(link => {
                link.addEventListener('click', function() {
                    const tindakanId = this.getAttribute('data-tindakan-id');
                    const userId = this.getAttribute('data-user-id');

                    // Clear previous details
                    detailBody.innerHTML = '';
                    detailContainer.style.display = 'none';

                    // Fetch detail data via AJAX
                    fetch(`/admin/laporan/detail-tindakan/${tindakanId}/${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log('Data received from server:', data); // Tampilkan data di console

                            detailBody.innerHTML = ''; // Clear previous data
                            if (data.length > 0) {
                                data.forEach((item, index) => {
                                    const row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.tanggal}</td>
                                    <td>${item.durasi}</td>
                                    <td>${item.keterangan}</td>
                                    <td>${item.shift}</td>
                                    <td>${item.jam_mulai}</td>
                                    <td>${item.jam_berhenti}</td>
                                </tr>
                            `;
                                    detailBody.innerHTML += row;
                                });
                            }
                            detailContainer.style.display = 'block';
                        })
                        .catch(error => {
                            console.error('Error fetching detail data:', error);
                        });
                });
            });
        });
    </script>
@endsection
