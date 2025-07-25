<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        $user = $request->user();

        // Jika belum login
        if (!$user) {
            return redirect()->route('login');
        }

        // Ubah string 'admin,editor' menjadi array ['admin', 'editor']
        $roles = explode(',', $roles);
        // Cek apakah user memiliki salah satu role yang diperbolehkan
        if (!in_array($user->role, $roles)) {
            Auth::logout(); // Logout user
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}
