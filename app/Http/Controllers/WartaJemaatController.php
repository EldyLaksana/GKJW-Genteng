<?php

namespace App\Http\Controllers;

use App\Models\WartaJemaat;
use Illuminate\Http\Request;

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
        return view('backend.wartaJemaat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request;
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
