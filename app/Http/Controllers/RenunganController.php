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
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }
        $renungan = Renungan::query();
        // dd(request('judul'));
        if (request('judul')) {
            $renungan->where('renungans.judul', 'like', '%' . request('judul') . '%');
        }

        $renungan = $renungan->latest()->paginate(10);

        return view('backend.renungan.index', [
            'renungan' => $renungan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }
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
            'status_publikasi' => 'nullable',
            'published_at' => 'nullable|date',
        ]);
        // return ($validateData);
        // dd($validateData);
        if ($request->file('gambar')) {
            $validateData['gambar'] = $request->file('gambar')->store('gambar-renungan');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->renungan), 250, '...');

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

        // return ($validateData);

        Renungan::create($validateData);

        return redirect()->route('renungan.index')->with('success', 'Renungan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Renungan $renungan)
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }
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
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }
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
            'status_publikasi' => 'nullable',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('gambar')) {
            // Jika ada file gambar baru, simpan file baru dan hapus yang lama
            if ($renungan->gambar) {
                Storage::delete($renungan->gambar);
            }
            $validateData['gambar'] = $request->file('gambar')->store('gambar-renungan');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->renungan), 250, '...');

        // Tentukan status publikasi dan published_at berdasarkan input tanggal
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
