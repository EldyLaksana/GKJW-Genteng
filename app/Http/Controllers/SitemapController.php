<?php

namespace App\Http\Controllers;

use App\Models\KabarJemaat;
use App\Models\Kategori;
use App\Models\Renungan;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        // Ambil semua renungan dan kabar jemaat yang dipublikasikan
        $renungans = Renungan::where('status_publikasi', 'Sekarang')->get();
        $kabarJemaats = KabarJemaat::where('status_publikasi', 'Sekarang')->get();

        // Ambil semua kategori
        $categories = Kategori::all();

        // Kembalikan tampilan sitemap dengan header XML
        return response()->view('sitemap', compact('renungans', 'kabarJemaats', 'categories'))
            ->header('Content-Type', 'application/xml');
    }
}
