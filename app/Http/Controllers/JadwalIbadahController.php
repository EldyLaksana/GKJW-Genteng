<?php

namespace App\Http\Controllers;

use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class JadwalIbadahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalIbadah = JadwalIbadah::all();
        return view('backend.jadwalIbadah.index', [
            'jadwalIbadah' => $jadwalIbadah,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.jadwalIbadah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validateData = $request->validate([
            'kegiatan' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'tempat' => 'required',
        ]);

        JadwalIbadah::create($validateData);
        return redirect()->route('jadwal-ibadah.index')->with('success', 'Jadwal kegiatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalIbadah $jadwalIbadah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalIbadah $jadwalIbadah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalIbadah $jadwalIbadah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalIbadah $jadwalIbadah)
    {
        //
    }
}
