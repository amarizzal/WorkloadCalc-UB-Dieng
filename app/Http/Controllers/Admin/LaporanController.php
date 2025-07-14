<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanTindakanPerawat;
use App\Models\TindakanWaktu;
use App\Models\RecordAnalisaData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    /**
     * Get hospital working hours with null handling and default value
     * 
     * @param int $default Default value if hospital data is not available
     * @return int
     */
    private function getHospitalWorkingHours($default = 2000)
    {
        $hospital = \App\Models\Hospital::first();
        return $hospital ? ($hospital->waktu_kerja_tersedia ?? $default) : $default;
    }

    public function index()
    {
        // Mengambil data laporan tindakan perawat beserta relasinya
        $laporan = LaporanTindakanPerawat::with(['user', 'ruangan', 'shift', 'tindakan'])->get();

        // Jika sudah benar, kembalikan ke view
        return view('admin.laporan.laporanhasil', compact('laporan'));
    }

    public function index2(Request $request)
    {
        // Query dasar untuk mengambil laporan dengan status "Tugas Pokok"
        $query = LaporanTindakanPerawat::with(['user', 'tindakan'])
            ->whereHas('tindakan', function ($q) {
                $q->where('status', 'Tugas Pokok');
            });

        // Ambil input tanggal dari request
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Jika pengguna memilih tanggal, filter berdasarkan rentang tanggal
        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('tanggal', [$tanggalAwal . " 00:00:00", $tanggalAkhir . " 23:59:59"]);
        }

        // Ambil data laporan yang telah difilter
        $laporan = $query->get();

        // Ambil daftar perawat yang memiliki tindakan "Tugas Pokok"
        $perawat = $laporan->pluck('user')->unique('id');

        // Ambil daftar tindakan yang memiliki status "Tugas Pokok"
        $tindakanPokok = $laporan->pluck('tindakan')->unique('id');

        // Hitung jumlah tindakan per tindakan dan per perawat
        $perawatTindakan = [];
        foreach ($perawat as $perawatItem) {
            foreach ($tindakanPokok as $tindakan) {
                $perawatTindakan[$perawatItem->id][$tindakan->id] = $laporan
                    ->where('user_id', $perawatItem->id)
                    ->where('tindakan_id', $tindakan->id)
                    ->count();
            }
        }

        // Hitung total tindakan untuk setiap jenis tindakan
        $totalTindakan = [];
        foreach ($tindakanPokok as $tindakan) {
            $totalTindakan[$tindakan->id] = $laporan->where('tindakan_id', $tindakan->id)->count();
        }

        // Menghitung rata-rata waktu per tindakan
        $rataRataWaktu = [];
        $tindakanPokok = TindakanWaktu::where('status', 'Tugas Pokok')->with(['laporanTindakan.user'])->get();

        foreach ($tindakanPokok as $tindakan) {
            $laporanTindakan = $laporan->where('tindakan_id', $tindakan->id);
            $totalDurasi = $laporanTindakan->sum('durasi');
            $jumlahTindakan = $laporanTindakan->count();

            $rataRataWaktu[$tindakan->id] = $jumlahTindakan > 0 ? ($totalDurasi / $jumlahTindakan) / 60 : 0;
        }

        // Menghitung standar workload (SWL)
        $swl = [];
        $jamTersediaPerTahun = 2000;
        foreach ($rataRataWaktu as $tindakanId => $rataWaktu) {
            $swl[$tindakanId] = $rataWaktu > 0 ? $jamTersediaPerTahun / ($rataWaktu / 60) : 0;
        }

        return view('admin.laporan.laporanhasil2', compact(
            'perawat', 'perawatTindakan', 'tindakanPokok', 'laporan',
            'rataRataWaktu', 'swl', 'totalTindakan', 'tanggalAwal', 'tanggalAkhir'
        ));
    }

    public function index3(Request $request)
    {
        // Query untuk mengambil laporan dengan status "Tugas Penunjang"
        $query = LaporanTindakanPerawat::with(['user', 'tindakan'])
            ->whereHas('tindakan', function ($q) {
                $q->where('status', 'Tugas Penunjang');
            });

        // Ambil input tanggal dari request
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Terapkan filter berdasarkan rentang tanggal jika tersedia
        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('tanggal', [$tanggalAwal . " 00:00:00", $tanggalAkhir . " 23:59:59"]);
        }

        // Ambil data laporan yang telah difilter
        $laporan = $query->get();

        // Ambil daftar perawat yang memiliki tindakan "Tugas Penunjang"
        $perawat = $laporan->pluck('user')->unique('id');

        // Ambil daftar tindakan yang memiliki status "Tugas Penunjang"
        $tindakanPenunjang = $laporan->pluck('tindakan')->unique('id');

        // Ambil data rumah sakit
        $hospitalTime = $this->getHospitalWorkingHours();

        // Hitung jumlah tindakan per tindakan dan per perawat
        $perawatTindakan = [];
        foreach ($perawat as $perawatItem) {
            foreach ($tindakanPenunjang as $tindakan) {
                $perawatTindakan[$perawatItem->id][$tindakan->id] = $laporan
                    ->where('user_id', $perawatItem->id)
                    ->where('tindakan_id', $tindakan->id)
                    ->count();
            }
        }

        // Hitung total tindakan untuk setiap jenis tindakan
        $totalTindakan = [];
        foreach ($tindakanPenunjang as $tindakan) {
            $totalTindakan[$tindakan->id] = $laporan->where('tindakan_id', $tindakan->id) ? $laporan->where('tindakan_id', $tindakan->id)->count() : 0;
        }

        // Menghitung rata-rata waktu per tindakan
        $rataRataWaktu = [];
        $tindakanPenunjang = TindakanWaktu::where('status', 'Tugas Penunjang')->get();

        foreach ($tindakanPenunjang as $tindakan) {
            $laporanTindakan = $laporan->where('tindakan_id', $tindakan->id);
            $totalDurasi = $laporanTindakan->sum('durasi');
            $jumlahTindakan = $laporanTindakan->count();

            $rataRataWaktu[$tindakan->id] = $jumlahTindakan > 0 ? ($totalDurasi / $jumlahTindakan) / 60 : 0;
        }

        // Menghitung standar workload (SWL)
        $swl = [];
        $jamTersediaPerTahun = 2000;
        foreach ($rataRataWaktu as $tindakanId => $rataWaktu) {
            $swl[$tindakanId] = $rataWaktu > 0 ? $jamTersediaPerTahun / ($rataWaktu / 60) : 0;
        }

        return view('admin.laporan.laporanhasil3', compact(
            'perawat', 'perawatTindakan', 'tindakanPenunjang', 'laporan',
            'rataRataWaktu', 'swl', 'totalTindakan', 'tanggalAwal', 'tanggalAkhir', 'hospitalTime'
        ));
    }

    public function index4()
    {
        // Ambil data laporan tindakan perawat dengan status "Tugas Pokok" dan nama tindakan "Lain-Lain"
        $laporan = LaporanTindakanPerawat::with(['user', 'tindakan'])
            ->whereHas('tindakan', function ($query) {
                $query
                    ->where('status', 'Tugas Pokok') // Hanya ambil tindakan dengan status "Tugas Pokok"
                    ->where('tindakan', 'Lain-Lain'); // Tindakan dengan nama "Lain-Lain"
            })
            ->get();

        // Cek data laporan yang diambil
        // Menghitung jumlah tindakan per perawat
        $perawatTindakan = $laporan->groupBy('user_id')->map(function ($perawatLaporan) {
            $tindakanJumlah = [];
            foreach ($perawatLaporan as $laporan) {
                // Hitung jumlah tindakan per perawat dan per tindakan
                $tindakanJumlah[$laporan->tindakan_id] = $perawatLaporan->where('tindakan_id', $laporan->tindakan_id)->count();
            }
            return $tindakanJumlah;
        });

        // Menghitung rata-rata waktu per tindakan
        $rataRataWaktu = [];
        $tindakanLainLain = TindakanWaktu::where('status', 'Tugas Pokok')->where('tindakan', 'Lain-Lain')->get(); // Ambil semua tindakan dengan status Tugas Pokok dan nama "Lain-Lain"

        foreach ($tindakanLainLain as $tindakan) {
            // Ambil laporan yang sesuai dengan tindakan
            $laporanTindakan = $laporan->where('tindakan_id', $tindakan->id);
            $totalDurasi = 0; // Total durasi untuk tindakan ini
            $jumlahTindakan = 0; // Jumlah tindakan yang dilakukan

            foreach ($laporanTindakan as $data) {
                // Ambil durasi dari data dan pastikan tidak null
                if ($data->durasi) {
                    $totalDurasi += $data->durasi; // Tambahkan durasi untuk tindakan ini
                    $jumlahTindakan++; // Hitung jumlah tindakan
                }
            }

            // Hitung rata-rata waktu per tindakan jika ada tindakan
            if ($jumlahTindakan > 0) {
                $rataRataWaktu[$tindakan->id] = $totalDurasi / $jumlahTindakan / 3600; // Durasi dalam jam
            } else {
                $rataRataWaktu[$tindakan->id] = 0; // Jika tidak ada tindakan, set rata-rata 0
            }
        }

        // Menghitung standar workload (SWL)
        $swl = [];
        $jamTersediaPerTahun = 2000; // Misalnya, jam kerja tersedia dalam setahun (8 jam sehari * 250 hari kerja)
        foreach ($rataRataWaktu as $tindakanId => $rataWaktu) {
            // Cek jika rataWaktu lebih besar dari 0 untuk menghindari pembagian dengan nol
            if ($rataWaktu > 0) {
                $swl[$tindakanId] = $jamTersediaPerTahun / $rataWaktu; // Mengkonversi rata-rata waktu ke jam
            } else {
                $swl[$tindakanId] = 0; // Jika rataWaktu 0, set SWL ke 0
            }
        }

        return view('admin.laporan.laporanhasil4', compact('laporan', 'tindakanLainLain', 'perawatTindakan', 'rataRataWaktu', 'swl'));
    }
    public function index5(Request $request)
    {
        // Query untuk mengambil laporan dengan status "Tambahan"
        $query = LaporanTindakanPerawat::with(['user', 'tindakan'])
            ->whereHas('tindakan', function ($q) {
                $q->where('status', 'tambahan');
            });

        // Ambil input tanggal dari request
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Terapkan filter berdasarkan rentang tanggal jika tersedia
        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('tanggal', [$tanggalAwal . " 00:00:00", $tanggalAkhir . " 23:59:59"]);
        }

        // Ambil data laporan yang telah difilter
        $laporan = $query->get();

        // // Ambil daftar perawat yang memiliki tindakan "Tambahan"
        // $perawat = $laporan->pluck('user')->unique('id');

        // // Ambil daftar tindakan yang memiliki status "Tambahan"
        // $tindakanTambahan = $laporan->pluck('tindakan')->unique('id');

        // Hitung jumlah tindakan per tindakan dan per perawat
        // $perawatTindakan = [];
        // foreach ($perawat as $perawatItem) {
        //     foreach ($tindakanTambahan as $tindakan) {
        //         $perawatTindakan[$perawatItem->id][$tindakan->id] = $laporan
        //             ->where('user_id', $perawatItem->id)
        //             ->where('tindakan_id', $tindakan->id)
        //             ->count();
        //     }
        // }

        // Hitung total tindakan untuk setiap jenis tindakan
        // $totalTindakan = [];
        // foreach ($tindakanTambahan as $tindakan) {
        //     $totalTindakan[$tindakan->id] = $laporan->where('tindakan_id', $tindakan->id)->count();
        // }

        // Menghitung rata-rata waktu per tindakan
        // $rataRataWaktu = [];
        // $tindakanTambahan = TindakanWaktu::where('status', 'Tambahan')->get();

        // foreach ($tindakanTambahan as $tindakan) {
        //     $laporanTindakan = $laporan->where('tindakan_id', $tindakan->id);
        //     $totalDurasi = $laporanTindakan->sum('durasi');
        //     $jumlahTindakan = $laporanTindakan->count();

        //     $rataRataWaktu[$tindakan->id] = $jumlahTindakan > 0 ? ($totalDurasi / $jumlahTindakan) / 60 : 0;
        // }

        // Menghitung standar workload (SWL)
        // $swl = [];
        // $jamTersediaPerTahun = 2000;
        // foreach ($rataRataWaktu as $tindakanId => $rataWaktu) {
        //     $swl[$tindakanId] = $rataWaktu > 0 ? $jamTersediaPerTahun / ($rataWaktu / 60) : 0;
        // }

        $tindakanTambahan = $laporan;
        $hospitalTime = $this->getHospitalWorkingHours();

        // dd($tindakanTambahan);

        // return view('admin.laporan.laporanhasil5', compact(
        //     'perawat', 'perawatTindakan', 'tindakanTambahan', 'laporan',
        //     'rataRataWaktu', 'swl', 'totalTindakan', 'tanggalAwal', 'tanggalAkhir'
        // ));
        return view('admin.laporan.laporanhasil5', compact(
            'tindakanTambahan',  'tanggalAwal', 'tanggalAkhir', 'hospitalTime'
        ));
    }


    public function index6(Request $request)
    {
        // Ambil semua user perawat untuk dropdown
        $users = LaporanTindakanPerawat::with('user')->get()->pluck('user')->unique('id');

        // Ambil user_id dari request jika ada (user yang dipilih)
        $selectedUserId = $request->input('user_id');

        // Ambil laporan berdasarkan user_id yang dipilih
        $laporan = LaporanTindakanPerawat::with(['tindakan'])
            ->when($selectedUserId, function ($query) use ($selectedUserId) {
                $query->where('user_id', $selectedUserId);
            })
            ->get();

        // Menghitung jumlah tindakan per jenis tindakan
        // $tindakanJumlah = $laporan->groupBy('tindakan_id')->map(function ($group) {
        //     return $group->count();
        // });

        // Menghitung rata-rata waktu dan SWL
        $rataRataWaktu = [];
        $swl = [];
        $jamTersediaPerTahun = 2000; // Jam kerja tersedia dalam setahun

        // foreach ($laporan->groupBy('tindakan_id') as $tindakanId => $laporanTindakan) {
        //     $totalDurasi = $laporanTindakan->sum('durasi'); // Total durasi dalam detik
        //     $jumlahTindakan = $laporanTindakan->count();

        //     // Hitung rata-rata waktu dalam jam
        //     if ($jumlahTindakan > 0) {
        //         $rataRataWaktu[$tindakanId] = $totalDurasi / $jumlahTindakan / 3600; // Konversi detik ke jam
        //     } else {
        //         $rataRataWaktu[$tindakanId] = 0;
        //     }

        //     // Hitung SWL
        //     if ($rataRataWaktu[$tindakanId] > 0) {
        //         $swl[$tindakanId] = $jamTersediaPerTahun / $rataRataWaktu[$tindakanId];
        //     } else {
        //         $swl[$tindakanId] = 0;
        //     }
        // }

        // group tindakan by status
        $tindakanGrouped = $laporan->groupBy('tindakan.status');

        $tindakanPokok = LaporanTindakanPerawat::with(['tindakan'])  
            ->when($selectedUserId, function ($query) use ($selectedUserId) {
                $query->where('user_id', $selectedUserId);
            })
            ->whereHas('tindakan', function ($q) {
                $q->where('status', 'Tugas Pokok');
            })->get();

        // dd($tindakanPokok);
        // Menghitung rata-rata waktu per tindakan
        $rataRataWaktu = [];
        $tindakanPokok = TindakanWaktu::where('status', 'Tugas Pokok')
            ->whereHas('laporanTindakan', function ($query) use ($selectedUserId) {
            if ($selectedUserId) {
                $query->where('user_id', $selectedUserId);
            }
            })
            ->with(['laporanTindakan' => function ($query) use ($selectedUserId) {
            if ($selectedUserId) {
                $query->where('user_id', $selectedUserId);
            }
            $query->with('user');
            }])
            ->get();

        foreach ($tindakanPokok as $tindakan) {
            $laporanTindakan = $laporan->where('tindakan_id', $tindakan->id);
            $totalDurasi = $laporanTindakan->sum('durasi');
            $jumlahTindakan = $laporanTindakan->count();

            $rataRataWaktu[$tindakan->id] = $jumlahTindakan > 0 ? ($totalDurasi / $jumlahTindakan) / 60 : 0;
        }

        return view('admin.laporan.laporanhasil6', compact('users', 'selectedUserId', 'rataRataWaktu', 'swl', 'laporan', 'tindakanGrouped', 'tindakanPokok'));
    }

    public function detailTindakan($tindakanId, $userId)
    {
        try {
            // Mengambil laporan berdasarkan tindakan_id dan user_id
            $laporan = LaporanTindakanPerawat::where('tindakan_id', $tindakanId)
                ->where('user_id', $userId)
                ->with('shift') // Pastikan relasi shift dimuat
                ->get();

            // Jika tidak ada data yang ditemukan
            if ($laporan->isEmpty()) {
                return response()->json(['message' => 'Tidak ada data untuk tindakan ini.'], 404);
            }

            // Memproses data laporan
            $data = $laporan->map(function ($item) {
                // Cek dan konversi jam_mulai dan jam_berhenti menjadi Carbon jika ada
                $jamMulai = $item->jam_mulai ? \Carbon\Carbon::parse($item->jam_mulai) : null;
                $jamBerhenti = $item->jam_berhenti ? \Carbon\Carbon::parse($item->jam_berhenti) : null;

                // Mengambil nama shift berdasarkan shift_id
                $shiftName = $item->shift ? $item->shift->nama_shift : 'Tidak Ada Shift'; // Pastikan nama shift sesuai dengan kolom 'nama_shift'

                // Mengembalikan data yang sudah diformat
                return [
                    'tanggal' => $jamBerhenti ? $jamBerhenti->format('Y-m-d') : '-',
                    'durasi' => $item->durasi ? round($item->durasi / 60, 2) . ' menit' : '0 menit',
                    'keterangan' => $item->keterangan ?? '-',
                    'shift' => $shiftName, // Mengirim nama shift
                    'jam_mulai' => $jamMulai ? $jamMulai->format('H:i:s') : '-',
                    'jam_berhenti' => $jamBerhenti ? $jamBerhenti->format('H:i:s') : '-',
                ];
            });

            // Mengembalikan response dengan data yang sudah diproses
            return response()->json($data, 200);
        } catch (\Exception $e) {
            // Menangani error dan menulisnya ke log
            Log::error('Error detailTindakan:', ['error' => $e->getMessage()]);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function analisaData($userId, Request $request) {
        try {
            $tanggalAwal = $request->query('tanggalAwal');
            $tanggalAkhir = $request->query('tanggalAkhir');
            $totalWaktuKerja = $request->query('totalWaktuKerja');

            $selectedUserId = $userId;

            $laporanQuery = LaporanTindakanPerawat::with(['tindakan'])
            ->when($selectedUserId, function ($query) use ($selectedUserId) {
                $query->where('user_id', $selectedUserId);
            });
            $laporanQueryPokok = LaporanTindakanPerawat::with(['tindakan'])
            ->when($selectedUserId, function ($query) use ($selectedUserId) {
                $query->where('user_id', $selectedUserId);
            });
            $laporanQueryTambahan = LaporanTindakanPerawat::with(['tindakan'])
            ->when($selectedUserId, function ($query) use ($selectedUserId) {
                $query->where('user_id', $selectedUserId);
            });

            // Query untuk mengambil laporan dengan status "Tugas Penunjang"
            $query = $laporanQuery
                ->whereHas('tindakan', function ($q) {
                    $q->where('status', 'Tugas Penunjang');
                });
            $queryPokok = $laporanQueryPokok
                ->whereHas('tindakan', function ($q) {
                    $q->where('status', 'Tugas Pokok');
                });
            $queryTambahan = $laporanQueryTambahan
                ->whereHas('tindakan', function ($q) {
                    $q->where('status', 'tambahan');
                });

            
            // Terapkan filter berdasarkan rentang tanggal jika tersedia
            if ($tanggalAwal && $tanggalAkhir) {
                $query->whereBetween('tanggal', [$tanggalAwal . " 00:00:00", $tanggalAkhir . " 23:59:59"]);
                $queryPokok->whereBetween('tanggal', [$tanggalAwal . " 00:00:00", $tanggalAkhir . " 23:59:59"]);
                $queryTambahan->whereBetween('tanggal', [$tanggalAwal . " 00:00:00", $tanggalAkhir . " 23:59:59"]);
            }

            // Ambil data laporan yang telah difilter
            $laporan = $query->get();
            $laporanPokok = $queryPokok->get();
            $laporanTambahan = $queryTambahan->get();

            // Ambil daftar perawat yang memiliki tindakan "Tugas Penunjang"
            $perawat = $laporan->pluck('user')->unique('id');
            $perawat = $laporanPokok->pluck('user')->unique('id');
            $perawat = $laporanTambahan->pluck('user')->unique('id');

            // Ambil daftar tindakan yang memiliki status "Tugas Penunjang"
            $tindakanPenunjang = $laporan->pluck('tindakan')->unique('id');
            $tindakanPokok = $laporanPokok;
            $tindakanTambahan = $laporanTambahan->pluck('tindakan')->unique('id');

            // Ambil data rumah sakit
            $hospitalTime = $this->getHospitalWorkingHours();

            

            // Hitung jumlah tindakan per tindakan dan per perawat
            $perawatTindakan = [];
            foreach ($perawat as $perawatItem) {
                foreach ($tindakanPenunjang as $tindakan) {
                    $perawatTindakan[$perawatItem->id][$tindakan->id] = $laporan
                        ->where('user_id', $perawatItem->id)
                        ->where('tindakan_id', $tindakan->id)
                        ->count();
                }
            }

            // Hitung total tindakan untuk setiap jenis tindakan
            $totalTindakan = [];
            foreach ($tindakanPenunjang as $tindakan) {
                $totalTindakan[$tindakan->id] = $laporan->where('tindakan_id', $tindakan->id) ? $laporan->where('tindakan_id', $tindakan->id)->count() : 0;
            }

            // Menghitung rata-rata waktu per tindakan
            $rataRataWaktu = [];
            $tindakanPenunjang = TindakanWaktu::where('status', 'Tugas Penunjang')->get();

            foreach ($tindakanPenunjang as $tindakan) {
                $laporanTindakan = $laporan->where('tindakan_id', $tindakan->id);
                $totalDurasi = $laporanTindakan->sum('durasi');
                $jumlahTindakan = $laporanTindakan->count();

                $rataRataWaktu[$tindakan->id] = $jumlahTindakan > 0 ? ($totalDurasi / $jumlahTindakan) / 60 : 0;
            }

            

            // Menghitung standar workload (SWL)
            $swl = [];
            $jamTersediaPerTahun = 2000;
            foreach ($rataRataWaktu as $tindakanId => $rataWaktu) {
                $swl[$tindakanId] = $rataWaktu > 0 ? $jamTersediaPerTahun / ($rataWaktu / 60) : 0;
            }


            // Mulai hitung AF
            $totalWaktu = 0;
            $totalFaktor = 0;
            foreach ($tindakanPenunjang as $tindakan) {
                // Menghitung waktu kegiatan dalam jam
                if ($tindakan->satuan == 'jam') {
                    $waktuJam = $tindakan->waktu; 
                } elseif ($tindakan->satuan == 'menit') {
                    $waktuJam = number_format($tindakan->waktu / 60, 2); 
                } elseif ($tindakan->satuan == 'hari') {
                    $waktuJam = number_format($tindakan->waktu * 24, 2); 
                } else {
                    $waktuJam = 0; // Jika satuan tidak dikenali
                }
                if($tindakan->satuan == 'jam') {
                    $totalWaktu = $tindakan->waktu * 1; 
                } elseif($tindakan->satuan == 'menit') {
                    $totalWaktu = $tindakan->waktu / 60; 
                } elseif($tindakan->satuan == 'hari') {
                    $totalWaktu = $tindakan->waktu * 24; 
                }
                if ($tindakan->kategori == 'harian') {
                    $totalWaktu = $totalWaktu * 264; // 264 hari kerja dalam setahun
                } elseif ($tindakan->kategori == 'mingguan') {
                    $totalWaktu = $totalWaktu * 52; // 52 minggu dalam setahun
                } elseif ($tindakan->kategori == 'bulanan') {
                    $totalWaktu = $totalWaktu * 12; // 12 bulan dalam setahun
                } elseif ($tindakan->kategori == 'tahunan') {
                    $totalWaktu = $totalWaktu; // Sudah dalam satuan tahunan
                }
                $faktor = $totalWaktu > 0 ? ($totalWaktu / $hospitalTime) * 100 : 0;
                $faktor = number_format($faktor, 2);
    
                $totalFaktor += $faktor;
            }

            

            
            // Menghitung rata-rata faktor
            $totalTindakanForFaktor = count($tindakanPenunjang);
            $averageFaktor = $totalTindakanForFaktor > 0 ? $totalFaktor / $totalTindakanForFaktor : 0;
            $averageFaktor = number_format($averageFaktor, 2);


            $hospitalTime = $this->getHospitalWorkingHours();
            $jamTersediaPerTahun = $hospitalTime; // Total jam kerja per tahun
            // Note: $tindakan is not available in this scope, removing problematic code
            // $rataWaktu = $tindakan->waktu > 0 ? ($tindakan->waktu / $tindakan->count()) : 0;
            // $swl = $rataWaktu > 0 ? $jamTersediaPerTahun / ($rataWaktu / 60) : 0;

            $AF = number_format(1 / (1 - ($averageFaktor/100)), 2);

            // $tindakanPokok = $laporanQuery
            //     ->whereHas('tindakan', function ($q) {
            //         $q->where('status', 'Tugas Pokok');
            //     })->whereBetween('tanggal', [$tanggalAwal . " 00:00:00", $tanggalAkhir . " 23:59:59"])->get();

            $totalHasil = 0;
            // Group tindakanPokok by tindakan_id
            $groupedTindakanPokok = $tindakanPokok->groupBy('tindakan_id');
            \Log::info($groupedTindakanPokok);

            $debugData = [];

            foreach ($groupedTindakanPokok as $tindakan) {
                $debugData[] = $tindakan->toArray(); // Collect data for debugging
                // Or for immediate output in web response (not terminal), use:
                // dump($tindakan);
                $totalJamTindakan = 0;
                foreach ($tindakan as $items) {
                    // $debugData[] = $items->toArray(); // Collect data for debugging
                    
                    $mulai = \Carbon\Carbon::parse($items->jam_mulai);
                    $berhenti = \Carbon\Carbon::parse($items->jam_berhenti);
                    $totalJamTindakan += $mulai->floatDiffInHours($berhenti);
                }
                $frequency = $tindakan->count();

                // Hitung frekuensi (jumlah laporan) untuk tindakan ini

                // Anda bisa menggunakan $frequency sesuai kebutuhan, misal log/debug:
                // Log::info("Tindakan ID {$tindakan->id} frekuensi: {$frequency}");

                $totalHasil += number_format(($totalJamTindakan * $frequency), 2);
            }

            

            // $tindakanTambahan = $laporanQuery
            //     ->whereHas('tindakan', function ($q) {
            //         $q->where('status', 'tambahan');
            //     })->whereBetween('tanggal', [$tanggalAwal . " 00:00:00", $tanggalAkhir . " 23:59:59"])->get();
            $totalTindakan = [];
            $totalWaktuTambahan = 0;
            foreach ($tindakanTambahan as $tindakan) {
                // Karena $tindakan sudah hanya untuk satu user, cukup rekap per tindakan saja
                $namaTindakan = $tindakan->tindakan->tindakan ?? 'Tidak Ada Data';
                $durasi = $tindakan->durasi ?? 0;

                if (!isset($totalTindakan[$namaTindakan])) {
                    $totalTindakan[$namaTindakan] = [
                        'frequency' => 0,
                        'durasi' => 0
                    ];
                }
                $totalTindakan[$namaTindakan]['frequency']++;
                $totalTindakan[$namaTindakan]['durasi'] += $durasi;

                // Hitung total waktu per tindakan tambahan
                
                foreach ($totalTindakan as $tindakanData) {
                    $totalWaktuTambahan += $tindakanData['durasi'];
                }
            }

            $IAF = $totalWaktuTambahan / $hospitalTime; // Menghitung IAF (Indeks Aktivitas Fungsional)



            $result = (($totalHasil * $AF) / $hospitalTime) + $IAF;

            $data = [
                'laporan' => $laporan,
                'perawat' => $perawat,
                'tindakanPokok' => $tindakanPokok,
                'tindakanPenunjang' => $tindakanPenunjang,
                'tindakanTambahan' => $tindakanTambahan,
                'rataRataWaktu' => $rataRataWaktu,
                'swl' => $swl,
                'totalTindakan' => $totalTindakan,
                'tanggalAwal' => $tanggalAwal,
                'tanggalAkhir' => $tanggalAkhir,
                'hospitalTime' => $hospitalTime,
                'averageFaktor' => $averageFaktor,
                'totalHasil' => $totalHasil,
                'laporanPokok' => $laporanPokok,
                'laporanTambahan' => $laporanTambahan,
                'queryTambahan' => $queryTambahan,
                'AF' => $AF,
                'IAF' => $IAF,
                'result' => $result,
                'debug' => $debugData,
            ];

            // Buat record baru
            $record = RecordAnalisaData::updateOrCreate(
                ['user_id' => $selectedUserId],
                [
                    'tanggal_awal' => $tanggalAwal,
                    'tanggal_akhir' => $tanggalAkhir,
                    'total_waktu_kerja' => $totalWaktuKerja,
                    'beban_kerja' => $result,
                ]
            );

            // Update laporan tindakan perawat dengan record_analisa_data_id
            if ($tindakanPokok->isNotEmpty()) {
                LaporanTindakanPerawat::whereIn('id', $tindakanPokok->pluck('id'))
                    ->update(['record_analisa_data_id' => $record->id]);
            }

            return response()->json($data, 200);
        } catch (\Exception $e) {
            // Menangani error dan menulisnya ke log
            Log::error('Error detailTindakan:', ['error' => $e->getMessage()]);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
