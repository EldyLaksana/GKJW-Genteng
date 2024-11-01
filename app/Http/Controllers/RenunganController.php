<?php

namespace App\Http\Controllers;

use App\Models\Renungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RenunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.renungan.index', [
            'renungan' => Renungan::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.renungan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validateData = $request->validate([
            'judul' => 'required|max:255',
            'slug' => 'required|unique:renungans,slug',
            'gambar' => 'image|file|mimes:jpg,jpeg,png|max:5000',
            'sumber_gambar' => 'nullable',
            'renungan' => 'required',
            'sumber' => 'nullable',
            'published_at' => 'nullable|date',
        ]);
        // dd($validateData);
        if ($request->file('gambar')) {
            $validateData['gambar'] = $request->file('gambar')->store('gambar-renungan');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->renungan), 250, '...');

        if ($request->filled('published_at')) {
            $validateData['status_publikasi'] = 'Scheduled';
            $validateData['published_at'] = $request->published_at;
        } else {
            $validateData['status_publikasi'] = 'Published';
            $validateData['published_at'] = now(); // Mengatur ke waktu saat ini
        }

        Renungan::create($validateData);

        return redirect()->route('renungan.index')->with('success', 'Renungan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Renungan $renungan)
    {
        // return $renungan;
        return view('backend.renungan.show', [
            'renungan' => $renungan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Renungan $renungan)
    {
        return view('backend.renungan.edit', [
            'renungan' => $renungan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Renungan $renungan)
    {
        $validateData = $request->validate([
            'judul' => 'required|max:255',
            'slug' => 'required|unique:renungans,slug,' . $renungan->id, // Mengecualikan slug milik renungan saat ini
            'gambar' => 'image|file|mimes:jpg,jpeg,png|max:5000',
            'sumber_gambar' => 'nullable',
            'renungan' => 'required',
            'sumber' => 'nullable',
            'published_at' => 'nullable|date',
        ]);

        if ($request->file('gambar')) {
            // Jika ada file gambar baru, simpan file baru dan hapus yang lama
            if ($renungan->gambar) {
                Storage::delete($renungan->gambar);
            }
            $validateData['gambar'] = $request->file('gambar')->store('gambar-renungan');
        }

        // Menghilangkan &nbsp; dari renungan sebelum mengambil excerpt
        $renunganContent = str_replace('&nbsp;', ' ', $request->renungan);
        $validateData['excerpt'] = Str::limit(strip_tags($renunganContent), 250, '...');

        // Tentukan status publikasi dan published_at berdasarkan input tanggal
        if ($request->filled('published_at')) {
            $validateData['status_publikasi'] = 'Scheduled';
            $validateData['published_at'] = $request->published_at;
        } else {
            $validateData['status_publikasi'] = 'Published';
            $validateData['published_at'] = now();
        }

        // Update data renungan
        $renungan->update($validateData);

        return redirect()->route('renungan.index')->with('success', 'Renungan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Renungan $renungan)
    {

        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard/renungan');
        }

        if ($renungan->gambar) {
            Storage::delete($renungan->gambar);
        }

        Renungan::destroy($renungan->id);

        return redirect()->route('renungan.index')->with('danger', 'Renungan berhasil dihapus');
    }
}
