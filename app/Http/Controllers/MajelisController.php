<?php

namespace App\Http\Controllers;

use App\Models\Majelis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MajelisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }
        $majelis = Majelis::all();
        return view('backend.majelis.index', [
            'majelis' => $majelis,
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
        return view('backend.majelis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return ($request);
        $validateData = $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'image|file|mimes:jpg,jpeg,png|max:5000',
        ]);

        if ($request->file('foto')) {
            $validateData['foto'] = $request->file('foto')->store('foto-majelis');
        }

        Majelis::create($validateData);
        return redirect()->route('majelis.index')->with('success', 'Majelis berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Majelis $majelis)
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }
        $majelis = Majelis::findOrFail($id);
        return view('backend.majelis.edit', [
            'majelis' => $majelis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Majelis $majelis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Majelis $majelis)
    {
        //
    }
}
