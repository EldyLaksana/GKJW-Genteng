<?php

namespace App\Http\Controllers;

use App\Models\KabarJemaat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KabarJemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan user yang sedang login
        $user = auth()->user();

        // Cek apakah user memiliki isAdmin 1
        if ($user->isAdmin == 1) {
            // Jika isAdmin 1, tampilkan semua data KabarJemaat
            $kabarJemaat = KabarJemaat::latest()->paginate(10);
        } else {
            // Jika isAdmin 0, tampilkan hanya data KabarJemaat milik user tersebut
            $kabarJemaat = KabarJemaat::where('user_id', $user->id)->latest()->paginate(10);
        }

        return view('backend.kabarJemaat.index', [
            'kabarJemaat' => $kabarJemaat,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.kabarJemaat.create', [
            'kategoris' => Kategori::all(),
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validateData = $request->validate([
            'user_id' => '',
            'kategori_id' => '',
            'judul' => 'required|max:255',
            'slug' => 'required|unique:kabarJemaats,slug',
            'gambar' => 'image|file|mimes:jpg,jpeg,png|max:5000',
            'sumber_gambar' => 'nullable',
            'isi' => 'required',
            'sumber' => 'nullable',
            'published_at' => 'nullable|date',
        ]);

        // return $validateData;
        if ($request->file('gambar')) {
            $validateData['gambar'] = $request->file('gambar')->store('gambar-kabar');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->isi), 250, '...');

        if ($request->filled('published_at')) {
            $validateData['status_publikasi'] = 'Scheduled';
            $validateData['published_at'] = $request->published_at;
        } else {
            $validateData['status_publikasi'] = 'Published';
            $validateData['published_at'] = now(); // Mengatur ke waktu saat ini
        }

        KabarJemaat::create($validateData);

        return redirect()->route('kabar-jemaat.index')->with('success', 'Kabar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KabarJemaat $kabarJemaat)
    {
        return view('backend.kabarJemaat.show', [
            'kabarJemaat' => $kabarJemaat,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KabarJemaat $kabarJemaat)
    {
        return view('backend.kabarJemaat.edit', [
            'kabarJemaat' => $kabarJemaat,
            'kategoris' => Kategori::all(),
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KabarJemaat $kabarJemaat)
    {
        $validateData = $request->validate([
            'kategori_id' => '',
            'judul' => 'required|max:255',
            'slug' => 'required|unique:kabar_jemaats,slug,' . $kabarJemaat->id,
            'gambar' => 'image|file|mimes:jpg,jpeg,png|max:5000',
            'sumber_gambar' => 'nullable',
            'isi' => 'required',
            'sumber' => 'nullable',
            'published_at' => 'nullable|date',
        ]);

        if ($request->file('gambar')) {

            if ($kabarJemaat->gambar) {
                Storage::delete($kabarJemaat->gambar);
            }
            $validateData['gambar'] = $request->file('gambar')->store('gambar-kabar');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->isi), 250, '...');

        if ($request->filled('published_at')) {
            $validateData['status_publikasi'] = 'Scheduled';
            $validateData['published_at'] = $request->published_at;
        } else {
            $validateData['status_publikasi'] = 'Published';
            $validateData['published_at'] = now(); // Mengatur ke waktu saat ini
        }

        $kabarJemaat->update($validateData);

        return redirect()->route('kabar-jemaat.index')->with('success', 'Kabar berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KabarJemaat $kabarJemaat)
    {
        if ($kabarJemaat->gambar) {
            Storage::delete($kabarJemaat->gambar);
        }

        KabarJemaat::destroy($kabarJemaat->id);

        return redirect()->route('kabar-jemaat.index')->with('danger', 'Kabar Jemaat berhasil dihapus');
    }
}
