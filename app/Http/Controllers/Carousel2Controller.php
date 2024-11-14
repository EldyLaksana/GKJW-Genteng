<?php

namespace App\Http\Controllers;

use App\Models\Carousel2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Carousel2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }

        return view('backend.carousel2.index', [
            'carousel' => Carousel2::all(),
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

        return view('backend.carousel2.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'carousel' => 'image|file|mimes:jpg,jpeg,png|max:5000',
        ]);

        if ($request->file('carousel')) {
            $validateData['carousel'] = $request->file('carousel')->store('foto-carousel2');
        }

        Carousel2::create($validateData);
        return redirect()->route('carousel2.index')->with('success', 'Carousel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carousel2 $carousel2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carousel2 $carousel2)
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }

        return view('backend.carousel.edit', [
            'carousel' => $carousel2,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carousel2 $carousel2)
    {
        $validateData = $request->validate([
            'carousel' => 'image|file|mimes:jpg,jpeg,png|max:5000',
        ]);

        if ($request->hasFile('carousel')) {

            if ($carousel2->carousel) {
                Storage::delete($carousel2->carousel);
            }
            $validateData['carousel'] = $request->file('carousel')->store('foto-carousel2');
        }

        $carousel2->update($validateData);
        return redirect()->route('carousel2.index')->with('success', 'Carousel berhasil diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel2 $carousel2)
    {
        // return $carousel;
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }

        if ($carousel2->carousel) {
            Storage::delete($carousel2->carousel);
        }

        Carousel2::destroy($carousel2->id);

        return redirect()->route('carousel2.index')->with('danger', 'Carousel berhasil dihapus');
    }
}
