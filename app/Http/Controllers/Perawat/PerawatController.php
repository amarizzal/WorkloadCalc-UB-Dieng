<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
use App\Models\TindakanWaktu;
use App\Models\ShiftKerja;
use Carbon\Carbon;
use App\Models\LaporanTindakanPerawat;
use App\Models\RecordAnalisaData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PerawatController extends Controller
{
    public function home()
    {
        return view('pages.perawat.home');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function showUbahPasswordForm()
    {
        return view('perawat.layouts.home.ubahpassword');
    }

    public function ubahPassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // Laravel automatically checks 'new_password_confirmation'
        ]);

        $user = auth()->user();

        if (!$user) {
            return back()->withErrors(['error' => 'User tidak terautentikasi.']);
        }

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        // Remove manual hashing here since it's handled by the model's mutator
        $user->password = $request->new_password; // Set the new password directly

        try {
            /** @var \App\Models\User $user **/
            $user->save(); // Save the changes
            return redirect()->route('perawat.home')->with('success', 'Password berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan perubahan password.']);
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function panduan()
    {
        return view('pages.perawat.perawat-panduan');
    }

    public function pengaturan()
    {
        return view('perawat.layouts.home.pengaturan');
    }

    public function keamananPrivasi()
    {
        return view('pages.perawat.perawat-keamanan');
    }

    public function tentangKami()
    {
        return view('pages.perawat.perawat-tentang');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////

   
    /////////////////////////////////////////////////////////////////////////////////////////////
    public function timer()
    {
        $tindakanWaktu = TindakanWaktu::all();
        $now = Carbon::now('Asia/Jakarta');

        // Cari shift kerja yang sesuai dengan waktu sekarang
        $currentShift = ShiftKerja::query()
        ->where(function ($query) use ($now) {
            $query->whereTime('jam_mulai', '<=', $now->toTimeString())
                ->whereTime('jam_selesai', '>=', $now->toTimeString());
        })
        ->orWhere(function ($query) use ($now) {
            $query->whereTime('jam_mulai', '>', 'jam_selesai')
                ->where(function ($sub) use ($now) {
                    $sub->whereTime('jam_mulai', '<=', $now->toTimeString())
                        ->orWhereTime('jam_selesai', '>=', $now->toTimeString());
                });
        })
        ->orderBy('jam_mulai', 'desc')
        ->first();


        $shiftName = $currentShift->nama_shift ?? 'Tidak Ada Shift Aktif';
        $shiftId = $currentShift->id ?? null;
        $currentTime = $now->format('H:i');

        $laporanAktif = LaporanTindakanPerawat::where('user_id', auth()->user()->id)
            ->whereNull('jam_berhenti')
            ->first();

        $sisaWaktu = 0;
        $isTimerRunning = false;

        if ($laporanAktif) {
            $tindakan = $laporanAktif->tindakan;
            $elapsedTime = Carbon::now()->diffInSeconds(Carbon::parse($laporanAktif->jam_mulai));
            $totalTime = $tindakan->waktu * 60;

            if ($elapsedTime < $totalTime) {
                $isTimerRunning = true;
                $sisaWaktu = $totalTime - $elapsedTime;
            }
        }

        return view('pages.perawat.perawat-pokok', compact('shiftName', 'shiftId', 'tindakanWaktu', 'currentTime', 'laporanAktif', 'sisaWaktu', 'isTimerRunning'));
    }

    public function stopAction(Request $request)
    {
        $validated = $request->validate([
            'tindakan_id' => 'required|exists:tindakan_waktu,id',
            'shift_id' => 'required|exists:shift_kerja,id',
            'jam_mulai' => 'required|date',
            'jam_berhenti' => 'required|date',
            'no_rekam_medis' => 'required|string',
            'nama_pasien' => 'required|string',
        ]);

        $jamMulai = Carbon::parse($validated['jam_mulai']);
        $jamBerhenti = Carbon::parse($validated['jam_berhenti']);
        $durasi = $jamMulai->diffInSeconds($jamBerhenti);

        $laporan = LaporanTindakanPerawat::create([
            'user_id' => auth()->id(),
            'ruangan_id' => auth()->user()->ruangan_id,
            'shift_id' => $validated['shift_id'],
            'tindakan_id' => $validated['tindakan_id'],
            'tanggal' => Carbon::now()->toDateString(),
            'jam_mulai' => $jamMulai,
            'jam_berhenti' => $jamBerhenti,
            'no_rekam_medis' => $validated['no_rekam_medis'],
            'nama_pasien' => $validated['nama_pasien'],
            'durasi' => $durasi,
        ]);

        return response()->json([
            'status' => 'success',
            'laporan_id' => $laporan->id,
            'jam_mulai' => $laporan->jam_mulai->format('H:i:s'),
            'jam_berhenti' => $laporan->jam_berhenti->format('H:i:s'),
            'durasi' => $laporan->durasi,
        ]);
    }


    // public function startAction(Request $request)
    // {
    //     $validated = $request->validate([
    //         'tindakan_id' => 'required|exists:tindakan_waktu,id',
    //         'shift_id' => 'required|exists:shift_kerja,id',
    //     ]);

    //     $laporan = LaporanTindakanPerawat::create([
    //         'user_id' => auth()->user()->id,
    //         'ruangan_id' => auth()->user()->ruangan_id,
    //         'shift_id' => $validated['shift_id'],
    //         'tindakan_id' => $validated['tindakan_id'],
    //         'tanggal' => Carbon::now()->toDateString(),
    //         'jam_mulai' => Carbon::now(),
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Timer dimulai',
    //         'laporan_id' => $laporan->id,
    //         'jam_mulai' => $laporan->jam_mulai->toIso8601String(),
    //         'durasi_tindakan' => $laporan->tindakan->waktu * 60,
    //     ]);
    // }
    // public function stopAction($id)
    // {
    //     // Cari laporan berdasarkan ID
    //     $laporan = LaporanTindakanPerawat::findOrFail($id);

    //     // Ambil waktu saat tombol stop diklik
    //     $jamBerhenti = Carbon::now(); // Waktu saat tombol stop diklik

    //     // Pastikan jam_mulai ada dan valid
    //     if (!$laporan->jam_mulai) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Jam mulai tidak ditemukan.',
    //         ]);
    //     }

    //     // Hitung durasi dalam detik (selisih antara jam_berhenti dan jam_mulai)
    //     $durasi = Carbon::parse($laporan->jam_mulai)->diffInSeconds($jamBerhenti);

    //     // Update data jam_berhenti dan durasi di database
    //     $laporan->update([
    //         'jam_berhenti' => $jamBerhenti, // Simpan waktu berhenti
    //         'durasi' => $durasi, // Simpan durasi dalam detik
    //     ]);

    //     return response()->json([
    //         'status' => 'success',
    //         'jam_berhenti' => $laporan->jam_berhenti->format('H:i:s'), // Format jam berhenti
    //         'durasi' => $laporan->durasi, // Durasi dalam detik
    //     ]);
    // }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function hasil(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();
    
        // Ambil tanggal mulai dan tanggal akhir dari request atau default ke hari ini
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Pastikan endDate lebih besar atau sama dengan startDate
        if ($startDate > $endDate) {
            return redirect()->back()->with('error', 'Tanggal mulai tidak boleh lebih besar dari tanggal akhir.');
        }
    
        // Ambil laporan berdasarkan user_id dan rentang tanggal yang dipilih
        $laporan = LaporanTindakanPerawat::with(['tindakan', 'shift'])
            ->where('user_id', $user->id)->orderBy('tanggal', 'desc');

        if ($startDate && $endDate) {
            $laporan->whereBetween('jam_berhenti', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']) // Filter berdasarkan rentang tanggal
            ->orderBy('jam_berhenti', 'desc');
        }

        $laporan = $laporan->get();

        // get record analisa data by user_id
        $recordAnalisa = RecordAnalisaData::where('user_id', $user->id)
            ->first();


        return view('pages.perawat.perawat-hasil', compact('laporan', 'startDate', 'endDate', 'recordAnalisa'));
    }
    
    public function storeKeterangan(Request $request, $id)
    {
        // Validasi input keterangan
        $request->validate([
            'keterangan' => 'required|string|max:255',
        ]);

        // Cari laporan berdasarkan ID dan simpan keterangan
        $laporan = LaporanTindakanPerawat::findOrFail($id);
        $laporan->keterangan = $request->keterangan;
        $laporan->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('perawat.hasil')->with('success', 'Keterangan berhasil ditambahkan!');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function storeTindakanLain(Request $request)
    {
        $user = Auth::user();
        $ruanganId = $user->ruangan_id;
    
        if (!$ruanganId) {
            session()->flash('error', 'Ruangan belum terhubung dengan akun Anda.');
            return redirect()->back();
        }
    
        // REMOVE
        $jamMulaiInput = Carbon::now()->format('H:i'); // Ambil jam mulai saat ini
        $shiftId = $this->getShiftByJamMulai($jamMulaiInput);
    
        if (!$shiftId) {
            session()->flash('error', 'Shift tidak ditemukan untuk waktu sekarang.');
            return redirect()->back();
        }
    
        // Periksa apakah tindakan sudah ada di database atau merupakan tindakan baru
        $tindakan = TindakanWaktu::where('tindakan', $request->jenis_tindakan)->first();
    
        if (!$tindakan) {
            // Jika tindakan belum ada, buat yang baru dengan waktu = 0 dan status = Tugas Penunjang
            $tindakan = TindakanWaktu::create([
                'tindakan' => $request->jenis_tindakan,
                'waktu' => $request->waktu, // Waktu default 0 jika tidak diisi
                'status' => 'Tugas Penunjang',
                'satuan' => $request->satuan, 
                'kategori' => $request->kategori 
            ]);
        } else {
            // Jika tindakan sudah ada, gunakan ID tindakan yang sudah ada
            $tindakan->waktu = $request->waktu + $tindakan->waktu; // Update waktu jika diperlukan
            if ($tindakan->satuan == null) {
                $tindakan->satuan = $request->satuan; 
            }
            if ($tindakan->kategori == null) {
                $tindakan->kategori = $request->kategori; 
            }
            $tindakan->save(); // Simpan perubahan
        }
    
        // Simpan laporan tindakan
        LaporanTindakanPerawat::create([
            'user_id' => $user->id,
            'ruangan_id' => $ruanganId,
            'shift_id' => $shiftId,
            'tindakan_id' => $tindakan->id,
            'tanggal' => $request->input('tanggal'),
            'jam_mulai' => Carbon::parse($request->input('tanggal') . ' ' . $request->input('jam_mulai')),
            'jam_berhenti' => Carbon::parse($request->input('tanggal') . ' ' . $request->input('jam_berhenti')),
            'durasi' => $request->waktu,
            'keterangan' => $request->input('keterangan'),
            'jenis_tindakan' => $tindakan->tindakan
        ]);
    
        session()->flash('success', 'Tindakan berhasil ditambahkan.');
        return redirect()->route('perawat.hasil');
    }
    
    
    
    public function tindakan()
    {
        $jenisTindakan = TindakanWaktu::where('status', 'Tugas Penunjang')->get();

        
        return view('pages.perawat.perawat-penunjang', compact('jenisTindakan'));
    }
    
    public function tindakanTambahan()
    {
        $jenisTindakan = TindakanWaktu::where('status', 'tambahan')->get();

        return view('pages.perawat.perawat-tambahan', compact('jenisTindakan'));
    }
    

    public function getShiftByJamMulai($jamMulai)
    {
        $shift = ShiftKerja::where(function ($query) use ($jamMulai) {
                // Shift normal: jam_mulai <= jamMasuk <= jam_selesai
                $query->where('jam_mulai', '<=', $jamMulai)
                    ->where('jam_selesai', '>=', $jamMulai);
            })
            ->orWhere(function ($query) use ($jamMulai) {
                // Shift yang melewati tengah malam: jam_mulai > jam_selesai
                $query->whereColumn('jam_mulai', '>', 'jam_selesai')
                    ->where(function ($sub) use ($jamMulai) {
                        $sub->where('jam_mulai', '<=', $jamMulai) // masih di hari yang sama
                            ->orWhere('jam_selesai', '>=', $jamMulai); // sudah lewat midnight
                    });
            })
            ->first();

        return $shift ? $shift->id : null;
    }

    public function getTindakanIdLainLain()
    {
        // Ambil ID tindakan 'Lain-Lain' dari tabel tindakan_waktu
        $tindakan = TindakanWaktu::where('tindakan', 'Lain-Lain')->first();

        return $tindakan ? $tindakan->id : null;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function storeTindakanTambahan(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login
        $ruanganId = $user->ruangan_id; // Ambil ruangan_id dari user

    
        if (!$ruanganId) {
            session()->flash('error', 'Ruangan belum terhubung dengan akun Anda.');
            return redirect()->back();
        }

        // Ambil waktu yang diinputkan
        $waktu = $request->input('waktu');

        // Gunakan getShiftByJamMulai untuk mendapatkan shift berdasarkan jam_mulai yang dimasukkan
        $jamMulaiInput = Carbon::now()->format('H:i'); // Ambil jam mulai saat ini
        $shiftId = $this->getShiftByJamMulai($jamMulaiInput);
    
        // Pastikan shift ditemukan
        if (!$shiftId) {
            session()->flash('error', 'Shift tidak ditemukan untuk waktu sekarang.');
            return redirect()->back();
        }
    
        // Periksa apakah tindakan sudah ada di database atau merupakan tindakan baru
        $tindakan = TindakanWaktu::where(['tindakan' => $request->jenis_tindakan, 'status' => 'tambahan'])->first();

        if (!$tindakan) {
            // Jika tindakan belum ada, buat yang baru dengan waktu = 0 dan status = Tugas Tambahan
            $tindakan = TindakanWaktu::create([
                'tindakan' => $request->jenis_tindakan,
                'waktu' => $request->waktu, // Waktu default 0 jika tidak diisi
                'status' => 'tambahan'
            ]);
        } else {
            // Jika tindakan sudah ada, gunakan ID tindakan yang sudah ada
            $tindakan->waktu = $request->waktu + $tindakan->waktu; // Update waktu jika diperlukan
            $tindakan->save(); // Simpan perubahan
        }
    
        // Menambahkan tanggal pada jam_mulai dan jam_berhenti
        // $tanggal = $request->input('tanggal');
        // $jamMulai = Carbon::parse($tanggal . ' ' . $request->input('jam_mulai') . ':00');
        // $jamBerhenti = Carbon::parse($tanggal . ' ' . $request->input('jam_berhenti') . ':00');
    
        $durasi = 0; // Hitung durasi dalam detik

        // dd($user);
    
        // Simpan data ke dalam database
        // check if LaporanTindakanPerawat truly created
        if (!$user) {
            session()->flash('error', 'User tidak ditemukan.');
            return redirect()->back();
        }
        LaporanTindakanPerawat::create([
            'user_id' => $user->id,
            'ruangan_id' => $ruanganId,
            'shift_id' => $shiftId, // Gunakan shift yang ditemukan
            'tindakan_id' => $tindakan->id, // Selalu menggunakan tindakan ID 40
            'tanggal' => $request->input('tanggal'),
            'durasi' => $waktu,
            'keterangan' => $request->input('keterangan'),
        ]);
    
        session()->flash('success', 'Tindakan tambahan berhasil ditambahkan.');
        return redirect()->route('perawat.hasil');
    }

    public function storeTindakanPokok(Request $request)
    {
        
        $validated = $request->validate([
            'tindakan_id' => 'required|exists:tindakan_waktu,id',
            'no_rekam_medis' => 'required|string',
            'nama_pasien' => 'required|string',
            // 'shift_id' => 'required|exists:shift_kerja,id',
        ]);

        

        // Ambil waktu yang diinputkan
        // $waktu = $request->input('waktu');

        // Gunakan getShiftByJamMulai untuk mendapatkan shift berdasarkan jam_mulai yang dimasukkan
        $jamMulaiInput = Carbon::parse($request->input('jam_mulai'))->format('H:i'); // Ambil jam mulai saat ini
        $shiftId = $this->getShiftByJamMulai($jamMulaiInput);
    
        // Pastikan shift ditemukan
        if (!$shiftId) {
            session()->flash('error', 'Shift tidak ditemukan untuk waktu sekarang.');
            dd('Shift tidak ditemukan untuk waktu sekarang.');
            return redirect()->back();
        }
    
    
        // Menambahkan tanggal pada jam_mulai dan jam_berhenti
        $tanggal = $request->input('tanggal');
        $jamMulai = Carbon::parse($tanggal . ' ' . $request->input('jam_mulai') . ':00');
        $jamBerhenti = Carbon::parse($tanggal . ' ' . $request->input('jam_berhenti') . ':00');
    
        // Hitung durasi dalam detik (selisih antara jam_berhenti dan jam_mulai)
        $durasi = Carbon::parse($jamMulai)->diffInSeconds($jamBerhenti);

        $laporan = LaporanTindakanPerawat::create([
            'user_id' => auth()->user()->id,
            'ruangan_id' => auth()->user()->ruangan_id,
            'shift_id' => $shiftId,
            'tindakan_id' => $validated['tindakan_id'],
            'tanggal' => $tanggal,
            'jam_mulai' => $jamMulai,
            'jam_berhenti' => $jamBerhenti,
            'no_rekam_medis' => $validated['no_rekam_medis'],
            'nama_pasien' => $validated['nama_pasien'],
            'durasi' => $durasi,
        ]);
    
        session()->flash('success', 'Tindakan tambahan berhasil ditambahkan.');
        return redirect()->route('perawat.hasil');
    }

    public function getTindakanIdTambahan()
    {
        // Ambil ID tindakan 'Tambahan' dari tabel tindakan_waktu
        $tindakan = TindakanWaktu::where('tindakan', 'Tambahan')->first();

        return $tindakan ? $tindakan->id : null;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Menampilkan halaman profil
    public function profil()
    {
        return view('pages.perawat.perawat-profil');
    }

    // Menampilkan halaman profil
    public function profilEdit()
    {
        return view('pages.perawat.perawat-profil-edit');
    }

    // Menampilkan halaman profil
    public function profilEditStore()
    {
        $user = Auth::user();

        // Validasi input
        request()->validate([
            'nama_lengkap' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'nomor_telepon' => 'nullable|string|max:15',
            'tanggal_lahir' => 'nullable|date',
            'lama_bekerja' => 'nullable|numeric',
            'posisi' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Update data user
        $user->update([
            'nama_lengkap' => request('nama_lengkap'),
            'email' => request('email'),
            'nomor_telepon' => request('nomor_telepon'),
            'tanggal_lahir' => Carbon::parse(request('tanggal_lahir'))->toDateString(),
            'lama_bekerja' => request('lama_bekerja'),
            'posisi' => request('posisi'),
            'pendidikan' => request('pendidikan'),
            'level' => request('level'),
            'status' => request('status'),
        ]);

        // Jika password diisi, update password
        if (request('password')) {
            $user->password = Hash::make(request('password'));
            $user->save();
        }

        // sotre foto jika ada
        if (request()->hasFile('foto')) {
            $foto = request()->file('foto');
            $fotoPath = $foto->storeAs('user_photos', $user->id . '.' . $foto->getClientOriginalExtension(), 'public');
            $user->foto = $fotoPath; // simpan 'user_photos/12.jpg'
            $user->save();
        }

        session()->flash('success', 'Profil berhasil diperbarui.');
        // Redirect ke halaman profil
        return redirect()->route('perawat.profil');
    }

    // Menampilkan halaman profil
    public function profilPassword()
    {
        return view('pages.perawat.perawat-password');
    }

    // Menampilkan halaman profil
    public function profilPasswordStore()
    {
        $user = Auth::user();

        // Validasi input
        request()->validate([
            'password' => 'required|string|max:255',
            'password_confirmation' => 'required|string|max:255|same:password',
        ]);

        // Update data user
        $user->update([
            'password' => request('password'),
        ]);


        session()->flash('success', 'Password berhasil diperbarui.');
        // Redirect ke halaman profil
        return redirect()->route('perawat.profil');
    }
}
