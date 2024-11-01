<?php

namespace App\Http\Controllers;

use App\Models\WartaJemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class WartaJemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }
        return view('backend.wartaJemaat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validateData = $request->validate([
            'embed' => 'required',
        ]);

        WartaJemaat::create($validateData);
        return back()->with('success', 'Warta jemaat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(WartaJemaat $wartaJemaat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WartaJemaat $wartaJemaat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WartaJemaat $wartaJemaat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WartaJemaat $wartaJemaat)
    {
        //
    }
}
