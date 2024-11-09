<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }
        return view('backend.carousel.index', [
            'carousel' => Carousel::all(),
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
        return view('backend.carousel.create');
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
            $validateData['carousel'] = $request->file('carousel')->store('foto-carousel');
        }

        Carousel::create($validateData);
        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carousel $carousel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carousel $carousel)
    {
        if (Auth::user()->isAdmin !== 1) {
            return redirect('/dashboard');
        }

        return view('backend.carousel.edit', [
            'carousel' => $carousel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carousel $carousel)
    {
        $validateData = $request->validate([
            'carousel' => 'image|file|mimes:jpg,jpeg,png|max:5000',
        ]);

        if ($request->hasFile('carousel')) {

            if ($carousel->carousel) {
                Storage::delete($carousel->carousel);
            }
            $validateData['carousel'] = $request->file('carousel')->store('foto-carousel');
        }

        $carousel->update($validateData);
        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel $carousel)
    {
        //
    }
}
