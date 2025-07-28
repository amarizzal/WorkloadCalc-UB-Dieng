<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TindakanWaktu;
use App\Models\LaporanTindakanPerawat;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class HomeController extends Controller
{
    /**
     * Menampilkan dashboard untuk admin.
     *
     * @return \Illuminate\View\View
     */
    public function admin()
    {
        $totalPerawat = User::where('role', 'perawat')->count();
        $totalTindakan = TindakanWaktu::count();
        $totalTindakanPokok = TindakanWaktu::where('status', 'Tugas Pokok')->count();
        $totalTindakanToday = LaporanTindakanPerawat::where('tanggal', now()->format('Y-m-d'))->count();

        // grafik
        // 7 hari terakhir, termasuk hari ini
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Query: Ambil jumlah laporan per hari
        $laporan = LaporanTindakanPerawat::selectRaw('DATE(tanggal) as date, COUNT(*) as total')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->groupBy('date')
            ->pluck('total', 'date'); // key = date, value = total

        // Generate semua tanggal 7 hari terakhir
        $period = CarbonPeriod::create($startDate, $endDate);

        // Siapkan hasil akhir
        $hasilGrafik = [];

        foreach ($period as $date) {
            $tgl = $date->toDateString(); // YYYY-MM-DD
            $hari = $date->locale('id')->translatedFormat('l'); // "Senin", "Selasa", dst
            $hasilGrafik[] = [
                'day' => $hari,
                'total' => $laporan[$tgl] ?? 0,
            ];
        }
        return view('dashboard.index', compact('totalPerawat', 'totalTindakan', 'totalTindakanPokok', 'totalTindakanToday', 'hasilGrafik')); // Mengarah ke view dashboard admin
    }

    /**
     * Menampilkan dashboard untuk perawat.
     *
     * @return \Illuminate\View\View
     */
    public function perawat()
    {
        return view('perawat.home'); // Mengarah ke view dashboard perawat
    }
}
