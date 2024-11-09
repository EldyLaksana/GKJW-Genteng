@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ubah Majelis</h1>
    </div>

    <section class="section">
        <div class="card mb-3">
            <div class="card-header d-grid gap-2 d-lg-flex justify-content-lg-end">
                <a href="/dashboard/majelis" type="button" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <form action="/dashboard/majelis/{{ $majelis->id }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="mb-3 col-lg-6">
                        <label for="foto" class="form-label">Foto :</label>
                        <input type="hidden" name="gambarLama" value="{{ $majelis->foto }}">
                        @if ($majelis->gambar)
                            <img src="{{ asset('storage/' . $majelis->foto) }}"
                                class="gambar-preview img-fluid mb-3 col-sm-6 d-block">
                        @else
                            <img class="gambar-preview img-fluid mb-3 col-sm-6" src="{{ asset('assets/img/pastor.png') }}">
                        @endif

                        <input type="file" name="foto" id="foto"
                            class="form-control @error('foto') is-invalid @enderror" onchange="previewGambar()">
                        @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="nama" class="form-label">Nama :</label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $majelis->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label for="jabatan" class="form-label">Jabatan :</label>
                        <input type="text" name="jabatan" id="jabatan"
                            class="form-control @error('jabatan') is-invalid @enderror"
                            value="{{ old('jabatan', $majelis->jabatan) }}" required>
                        @error('jabatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="card-footer d-grid d-lg-flex justify-content-lg-end">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-circle-plus"></i>
                            Ubah</button>
                    </div>
            </form>
        </div>
    </section>

    <script>
        function previewGambar() {
            const gambar = document.querySelector('#gambar');
            const gambarPreview = document.querySelector('.gambar-preview');

            gambarPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(gambar.files[0]);

            oFReader.onload = function(oFREvent) {
                gambarPreview.src = oFREvent.target.result;
            }
        };
    </script>
@endsection
