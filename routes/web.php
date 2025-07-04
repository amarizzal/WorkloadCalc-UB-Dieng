<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Perawat\PerawatController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Perawat\NotifikasiController;

use Illuminate\Support\Facades\Auth;

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    // Route untuk dashboard admin
    Route::get('/admin', [HomeController::class, 'admin'])->name('admin.dashboard');

    // Route untuk dashboard perawat
    Route::get('/perawat', [HomeController::class, 'perawat'])->name('perawat.dashboard');
});

Route::get('/', function () {
    return redirect()->route('login');
});

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/master-user', [MasterController::class, 'masterUser'])->name('admin.master-user');

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
        Route::get('/laporan2', [LaporanController::class, 'index2'])->name('admin.laporan.index2');
        Route::get('/laporan3', [LaporanController::class, 'index3'])->name('admin.laporan.index3');
        Route::get('/laporan4', [LaporanController::class, 'index4'])->name('admin.laporan.index4');
        Route::get('/laporan5', [LaporanController::class, 'index5'])->name('admin.laporan.index5');
        Route::get('/laporan6', [LaporanController::class, 'index6'])->name('admin.laporan.index6');
        Route::get('/laporan/detail-tindakan/{tindakanId}/{userId}', [LaporanController::class, 'detailTindakan'])->name('admin.laporan.detailTindakan');


    });

////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////

Route::prefix('perawat')
    ->name('perawat.')
    ->group(function () {
        Route::get('/home', [PerawatController::class, 'home'])->name('home');

        /////////////////////////////////////////////////////////////////////////////////////////////////
    
        Route::get('/timer', [PerawatController::class, 'timer'])->name('timer');
        Route::post('/start-action', [PerawatController::class, 'startAction'])->name('start-action');
        Route::post('/stop-action/{id}', [PerawatController::class, 'stopAction'])->name('stop-action');

        //////////////////////////////////////////////////////////////////////////////////////////////////
        Route::get('/hasil', [PerawatController::class, 'hasil'])->name('hasil');
        Route::post('/hasil/{id}/keterangan', [PerawatController::class, 'storeKeterangan'])->name('keterangan.store');
        // routes/web.php
        Route::post('/tindakan/store', [PerawatController::class, 'storeTindakanLain'])->name('tindakan.store');
        Route::post('/tindakan/store-tambahan', [PerawatController::class, 'storeTindakanTambahan'])->name('tindakan.storeTambahan');
        Route::get('/tindakan', [PerawatController::class, 'tindakan'])->name('tindakan');

        //////////////////////////////////////////////////////////////////////
        Route::get('/profil', [PerawatController::class, 'profil'])->name('profil');
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
