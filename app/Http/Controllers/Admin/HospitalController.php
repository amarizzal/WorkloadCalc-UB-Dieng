<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;

class HospitalController extends Controller
{
    public function index()
    {
        // get hospital data
        $hospital = Hospital::first();

        return view('admin.rumah-sakit.dataRumahSakit', compact('hospital'));
    }
    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'efektif_hari' => 'required|integer',
            'libur_nasional' => 'required|integer',
            'cuti_tahunan' => 'required|integer',
            'rata_rata_sakit' => 'required|integer',
            'hari_cuti_lain' => 'required|integer',
            'jam_efektif' => 'required|integer',
            'waktu_kerja_tersedia' => 'required|integer',
        ]);

        // Update or create hospital data
        Hospital::updateOrCreate(
            ['id' => 1], // Assuming there's only one record
            $request->all()
        );

        return redirect()->route('admin.data-rumah-sakit')->with('success', 'Data Rumah Sakit berhasil diperbarui.');
    }
}
