<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }
        return view('backend.kategori.index', [
            'kategoris' => Kategori::all(),
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
        return view('backend.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // return $request;
        $validateData = $request->validate([
            'kategori' => 'required|unique:kategoris',
            'slug' => 'required',
        ]);

        Kategori::create($validateData);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }
        return view('backend.kategori.edit', [
            'kategori' => Kategori::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
        $validateData = $request->validate([
            'kategori' => 'required|unique:kategoris',
            'slug' => 'required',
        ]);

        Kategori::where('id', $id)->update($validateData);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kategori::class, 'slug', $request->kategori);
        return response()->json(['slug' => $slug]);
    }
}
