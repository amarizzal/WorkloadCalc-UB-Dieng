<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Perawat\PerawatController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\HospitalController;
use App\Http\Controllers\Perawat\NotifikasiController;

use Illuminate\Support\Facades\Auth;

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    // Route untuk dashboard admin
   

    
});

Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Route::get('/login', function () {
//     return redirect()->route('login');
// });

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')
    ->group(function () {
        Route::get('/', [HomeController::class, 'admin'])->name('admin.dashboard');
        Route::get('/master-user', [MasterController::class, 'masterUser'])->name('admin.master-user');
        Route::post('/master-user-post', [MasterController::class, 'masterUserStore'])->name('admin.master-user-post');
        Route::post('/master-user/import', [MasterController::class, 'masterUserImport'])->name('admin.master-user-import');
        Route::get('/master-user/template', [MasterController::class, 'downloadTemplate'])->name('admin.master-user-template');
        Route::delete('/master-user/delete/{id}', [MasterController::class, 'deleteUser'])->name('admin.master.user.delete');

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    
        Route::get('/master-tindakan', [MasterController::class, 'masterTindakan'])->name('admin.master-tindakan');
        Route::post('/master-tindakan/store', [MasterController::class, 'storeTindakan'])->name('admin.master.tindakan.store');
        Route::delete('/master-tindakan/delete/{id}', [MasterController::class, 'deleteTindakan'])->name('admin.master.tindakan.delete');
        Route::get('/master-tindakan/edit/{id}', [MasterController::class, 'editTindakan'])->name('admin.master.tindakan.edit');
        Route::put('/master-tindakan/update/{id}', [MasterController::class, 'updateTindakan'])->name('admin.master.tindakan.update');

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    
        Route::get('/master-shift', [MasterController::class, 'masterShiftKerja'])->name('admin.master-shiftkerja');
        Route::post('/master-shift-kerja/store', [MasterController::class, 'storeShiftKerja'])->name('admin.master.shiftkerja.store');
        Route::delete('/master-shift-kerja/delete/{id}', [MasterController::class, 'deleteShiftKerja'])->name('admin.master.shiftkerja.delete');

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////
        Route::get('/master-work-status', [MasterController::class, 'masterWorkStatus'])->name('admin.master-work-status');

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
        Route::get('/master-ruangan', [MasterController::class, 'masterRuangan'])->name('admin.master-ruangan');
        Route::post('/ruangan/store', [MasterController::class, 'storeRuangan'])->name('master.ruangan.store');
        Route::delete('/ruangan/delete/{id}', [MasterController::class, 'deleteRuangan'])->name('master.ruangan.delete');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
        Route::get('/master-keamanan-privasi', [MasterController::class, 'masterKeamananPrivasi'])->name('admin.master-keamanan-privasi');
        Route::get('/master-panduan', [MasterController::class, 'masterPanduan'])->name('admin.master-panduan');

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
        Route::delete('/laporan/delete/{id}', [LaporanController::class, 'deleteLaporan'])->name('admin.laporan.delete');

        // tugas pokok
        Route::get('/laporan2', 
        [LaporanController::class, 'index2'])->name('admin.laporan.index2');

        
        Route::get('/laporan3', [LaporanController::class, 'index3'])->name('admin.laporan.index3');
        Route::get('/laporan4', [LaporanController::class, 'index4'])->name('admin.laporan.index4');
        Route::get('/laporan5', [LaporanController::class, 'index5'])->name('admin.laporan.index5');
        Route::get('/laporan6', [LaporanController::class, 'index6'])->name('admin.laporan.index6');
        Route::get('/laporan7', [LaporanController::class, 'index7'])->name('admin.laporan.index7');
        Route::get('/laporan/detail-tindakan/{tindakanId}/{userId}', [LaporanController::class, 'detailTindakan'])->name('admin.laporan.detailTindakan');
        Route::get('/laporan/analisa-data/{userId}', [LaporanController::class, 'analisaData'])->name('admin.laporan.analisaData');
        Route::get('/laporan/analisa-data-semua', [LaporanController::class, 'analisaDataSemua'])->name('admin.laporan.analisaDataSemua');

        // DATA RUMAH SAKIT
        Route::get('/data-rumah-sakit', [HospitalController::class, 'index'])->name('admin.data-rumah-sakit');
        Route::post('/data-rumah-sakit/update', [HospitalController::class, 'update'])->name('admin.data-rumah-sakit.update');


});

////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////

Route::middleware(['auth', 'role:perawat'])->prefix('perawat')
    ->name('perawat.')
    ->group(function () {
        // Route untuk dashboard perawat
        Route::get('/', [HomeController::class, 'perawat'])->name('dashboard');
        Route::get('/home', [PerawatController::class, 'home'])->name('home');

        /////////////////////////////////////////////////////////////////////////////////////////////////
    
        Route::get('/timer', [PerawatController::class, 'timer'])->name('timer');
        // Route::post('/start-action', [PerawatController::class, 'startAction'])->name('start-action');
        Route::post('/stop-action', [PerawatController::class, 'stopAction'])->name('stop-action');

        //////////////////////////////////////////////////////////////////////////////////////////////////
        Route::get('/hasil', [PerawatController::class, 'hasil'])->name('hasil');
        Route::post('/hasil/{id}/keterangan', [PerawatController::class, 'storeKeterangan'])->name('keterangan.store');
        // routes/web.php
        Route::post('/tindakan/store', [PerawatController::class, 'storeTindakanLain'])->name('tindakan.store');
        Route::post('/tindakan/store-tambahan', [PerawatController::class, 'storeTindakanTambahan'])->name('tindakan.storeTambahan');
        Route::post('/tindakan/store-pokok', [PerawatController::class, 'storeTindakanPokok'])->name('tindakan.storePokok');
        Route::get('/tindakan', [PerawatController::class, 'tindakan'])->name('tindakan');
        
        // TINDKAN TAMBAHAN
        Route::get('/tindakan-tambahan', [PerawatController::class, 'tindakanTambahan'])->name('tindakan.tambahan');
        //////////////////////////////////////////////////////////////////////
        Route::get('/profil', [PerawatController::class, 'profil'])->name('profil');
        Route::get('/profil-edit', [PerawatController::class, 'profilEdit'])->name('profil.edit');
        Route::post('/profil-edit', [PerawatController::class, 'profilEditStore'])->name('profil.edit.store');

        Route::get('/profil-password', [PerawatController::class, 'profilPassword'])->name('profil.password');
        Route::post('/profil-password-store', [PerawatController::class, 'profilPasswordStore'])->name('profil.password.store');
        //////////////////////////////////////////////////////////////////////
    
        // Menambahkan route baru
        // Menampilkan form ubah password
        Route::get('/ubahpassword', [PerawatController::class, 'showUbahPasswordForm'])->name('ubahpassword');
        Route::post('/ubahpassword', [PerawatController::class, 'ubahPassword'])->name('ubahpassword.update');
        Route::get('/panduan', [PerawatController::class, 'panduan'])->name('panduan');
        Route::get('/pengaturan', [PerawatController::class, 'pengaturan'])->name('pengaturan');
        Route::get('/keamananprivasi', [PerawatController::class, 'keamananPrivasi'])->name('keamananprivasi');
        Route::get('/tentangkami', [PerawatController::class, 'tentangKami'])->name('tentangkami');

        Route::get('/notifikasi', [NotifikasiController::class, 'index']);
        Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead']);
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
            

// Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
// Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

// Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});