<?php

namespace App\Http\Controllers;

use App\Models\KabarJemaat;
use App\Models\Renungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Query untuk Kabar Jemaat
        $kabarJemaats = KabarJemaat::whereIn('status_publikasi', ['draf', 'jadwalkan'])
            ->when($user->isAdmin == 0, function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->latest()
            ->get();

        // Hanya kirim data Renungan jika isAdmin bernilai 1
        $renungans = $user->isAdmin == 1
            ? Renungan::whereIn('status_publikasi', ['draf', 'jadwalkan'])->latest()->get()
            : collect(); // Mengirim koleksi kosong jika bukan admin


        // Kabar Jemaat dengan 5 pembaca terbanyak, disesuaikan dengan isAdmin
        $topKabarJemaats = KabarJemaat::orderBy('view_count', 'desc')
            ->when($user->isAdmin == 0, function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->take(5)
            ->get();

        $topRenungans = $user->isAdmin == 1
            ? Renungan::orderBy('view_count', 'desc')->take(5)->get()
            : null;

        return view('backend.index', [
            'kabarJemaats' => $kabarJemaats,
            'renungans' => $renungans,
            'topKabarJemaats' => $topKabarJemaats,
            'topRenungans' => $topRenungans,
        ]);
    }
}
