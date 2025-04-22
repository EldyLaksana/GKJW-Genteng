<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Majelis;
use App\Models\Carousel;
use App\Models\Kategori;
use App\Models\Renungan;
use App\Models\Carousel2;
use App\Models\KabarJemaat;
use App\Models\WartaJemaat;
use Illuminate\Support\Str;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;
use App\Models\CarouselImage;
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
            'title' => 'Web Resmi GKJW Jemaat Genteng',
            'judul' => 'Beranda',
            'jadwal' => $jadwalIbadah,
            'renungans' => $renungans,
            'kabarJemaats' => $kabarJemaats,
            'carousel' => Carousel::all(),
        ]);
    }

    public function warta()
    {
        $warta = WartaJemaat::latest()->first();
        $wartaSebelumnya = WartaJemaat::where('id', '!=', $warta->id)->latest()->take(3)->get();

        // return $warta;
        return view('frontend.warta', [
            'title' => 'Warta Jemaat - GKJW Jemaat Genteng',
            'judul' => 'Warta Jemaat',
            'warta' => $warta,
            'wartaSebelumnya' => $wartaSebelumnya,
        ]);
    }

    public function kontak()
    {
        return view('frontend.kontak', [
            'title' => 'Kontak - GKJW Jemaat Genteng',
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
            'title' => 'Renungan - GKJW Jemaat Genteng',
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
            ->take(3)
            ->get();

        $renunganLain->each(function ($renungan) {
            $renungan->published_at = Carbon::parse($renungan->published_at);
        });

        $metaDescription = Str::limit(strip_tags($renungan->renungan), 155);

        // Menggunakan slug sebagai bagian dari kunci cache unik bersama dengan IP pengguna
        $chaceKey = 'renungan_' . $renungan->slug . '_dilihat_' . request()->ip();

        // Cek apakah kunci cache sudah ada. Jika tidak, tambahkan 1 ke view_count dan buat kunci cache
        if (!Cache::has($chaceKey)) {
            $renungan->increment('view_count');
            // Set cache agar bertahan selama 30 menit
            Cache::put($chaceKey, true, now()->addMinutes(30));
        }

        return view('frontend.renungan.show', [
            'title' => $renungan->judul . ' - GKJW Genteng',
            'judul' => 'Renungan',
            'renungan' => $renungan,
            'renunganLain' => $renunganLain,
            'metaDescription' => $metaDescription,
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
            'title' => 'Kabar Jemaat - GKJW Jemaat Genteng',
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
            ->take(3)
            ->get();

        $kabarLain->each(function ($kabarJemaat) {
            $kabarJemaat->published_at = Carbon::parse($kabarJemaat->published_at);
        });

        $metaDescription = Str::limit(strip_tags($kabarJemaat->isi), 155);

        // Menggunakan slug sebagai bagian dari kunci cache unik bersama dengan IP pengguna
        $chaceKey = 'kabar_jemaat_' . $kabarJemaat->slug . '_dilihat_' . request()->ip();

        // Cek apakah kunci cache sudah ada. Jika tidak, tambahkan 1 ke view_count dan buat kunci cache
        if (!Cache::has($chaceKey)) {
            $kabarJemaat->increment('view_count');
            // Set cache agar bertahan selama 30 menit
            Cache::put($chaceKey, true, now()->addMinutes(30));
        }


        return view('frontend.kabar.show', [
            'title' => $kabarJemaat->judul . ' - GKJW Genteng',
            'judul' => 'Kabar Jemaat',
            'kabarJemaat' => $kabarJemaat,
            'kabarLain' => $kabarLain,
            'kategoris' => Kategori::all(),
            'metaDescription' => $metaDescription,
            'carouselImages' => CarouselImage::where('kabar_jemaat_id', $kabarJemaat->id)->get(),
        ]);
    }

    public function showKategori($slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();

        $cari = request()->query('cari');

        $kabarJemaats = KabarJemaat::with(['user', 'kategori'])
            ->where('kategori_id', $kategori->id)
            ->where(function ($query) {
                $query->where('status_publikasi', 'Sekarang')
                    ->orWhere(function ($query) {
                        $query->where('status_publikasi', 'Jadwalkan')
                            ->where('published_at', '<=', now());
                    });
            })
            ->when($cari, function ($query, $cari) {
                $query->where('judul', 'like', '%' . $cari . '%');
            })
            ->latest()
            ->paginate(9);

        $kabarJemaats->each(function ($kabarJemaat) {
            $kabarJemaat->published_at = Carbon::parse($kabarJemaat->published_at);
        });

        return view('frontend.kabar.kategori', [
            'title' => 'Kategori - ' . $kategori->kategori . ' - GKJW Jemaat Genteng',
            'judul' => 'kabarJemaat',
            'kategori' => $kategori,
            'kabarJemaats' => $kabarJemaats,
        ]);
    }

    public function sejarah()
    {
        return view('frontend.sejarah', [
            'judul' => 'Sejarah',
            'title' => 'Sejarah - GKJW Jemaat Genteng',
        ]);
    }

    public function majelis(Request $request)
    {
        // Ambil parameter 'screen' dari query string
        $screen = $request->query('screen', 'large'); //Default: Large

        // Tampilkan  data sesuai ukuran layar
        if ($screen === 'large') {
            $majelis = Majelis::all();
        } else {
            $majelis = Majelis::paginate(4);
        }


        return view('frontend.majelis', [
            'judul' => 'Majelis Jemaat',
            'title' => 'Majelis Jemaat - GKJW Jemaat Genteng',
            'majelis' => $majelis,
        ]);
    }

    public function profilJemaat()
    {
        $jadwalIbadah = JadwalIbadah::all();
        return view('frontend.profil-jemaat', [
            'judul' => 'Profil Jemaat',
            'title' => 'Profil Jemaat - GKJW Jemaat Genteng',
            'jadwal' => $jadwalIbadah,
            'carousel' => Carousel2::all(),
        ]);
    }
}
