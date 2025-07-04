<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\JenisKelamin;
use App\Models\Ruangan;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            // Email tidak terdaftar
            return redirect()->route('login')->withErrors([
                'email' => 'Email ini tidak terdaftar di sistem kami.',
            ]);
        }

        // Cek apakah password benar
        if (!Hash::check($request->password, $user->password)) {
            // Password salah
            return redirect()->route('login')->withErrors([
                'password' => 'Password yang Anda masukkan salah.',
            ]);
        }

        // Jika email dan password benar, coba login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Cek role pengguna dan arahkan ke dashboard yang sesuai
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('perawat.dashboard');
        }

        // Jika login gagal karena alasan lain
        return redirect()->route('login')->withErrors([
            'error' => 'Terjadi kesalahan saat login. Silakan coba lagi nanti.',
        ]);
    }



    //////////////////////////////////////////////////////////////////////////////////////

    public function showRegisterForm()
    {
        // Get data for dropdowns
        $jenisKelaminList = JenisKelamin::all();
        $ruanganList = Ruangan::all();

        return view('auth.register', compact('jenisKelaminList', 'ruanganList'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'jenis_kelamin_id' => 'required|exists:jenis_kelamin,id',
            'ruangan_id' => 'required|exists:ruangan,id',
            'tanggal_lahir' => 'required|date|before:today',
            'nomor_telepon' => 'required|string|max:15|regex:/^[0-9]+$/',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'jenis_kelamin_id.required' => 'Jenis kelamin harus dipilih',
            'jenis_kelamin_id.exists' => 'Jenis kelamin tidak valid',
            'ruangan_id.required' => 'Ruangan harus dipilih',
            'ruangan_id.exists' => 'Ruangan tidak valid',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
            'nomor_telepon.required' => 'Nomor telepon harus diisi',
            'nomor_telepon.regex' => 'Nomor telepon hanya boleh berupa angka',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, atau jpg',
            'foto.max' => 'Ukuran foto maksimal 2MB'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Hitung usia berdasarkan tanggal lahir
            $tanggalLahir = $request->tanggal_lahir;
            $usia = \Carbon\Carbon::parse($tanggalLahir)->age;

            $userData = [
                'nama_lengkap' => $request->nama_lengkap,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'jenis_kelamin_id' => $request->jenis_kelamin_id,
                'ruangan_id' => $request->ruangan_id,
                'tanggal_lahir' => $tanggalLahir, // Simpan tanggal lahir
                'nomor_telepon' => $request->nomor_telepon,
                'role' => 'perawat' // Default role perawat
            ];

            // Handle photo upload
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('public/user_photos', $fotoName);
                $userData['foto'] = $fotoName;
            }

            $user = User::create($userData);

            // Automatically log in the user
            Auth::login($user);

            return redirect()->intended('/login')->with('success', 'Registrasi berhasil!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage())
                ->withInput();
        }
    }


    // Logout pengguna
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
