<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    // Menampilkan notifikasi yang belum dibaca
    public function index()
    {
        // Ambil notifikasi yang belum dibaca untuk user yang sedang login dan urutkan berdasarkan ID (terbesar ke kecil)
        $notifications = Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->orderBy('id', 'desc') // Urutkan berdasarkan ID
            ->get();

        // Pastikan data ada dan formatnya benar
        if ($notifications->isEmpty()) {
            return response()->json([
                'notifications' => [], // Jika tidak ada notifikasi
            ]);
        }

        // Format notifikasi menjadi array dengan ID dan pesan
        $notificationData = $notifications->map(function ($notification) {
            return [
                'id' => $notification->id, // Mengembalikan ID notifikasi
                'message' => $notification->message, // Pesan notifikasi
            ];
        });

        // Kirimkan data dalam format yang benar
        return response()->json([
            'notifications' => $notificationData,
        ]);
    }


    // Menandai notifikasi sebagai sudah dibaca
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->is_read = true;
        $notification->save();

        return response()->json(['success' => true]);
    }

}
