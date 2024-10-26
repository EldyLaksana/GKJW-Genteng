<?php

namespace App\Http\Controllers;

use App\Models\Renungan;
use Illuminate\Http\Request;
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

        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 250, '...');

        if ($request->filled('published_at')) {
            $validateData['status_publikasi'] = 'scheduled';
            $validateData['published_at'] = $request->published_at;
        } else {
            $validateData['status_publikasi'] = 'published';
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
        return view('backend.renungan.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Renungan $renungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Renungan $renungan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Renungan $renungan)
    {
        //
    }
}
