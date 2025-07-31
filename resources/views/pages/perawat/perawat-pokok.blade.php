<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.bottombar activePage="pokok"></x-navbars.bottombar>
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
            <x-navbars.navs.perawat titlePage="Pokok"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                                    <h5 class="text-white text-capitalize ps-3">Tugas Pokok</h5>
                                </div>
                            </div>
                            <div class="card-body px-3 pb-2">
                                <section class="container my-1">
                                     <!-- Bagian Shift -->
                                    <div class="text-center">
                                        <h4>Shift: {{ $shiftName ?? '<strong class="text-danger">Tidak ada shift</strong>' }}</h4>
                                        <p>Waktu Saat Ini: {{ $currentTime }}</p>
                                    </div>
                                    <hr>

                                    <!-- Dropdown untuk Pilih Jenis Tindakan -->
                                    <div class="mt-4">
                                        <h5>Pilih Jenis Tindakan</h5>
                                        <div class="form-group">
                                            <select class="form-control tindakan-select" id="tindakanSelect" name="tindakan_id">
                                                <option value="" disabled selected>Pilih Tindakan</option>
                                                @foreach ($tindakanWaktu as $tindakan)
                                                    <option value="{{ $tindakan->id }}">
                                                        {{ $tindakan->tindakan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Timer Circle -->
                                    <div class="timer-container">
                                        <div class="countdown-circle">
                                            <span id="timer-text" data-isRunning="{{ $isTimerRunning ? 'true' : 'false' }}"
                                                data-remainingTime="{{ $sisaWaktu }}">
                                                00:00
                                            </span>
                                            <svg>
                                                <circle cx="50" cy="50" r="45" class="background-circle"></circle>
                                                <circle id="progress-circle" cx="50" cy="50" r="45" class="progress-circle">
                                                </circle>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Hidden Inputs -->
                                    <input type="hidden" id="shiftId" name="shift_id" value="{{ $shiftId }}">
                                    <input type="hidden" id="laporanId" name="laporan_id" value="{{ $laporanAktif ? $laporanAktif->id : '' }}">

                                    <!-- Action Buttons -->
                                    <div class="mt-4 text-center">
                                        <button type="button" class="btn btn-primary me-2" id="startButton">Start</button>
                                        <button id="stopButton" class="btn btn-danger" disabled>Stop</button>
                                    </div>

                                    <!-- Menampilkan waktu berhenti dan durasi -->
                                    <div id="timerDetails" style="display: none;">
                                        <p>Waktu Berhenti: <span id="stopTime"></span></p>
                                        <p>Durasi: <span id="duration"></span> detik</p>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
        </main>

        @push('js')
        <!-- Script untuk Select2 -->
        <script>
            $(document).ready(function() {
                $('.tindakan-select').select2({
                    placeholder: "Cari atau pilih tindakan",
                    allowClear: true,
                    width: 'resolve',
                    dropdownCssClass: "custom-select2-dropdown"
                });
            });

            // Script untuk update timer saat memilih tindakan
            document.getElementById("tindakanSelect").addEventListener("change", function() {
                const selectedOption = this.options[this.selectedIndex];
                const waktuTindakan = selectedOption.getAttribute("data-id");

                if (waktuTindakan) {
                    duration = waktuTindakan * 60; // Mengkonversi menit ke detik
                    timeLeft = duration; // Reset waktu
                    updateTimer(); // Update timer tampilan
                }
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const startButton = document.getElementById("startButton");
                const stopButton = document.getElementById("stopButton");
                const timerText = document.getElementById("timer-text");
                const timerDetails = document.getElementById("timerDetails");
                const circleLength = 283; // Panjang keliling lingkaran SVG (misalnya 2 * π * r)
                const duration = 60; // Dalam detik, 1 menit
                const progressCircle = document.getElementById("progress-circle");

                let timerInterval;
                let elapsedTime = 0; // Pindahkan ke luar agar bisa diakses di stopButton

                // Fungsi untuk memulai timer (menghitung maju)
                function startTimer() {
                    elapsedTime = 0;

                    timerInterval = setInterval(() => {
                        const minutes = Math.floor(elapsedTime / 60);
                        const seconds = elapsedTime % 60;

                        // Perbarui tampilan timer
                        timerText.textContent = `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;

                        // Update progress circle
                        const progress = (elapsedTime / duration) * circleLength;
                        progressCircle.style.strokeDashoffset = circleLength - progress;

                        elapsedTime++; // Tambahkan waktu setiap detik

                    }, 1000);
                }

                startButton.addEventListener("click", () => {
                    const tindakanId = document.getElementById("tindakanSelect").value;
                    const shiftId = document.getElementById("shiftId").value;

                    if (!tindakanId || !shiftId) {
                        alert("Pilih tindakan dan shift terlebih dahulu!");
                        return;
                    }

                    fetch("/perawat/start-action", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content,
                            },
                            body: JSON.stringify({
                                tindakan_id: tindakanId,
                                shift_id: shiftId
                            }),
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                alert(data.message);

                                // Perbarui laporanId dengan ID yang baru
                                document.getElementById("laporanId").value = data.laporan_id;

                                startTimer(); // Mulai timer
                                startButton.disabled = true;
                                stopButton.disabled = false;
                            } else {
                                alert("Gagal memulai timer.");
                            }
                        })
                        .catch((error) => {
                            console.error("Error:", error);
                            alert("Terjadi kesalahan.");
                        });
                });

                stopButton.addEventListener("click", () => {
                    const laporanId = document.getElementById("laporanId").value;

                    // Pastikan laporanId tidak kosong
                    if (!laporanId) {
                        alert("Tidak ada laporan aktif untuk dihentikan!");
                        return;
                    }

                    // Tambahan: konfirmasi jika durasi < 10 detik
                    if (elapsedTime < 10) {
                        const confirmSend = confirm(`Durasi baru ${elapsedTime} detik. Yakin ingin mengirim data?`);
                        if (!confirmSend) {
                            clearInterval(timerInterval);
                            timerText.textContent = "00:00";
                            elapsedTime = 0;

                            startButton.disabled = false;
                            stopButton.disabled = true;
                            return;
                        }
                    }

                    fetch(`/perawat/stop-action/${laporanId}`, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content,
                            },
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.status === "success") {
                                clearInterval(timerInterval); // Hentikan timer
                                timerText.textContent = "00:00"; // Reset tampilan timer
                                alert(`Timer dihentikan.`);

                                startButton.disabled = false;
                                stopButton.disabled = true;

                                // Menampilkan detail waktu berhenti
                                timerDetails.style.display = "block";
                                timerDetails.innerHTML = `
                    <p><span class='time-label'>Jam Berhenti:</span> ${data.jam_berhenti}</p>
                `;
                            } else {
                                alert("Gagal menghentikan timer.");
                            }
                        })
                        .catch((error) => {
                            console.error("Error:", error);
                            alert("Terjadi kesalahan.");
                        });
                });



            });
        </script>
        @endpush
</x-layout>
