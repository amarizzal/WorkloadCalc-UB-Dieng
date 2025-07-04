<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  // Import Controller di sini
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TindakanWaktu;
use App\Models\Ruangan;
use App\Models\ShiftKerja;


class MasterController extends Controller
{
   public function masterUser()
{
    $users = User::with(['jenisKelamin', 'ruangan'])->get();  // Eager load relasi jenisKelamin dan ruangan
    return view('admin.master.masteruser', compact('users'));
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

public function masterTindakan()
{
    // Mengambil semua data tindakan dan waktu
    $tindakanWaktu = TindakanWaktu::all();
    
    return view('admin.master.mastertindakan', compact('tindakanWaktu'));
}

public function storeTindakan(Request $request)
{
    // Validasi inputan yang diterima dari form
    $request->validate([
        'tindakan' => 'required|string|max:255', // Pastikan kolom tindakan ada dan berupa string
        'waktu' => 'required|integer|min:1',
        'status' => 'required|string',     // Pastikan kolom waktu ada dan merupakan angka positif
    ]);

    // Menyimpan data Tindakan dan Waktu ke database
    TindakanWaktu::create([
        'tindakan' => $request->tindakan,   // Menyimpan data tindakan dari form
        'waktu' => $request->waktu,
        'status' => $request->status,         // Menyimpan data waktu dari form
    ]);

    // Mengarahkan kembali ke halaman master tindakan dengan pesan sukses
    return redirect()->route('admin.master-tindakan')->with('success', 'Tindakan dan Waktu berhasil ditambahkan.');
}

// Fungsi untuk menghapus data tindakan berdasarkan ID
public function deleteTindakan($id)
{
    // Mencari data tindakan berdasarkan ID
    $tindakan = TindakanWaktu::find($id);

    // Jika data ditemukan, hapus
    if ($tindakan) {
        $tindakan->delete(); // Hapus data
        return redirect()->route('admin.master-tindakan')->with('success', 'Tindakan berhasil dihapus.');
    }

    // Jika data tidak ditemukan, kirim pesan error
    return redirect()->route('admin.master-tindakan')->with('error', 'Tindakan tidak ditemukan.');
}

// Fungsi untuk menampilkan form edit data tindakan
public function editTindakan($id)
{
    // Mencari data tindakan berdasarkan ID
    $tindakan = TindakanWaktu::find($id);

    // Jika data ditemukan, tampilkan form edit dengan data tersebut
    if ($tindakan) {
        return view('admin.master.editTindakan', compact('tindakan')); // Arahkan ke form edit
    }

    // Jika data tidak ditemukan, kirim pesan error
    return redirect()->route('admin.master-tindakan')->with('error', 'Tindakan tidak ditemukan.');
}

// Fungsi untuk memperbarui data tindakan yang sudah ada
public function updateTindakan(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'tindakan' => 'required|string|max:255',
        'waktu' => 'required|integer|min:1',
        'status' => 'required|string',
    ]);

    // Mencari data tindakan berdasarkan ID
    $tindakan = TindakanWaktu::find($id);

    // Jika data ditemukan, update dengan data baru
    if ($tindakan) {
        $tindakan->update([
            'tindakan' => $request->tindakan,
            'waktu' => $request->waktu,
            'status' => $request->status,
        ]);

        // Redirect ke halaman master tindakan setelah berhasil diperbarui
        return redirect()->route('admin.master-tindakan')->with('success', 'Tindakan berhasil diperbarui.');
    }

    // Jika data tidak ditemukan, kirim pesan error
    return redirect()->route('admin.master-tindakan')->with('error', 'Tindakan tidak ditemukan.');
}




////////////////////////////////////////////////////////////////////////////////////////////////////////////



    public function masterShiftKerja()
    {
        // Ambil data shift kerja dari database untuk ditampilkan di tabel
        $shiftKerja = ShiftKerja::all();
        
        return view('admin.master.mastershiftkerja', compact('shiftKerja'));
    }
    public function storeShiftKerja(Request $request)
    {
        // Validasi request data jika perlu
        $request->validate([
            'nama_shift' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
        ]);
    
        // Menyimpan data shift kerja
        $shift = ShiftKerja::create([
            'nama_shift' => $request->nama_shift,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);
    
        // dd untuk memastikan data tersimpan
      
        // Redirect kembali ke halaman master shift dengan pesan sukses
        return redirect()->route('admin.master-shiftkerja')
            ->with('success', 'Shift Kerja berhasil ditambahkan');
    }
    
    


public function deleteShiftKerja($id)
{
    // Cari shift kerja berdasarkan ID
    $shiftKerja = ShiftKerja::findOrFail($id);

    // Hapus shift kerja
    $shiftKerja->delete();

    // Memberikan pesan sukses setelah penghapusan
    return redirect()->route('admin.master-shiftkerja')->with('success', 'Shift Kerja berhasil dihapus!');
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Menampilkan view master work status
    public function masterWorkStatus()
    {
        return view('admin.master.masterworkstatus');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Menampilkan view master ruangan
    public function masterRuangan()
{
    $ruangan = Ruangan::all();  // Ambil semua data ruangan
    return view('admin.master.masterruangan', compact('ruangan'));  // Kirim data ke view
}

public function storeRuangan(Request $request)
{
    $request->validate([
        'nama_ruangan' => 'required|string|max:255',
    ]);

    Ruangan::create([
        'nama_ruangan' => $request->nama_ruangan,
    ]);

    return redirect()->route('admin.master-ruangan')->with('success', 'Ruangan berhasil ditambahkan!');
}

public function deleteRuangan($id)
{
    $ruangan = Ruangan::find($id);

    if ($ruangan) {
        $ruangan->delete();
        return redirect()->route('admin.master-ruangan')->with('success', 'Ruangan berhasil dihapus!');
    }

    return redirect()->route('admin.master-ruangan')->with('error', 'Ruangan tidak ditemukan!');
}

 /////////////////////////////////////////////////////////////////////////////////////////////////////////



    // Menampilkan view master keamanan privasi
    public function masterKeamananPrivasi()
    {
        return view('admin.master.masterkeamananprivasi');
    }

    // Menampilkan view master panduan
    public function masterPanduan()
    {
        return view('admin.master.masterpanduan');
    }
}
