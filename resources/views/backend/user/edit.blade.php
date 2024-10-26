@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Masukan User</h1>
    </div>

    <section class="section">
        <div class="card mb-3">
            <div class="card-header d-grid gap-2 d-lg-flex justify-content-lg-end">
                <a href="/dashboard/user" type="button" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <form action="/dashboard/user" method="post">
                @csrf
                <div class="card-body">
                    <div class="mb-3 col-lg-4">
                        <label for="nama" class="form-label">Nama :</label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $user->name) }}"
                            required>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="username" class="form-label">Username :</label>
                        <input type="text" name="username" id="username"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username', $user->username) }}" required>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="password" class="form-label">Password :</label>
                        <input type="text" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                            required>
                        <div class="form-text">
                            Kosongkan jika tidak ingin mengganti password
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-grid d-lg-flex justify-content-lg-end">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen"></i>
                        Edit</button>
                </div>
            </form>
        </div>
    </section>
@endsection
