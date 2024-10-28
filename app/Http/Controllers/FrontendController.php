<?php

namespace App\Http\Controllers;

use App\Models\JadwalIbadah;
use App\Models\Renungan;
use App\Models\WartaJemaat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $jadwalIbadah = JadwalIbadah::all();
        $renungans = Renungan::where(function ($query) {
            $query->where('status_publikasi', 'published')
                ->orWhere(function ($query) {
                    $query->where('status_publikasi', 'scheduled')
                        ->where('published_at', '<=', now());
                });
        })->orderBy('published_at', 'desc')->take(3)->get()->each(function ($renungan) {
            $renungan->published_at = Carbon::parse($renungan->published_at);
        });

        return view('frontend.index', [
            'judul' => 'Beranda',
            'jadwal' => $jadwalIbadah,
            'renungans' => $renungans,
        ]);
    }

    public function warta()
    {
        $warta = WartaJemaat::latest('id')->first();

        // return $warta;
        return view('frontend.warta', [
            'judul' => 'Warta Jemaat',
            'warta' => $warta,
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
        $renungans = Renungan::where(function ($query) {
            $query->where('status_publikasi', 'published')
                ->orWhere(function ($query) {
                    $query->where('status_publikasi', 'scheduled')
                        ->where('published_at', '<=', now());
                });
        })->orderBy('published_at', 'desc')->paginate(12); // Menggunakan paginate untuk pagination

        // Jika Anda perlu memformat tanggal, Anda dapat melakukannya di sini
        $renungans->each(function ($renungan) {
            $renungan->published_at = Carbon::parse($renungan->published_at);
        });

        return view('frontend.renungan.renungan', [
            'judul' => 'Renungan',
            'renungans' => $renungans,
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
