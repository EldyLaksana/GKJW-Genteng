<?php

namespace App\Http\Controllers;

use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $jadwalIbadah = JadwalIbadah::all();
        return view('frontend.index', [
            'judul' => 'Beranda',
            'jadwal' => $jadwalIbadah,
        ]);
    }

    public function warta()
    {
        return view('frontend.warta', [
            'judul' => 'Warta Jemaat',
        ]);
    }

    public function kontak()
    {
        return view('frontend.kontak', [
            'judul' => 'Kontak',
        ]);
    }

    public function renungan()
    {
        return view('frontend.renungan', [
            'judul' => 'Renungan'
        ]);
    }

    public function kabar()
    {
        return view('frontend.kabar', [
            'judul' => 'Kabar Jemaat'
        ]);
    }

    public function sejarah()
    {
        return view('frontend.sejarah', [
            'judul' => 'Sejarah',
        ]);
    }
}
