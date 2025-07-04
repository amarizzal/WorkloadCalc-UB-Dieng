<?php

namespace App\Listeners;

use App\Events\LaporanTindakanUpdated;
use App\Models\Notification;

class CreateNotificationForLaporan
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\LaporanTindakanUpdated  $event
     * @return void
     */
    public function handle(LaporanTindakanUpdated $event)
    {
        $laporan = $event->laporan;

        // Cek apakah jam_berhenti terisi
        if ($laporan->jam_berhenti) {
            // Buat notifikasi
            Notification::create([
                'user_id' => $laporan->user_id, // User yang terkait dengan laporan
                'title' => 'Tindakan Selesai',
                'message' => "Tindakan '{$laporan->tindakan->tindakan}' selesai pada {$laporan->jam_berhenti}.",
            ]);
        }
    }
}
