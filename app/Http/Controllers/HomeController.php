<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan dashboard untuk admin.
     *
     * @return \Illuminate\View\View
     */
    public function admin()
    {
        return view('admin.dashboard'); // Mengarah ke view dashboard admin
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
