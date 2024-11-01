<?php

namespace App\Http\Controllers;

use App\Models\JadwalIbadah;
use App\Models\KabarJemaat;
use App\Models\Renungan;
use App\Models\WartaJemaat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // Carbon::setLocale('id');
        $jadwalIbadah = JadwalIbadah::all();
        $renungans = Renungan::where(function ($query) {
            $query->where('status_publikasi', 'Published')
                ->orWhere(function ($query) {
                    $query->where('status_publikasi', 'Scheduled')
                        ->where('published_at', '<=', now());
                });
        })->orderBy('published_at', 'desc')->take(3)->get()->each(function ($renungan) {
            $renungan->published_at = Carbon::parse($renungan->published_at);
        });

        $kabarJemaats = KabarJemaat::with(['user', 'kategori'])->where(function ($query) {
            $query->where('status_publikasi', 'Published')
                ->orWhere(function ($query) {
                    $query->where('status_publikasi', 'Scheduled')
                        ->where('published_at', '<=', now());
                });
        })->orderBy('published_at', 'desc')->take(3)->get()->each(function ($kabarJemaat) {
            $kabarJemaat->published_at = Carbon::parse($kabarJemaat->published_at);
        });

        return view('frontend.index', [
            'judul' => 'Beranda',
            'jadwal' => $jadwalIbadah,
            'renungans' => $renungans,
            'kabarJemaats' => $kabarJemaats,
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
            $query->where('status_publikasi', 'Published')
                ->orWhere(function ($query) {
                    $query->where('status_publikasi', 'Scheduled')
                        ->where('published_at', '<=', now());
                });
        })->orderBy('published_at', 'desc')->paginate(9); // Menggunakan paginate untuk pagination

        // Jika Anda perlu memformat tanggal, Anda dapat melakukannya di sini
        $renungans->each(function ($renungan) {
            $renungan->published_at = Carbon::parse($renungan->published_at);
        });

        return view('frontend.renungan.renungan', [
            'judul' => 'Renungan',
            'renungans' => $renungans,
        ]);
    }

    public function showRenungan(Renungan $renungan)
    {
        $renungan->published_at = Carbon::parse($renungan->published_at);
        $renunganLain = Renungan::where('slug', '!=', $renungan->slug)
            ->where(function ($query) {
                $query->where('status_publikasi', 'Published')
                    ->orWhere(function ($query) {
                        $query->where('status_publikasi', 'Scheduled')
                            ->where('published_at', '<=', now());
                    });
            })
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        $renunganLain->each(function ($renungan) {
            $renungan->published_at = Carbon::parse($renungan->published_at);
        });

        return view('frontend.renungan.show', [
            'judul' => 'Renungan',
            'renungan' => $renungan,
            'renunganLain' => $renunganLain,
        ]);
    }

    public function kabar()
    {
        $kabarJemaats = KabarJemaat::with(['user', 'kategori'])->where(function ($query) {
            $query->where('status_publikasi', 'Published')
                ->orWhere(function ($query) {
                    $query->where('status_publikasi', 'Scheduled')
                        ->where('published_at', '<=', now());
                });
        })->orderBy('published_at', 'desc')->paginate(9); // Menggunakan paginate untuk pagination

        // Jika Anda perlu memformat tanggal, Anda dapat melakukannya di sini
        $kabarJemaats->each(function ($kabarJemaat) {
            $kabarJemaat->published_at = Carbon::parse($kabarJemaat->published_at);
        });

        return view('frontend.kabar.kabar', [
            'judul' => 'Kabar Jemaat',
            'kabarJemaats' => $kabarJemaats,
        ]);
    }

    public function showKabar(KabarJemaat $kabarJemaat)
    {
        $kabarJemaat->published_at = Carbon::parse($kabarJemaat->published_at);
        $kabarLain = KabarJemaat::where('slug', '!=', $kabarJemaat->slug)
            ->where(function ($query) {
                $query->where('status_publikasi', 'Published')
                    ->orWhere(function ($query) {
                        $query->where('status_publikasi', 'Scheduled')
                            ->where('published_at', '<=', now());
                    });
            })
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        $kabarLain->each(function ($kabarJemaat) {
            $kabarJemaat->published_at = Carbon::parse($kabarJemaat->published_at);
        });

        return view('frontend.kabar.show', [
            'judul' => 'Kabar Jemaat',
            'kabarJemaat' => $kabarJemaat,
            'kabarLain' => $kabarLain,
        ]);
    }

    public function sejarah()
    {
        return view('frontend.sejarah', [
            'judul' => 'Sejarah',
        ]);
    }
}
