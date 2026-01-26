<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // 1. Data dari Arsip (Manual Input / Lakid Lama)
        $totalArsip = Archive::count();
        $merekArsip = Archive::where('jenis', 'Merek')->count();
        $ciptaArsip = Archive::where('jenis', 'Hak Cipta')->count();

        // 2. Data dari Sistem Baru (Yang statusnya bukan Draft)
        $totalSistem = Pengajuan::where('status', '!=', 'Draft')->count();
        $merekSistem = Pengajuan::where('jenis', 'Merek')->where('status', '!=', 'Draft')->count();
        $ciptaSistem = Pengajuan::where('jenis', 'Hak Cipta')->where('status', '!=', 'Draft')->count();

        // 3. Total Gabungan
        $totalFasilitasi = $totalArsip + $totalSistem;
        $totalMerek = $merekArsip + $merekSistem;
        $totalHakCipta = $ciptaArsip + $ciptaSistem;

        return view('welcome', compact('totalFasilitasi', 'totalMerek', 'totalHakCipta'));
    }
}