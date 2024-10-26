<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('isAdmin', 0);
        return view('backend.user.index', [
            'users' => $users->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validateData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => [
                'required',
                'string',
                'min:8',  // Minimal 8 karakter
                'regex:/[a-z]/',      // Harus ada huruf kecil
                'regex:/[A-Z]/',      // Harus ada huruf besar
                'regex:/[0-9]/',      // Harus ada angka
                'regex:/[@$!%*#?&]/', // Harus ada karakter spesial
            ],
        ]);

        $validateData['password'] = bcrypt($validateData['password']);
        $validateData['isAdmin'] = '0';
        // return $validateData;
        User::create($validateData);
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('backend.user.edit', [
            'user' => User::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validateData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username' . $user->id,
            'password' => [
                'nullable',  // Membuat password opsional
                'string',
                'min:8',  // Minimal 8 karakter
                'regex:/[a-z]/',      // Harus ada huruf kecil
                'regex:/[A-Z]/',      // Harus ada huruf besar
                'regex:/[0-9]/',      // Harus ada angka
                'regex:/[@$!%*#?&]/', // Harus ada karakter spesial
            ],
        ]);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($validateData['password']);
        } else {
            unset($validateData['password']);
        }

        $user->update($validateData);
        return redirect()->route('user.index')->with('success', 'User berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
