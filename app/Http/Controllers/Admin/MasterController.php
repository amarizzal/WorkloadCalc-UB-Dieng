<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  // Import Controller di sini
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TindakanWaktu;
use App\Models\Ruangan;
use App\Models\ShiftKerja;
use App\Models\JenisKelamin; // Pastikan model JenisKelamin sudah di-import
use Carbon\Carbon;
use App\Exports\UserTemplateExport;  // Import UserTemplateExport
// Pastikan model yang digunakan sudah di-import
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class MasterController extends Controller
{
   public function masterUser()
{
    $users = User::with(['jenisKelamin', 'ruangan'])->get();  // Eager load relasi jenisKelamin dan ruangan
    $jenisKelamin = JenisKelamin::all(); // Ambil jenis kelamin yang unik
    $ruangan = Ruangan::all(); // Ambil semua data ruangan
    return view('pages.master-user', compact('users', 'jenisKelamin', 'ruangan'));
}

   public function masterUserStore(Request $request)
{
    // Validasi input
    request()->validate([
        'role' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'password' => 'required|string|max:255',
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'nomor_telepon' => 'required|string|max:15',
        'jenis_kelamin_id' => 'required|int|max:15',
        'ruangan_id' => 'required|int|max:15',
        'tanggal_lahir' => 'required|date',
        'lama_bekerja' => 'required|numeric',
        'posisi' => 'required|string|max:255',
        'pendidikan' => 'required|string|max:255',
        'level' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'foto' => 'required|image|max:2048',
    ]);

    // create data user
    $user = User::create([
        'role' => request('role'),
        'nama_lengkap' => request('nama_lengkap'),
        'password' => bcrypt(request('password')),
        'username' => request('username'),
        'email' => request('email'),
        'ruangan_id' => request('ruangan_id'),
        'jenis_kelamin_id' => request('jenis_kelamin_id'),
        'nomor_telepon' => request('nomor_telepon'),
        'tanggal_lahir' => Carbon::parse(request('tanggal_lahir'))->toDateString(),
        'lama_bekerja' => request('lama_bekerja'),
        'posisi' => request('posisi'),
        'pendidikan' => request('pendidikan'),
        'level' => request('level'),
        'status' => request('status'),
    ]);


    // sotre foto jika ada
    if (request()->hasFile('foto')) {
        $foto = request()->file('foto');
        $fotoPath = $foto->storeAs('user_photos', $user->id . '.' . $foto->getClientOriginalExtension(), 'public');
        $user->foto = $fotoPath; // simpan 'user_photos/12.jpg'
        $user->save();
    }

    session()->flash('success', 'User berhasil dibuat.');
    // Redirect ke halaman profil
    return back()->with('success', 'Users imported successfully!');
}

public function deleteUser($id)
{
    $user = User::find($id);

    if ($user) {
        $user->delete();
        return redirect()->route('admin.master-user')->with('success', 'User berhasil dihapus!');
    }

    return redirect()->route('admin.master-user')->with('error', 'User tidak ditemukan!');
}

   public function masterUserImport(Request $request)
{
    // Validasi file
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('excel');

        // Baca file Excel
        $data = Excel::toArray([], $file);

        // Ambil sheet pertama
        $rows = $data[0];

        // Lewati header (asumsi baris pertama adalah header)
        foreach (array_slice($rows, 1) as $index => $row) {
            if (!isset($row[2])) continue; // pastikan ada kolom username

            // Validasi username unik
            if (User::where('username', $row[2])->exists()) {
                return back()->withErrors([
                    "Excel row " . ($index + 2) . ": username '{$row[2]}' already exists."
                ]);
            }

            // get jenis_kelamin_id dan ruangan_id
            $jenisKelamin = JenisKelamin::where('nama', $row[6])->first();
            $ruangan = Ruangan::where('nama_ruangan', $row[5])->first();

            if (!$jenisKelamin || !$ruangan) {
                return back()->withErrors([
                    "Excel row " . ($index + 2) . ": Invalid jenis_kelamin or ruangan."
                ]);
            }


            // Buat user
            User::create([
                'role' => $row[0],
                'nama_lengkap' => $row[1],
                'username' => $row[2],
                'email' => $row[3],
                'password' => $row[4],
                'ruangan_id' => $ruangan->id,
                'jenis_kelamin_id' => $jenisKelamin->id,
                'nomor_telepon' => $row[7],
                'tanggal_lahir' => Carbon::parse($row[8])->toDateString(),
                'lama_bekerja' => $row[9],
                'posisi' => $row[10],
                'pendidikan' => $row[11],
                'level' => $row[12],
                'status' => $row[13],
            ]);
        }

        return back()->with('success', 'Users imported successfully!');

}

// Export template
    public function downloadTemplate()
    {
        return Excel::download(new UserTemplateExport, 'template_users.xlsx');
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////

public function masterTindakan()
{
    // Mengambil semua data tindakan dan waktu
    $tindakanWaktu = TindakanWaktu::all();
    
    return view('pages.master-tindakan', compact('tindakanWaktu'));
}

public function storeTindakan(Request $request)
{
    // Validasi inputan yang diterima dari form
    $request->validate([
        'tindakan' => 'required|string|max:255', // Pastikan kolom tindakan ada dan berupa string
        'status' => 'required|string',     // Pastikan kolom waktu ada dan merupakan angka positif
    ]);

    // Menyimpan data Tindakan dan Waktu ke database
    TindakanWaktu::create([
        'tindakan' => $request->tindakan,   // Menyimpan data tindakan dari form
        'status' => $request->status,         // Menyimpan data waktu dari form
        'waktu' => 0,           
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
        
        return view('pages.master-shift', compact('shiftKerja'));
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
    return view('pages.master-ruangan', compact('ruangan'));  // Kirim data ke view
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
        return view('pages.master-keamanan');
    }

    // Menampilkan view master panduan
    public function masterPanduan()
    {
        return view('pages.master-panduan');
    }
}
