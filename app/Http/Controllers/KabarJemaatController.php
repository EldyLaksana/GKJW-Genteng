<?php

namespace App\Http\Controllers;

use App\Models\KabarJemaat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KabarJemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kabarJemaat = KabarJemaat::query();

        // return ($kabarJemaat);
        if (request('judul')) {
            $kabarJemaat->where('kabar_jemaats.judul', 'like', '%' . request('judul') . '%');
        }

        $kabarJemaat = $kabarJemaat->latest()->paginate(10);

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
            'slug' => 'required|unique:kabar_jemaats,slug',
            'gambar' => 'image|file|mimes:jpg,jpeg,png|max:5000',
            'sumber_gambar' => 'nullable',
            'isi' => 'required',
            'embed' => 'nullable',
            'sumber' => 'nullable',
            'status_publikasi' => 'nullable',
            'published_at' => 'nullable|date',
        ]);

        // return $validateData;
        if ($request->file('gambar')) {
            $validateData['gambar'] = $request->file('gambar')->store('gambar-kabar');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->isi), 250, '...');

        // Jika status publikasi adalah Scheduled, maka published_at wajib diisi
        if ($request->status_publikasi === 'Jadwalkan') {
            $request->validate([
                'published_at' => 'required|date',
            ]);
            $validateData['published_at'] = $request->published_at;
        } elseif ($request->status_publikasi === 'Sekarang') {
            // Jika statusnya Publish, atur waktu publikasi saat ini
            $validateData['published_at'] = now();
        } else {
            // Jika statusnya Draft, kosongkan published_at
            $validateData['published_at'] = null;
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
            'status_publikasi' => 'nullable',
            'published_at' => 'nullable|date',
        ]);

        if ($request->file('gambar')) {

            if ($kabarJemaat->gambar) {
                Storage::delete($kabarJemaat->gambar);
            }
            $validateData['gambar'] = $request->file('gambar')->store('gambar-kabar');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->isi), 250, '...');

        // Jika status publikasi adalah Scheduled, maka published_at wajib diisi
        if ($request->status_publikasi === 'Jadwalkan') {
            $request->validate([
                'published_at' => 'required|date',
            ]);
            $validateData['published_at'] = $request->published_at;
        } elseif ($request->status_publikasi === 'Sekarang') {
            // Jika statusnya Publish, atur waktu publikasi saat ini
            $validateData['published_at'] = now();
        } else {
            // Jika statusnya Draft, kosongkan published_at
            $validateData['published_at'] = null;
        }

        $kabarJemaat->update($validateData);

        return redirect()->route('kabar-jemaat.index')->with('success', 'Kabar berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KabarJemaat $kabarJemaat)
    {

        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard/kabar-jemaat');
        }

        if ($kabarJemaat->gambar) {
            Storage::delete($kabarJemaat->gambar);
        }

        KabarJemaat::destroy($kabarJemaat->id);

        return redirect()->route('kabar-jemaat.index')->with('danger', 'Kabar Jemaat berhasil dihapus');
    }
}
