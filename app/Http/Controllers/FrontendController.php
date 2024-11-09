<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\JadwalIbadah;
use App\Models\KabarJemaat;
use App\Models\Kategori;
use App\Models\Majelis;
use App\Models\Renungan;
use App\Models\WartaJemaat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    public function index()
    {
        // Carbon::setLocale('id');
        $jadwalIbadah = JadwalIbadah::all();
        $renungans = Renungan::where(function ($query) {
            $query->where('status_publikasi', 'Sekarang')
                ->orWhere(function ($query) {
                    $query->where('status_publikasi', 'Jadwalkan')
                        ->where('published_at', '<=', now());
                });
        })->orderBy('published_at', 'desc')->take(3)->get()->each(function ($renungan) {
            $renungan->published_at = Carbon::parse($renungan->published_at);
        });

        $kabarJemaats = KabarJemaat::with(['user', 'kategori'])->where(function ($query) {
            $query->where('status_publikasi', 'Sekarang')
                ->orWhere(function ($query) {
                    $query->where('status_publikasi', 'Jadwalkan')
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
            'carousel' => Carousel::all(),
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
        // Ambil nilai pencarian dari URL, jika ada
        $cari = request()->query('cari');

        $renungans = Renungan::where(function ($query) {
            $query->where('status_publikasi', 'Sekarang')
                ->orWhere(function ($query) {
                    $query->where('status_publikasi', 'Jadwalkan')
                        ->where('published_at', '<=', now());
                });
        })
            // Tambahkan pencarian berdasarkan judul jika ada
            ->when($cari, function ($query, $cari) {
                return $query->where('judul', 'like', '%' . $cari . '%');
            })
            ->orderBy('published_at', 'desc')
            ->paginate(9) // Menggunakan paginate untuk pagination
            ->withQueryString(); // Mempertahankan query pencarian pada paginasi

        // Format tanggal jika diperlukan
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
                $query->where('status_publikasi', 'Sekarang')
                    ->orWhere(function ($query) {
                        $query->where('status_publikasi', 'Jadwalkan')
                            ->where('published_at', '<=', now());
                    });
            })
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        $renunganLain->each(function ($renungan) {
            $renungan->published_at = Carbon::parse($renungan->published_at);
        });

        // Menggunakan slug sebagai bagian dari kunci cache unik bersama dengan IP pengguna
        $chaceKey = 'renungan_' . $renungan->slug . '_dilihat_' . request()->ip();

        // Cek apakah kunci cache sudah ada. Jika tidak, tambahkan 1 ke view_count dan buat kunci cache
        if (!Cache::has($chaceKey)) {
            $renungan->increment('view_count');
            // Set cache agar bertahan selama 30 menit
            Cache::put($chaceKey, true, now()->addMinutes(30));
        }

        return view('frontend.renungan.show', [
            'judul' => 'Renungan',
            'renungan' => $renungan,
            'renunganLain' => $renunganLain,
        ]);
    }

    public function kabar()
    {
        // Ambil nilai pencarian dari URL, jika ada
        $cari = request()->query('cari');

        $kabarJemaats = KabarJemaat::with(['user', 'kategori'])
            ->where(function ($query) {
                $query->where('status_publikasi', 'Sekarang')
                    ->orWhere(function ($query) {
                        $query->where('status_publikasi', 'Jadwalkan')
                            ->where('published_at', '<=', now());
                    });
            })
            // Tambahkan pencarian berdasarkan judul jika ada
            ->when($cari, function ($query, $cari) {
                return $query->where('judul', 'like', '%' . $cari . '%');
            })
            ->orderBy('published_at', 'desc')
            ->paginate(9) // Menggunakan paginate untuk pagination
            ->withQueryString(); // Mempertahankan query pencarian pada paginasi

        // Format tanggal jika diperlukan
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
                $query->where('status_publikasi', 'Sekarang')
                    ->orWhere(function ($query) {
                        $query->where('status_publikasi', 'Jadwalkan')
                            ->where('published_at', '<=', now());
                    });
            })
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        $kabarLain->each(function ($kabarJemaat) {
            $kabarJemaat->published_at = Carbon::parse($kabarJemaat->published_at);
        });

        // Menggunakan slug sebagai bagian dari kunci cache unik bersama dengan IP pengguna
        $chaceKey = 'kabar_jemaat_' . $kabarJemaat->slug . '_dilihat_' . request()->ip();

        // Cek apakah kunci cache sudah ada. Jika tidak, tambahkan 1 ke view_count dan buat kunci cache
        if (!Cache::has($chaceKey)) {
            $kabarJemaat->increment('view_count');
            // Set cache agar bertahan selama 30 menit
            Cache::put($chaceKey, true, now()->addMinutes(30));
        }

        return view('frontend.kabar.show', [
            'judul' => 'Kabar Jemaat',
            'kabarJemaat' => $kabarJemaat,
            'kabarLain' => $kabarLain,
            'kategoris' => Kategori::all(),
        ]);
    }

    public function showKategori($slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();

        $kabarJemaats = KabarJemaat::with(['kategori', 'user'])
            ->where('kategori_id', $kategori->id)
            ->latest()
            ->paginate(10);

        $kabarJemaats->each(function ($kabarJemaat) {
            $kabarJemaat->published_at = Carbon::parse($kabarJemaat->published_at);
        });

        return view('frontend.kabar.kategori', [
            'judul' => 'kabarJemaat',
            'kategori' => $kategori,
            'kabarJemaats' => $kabarJemaats,
        ]);
    }

    public function sejarah()
    {
        return view('frontend.sejarah', [
            'judul' => 'Sejarah',
        ]);
    }

    public function majelis()
    {
        return view('frontend.majelis', [
            'judul' => 'Majelis Jemaat',
            'majelis' => Majelis::all(),
        ]);
    }
}
