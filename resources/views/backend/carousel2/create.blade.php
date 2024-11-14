@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Masukan Carousel</h1>
    </div>

    <section class="section">
        <div class="card mb-3">
            <div class="card-header d-grid gap-2 d-lg-flex justify-content-lg-end">
                <a href="/dashboard/carousel2" type="button" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <form action="/dashboard/carousel2" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3 col-lg-6">
                        <label for="carousel" class="form-label">Carousel :</label>
                        <img class="gambar-preview img-fluid mb-3 col-sm-6" src="{{ asset('assets/img/picture.png') }}">
                        <input type="file" name="carousel" id="carousel"
                            class="form-control @error('carousel') is-invalid @enderror" onchange="previewGambar()">
                        @error('carousel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="card-footer d-grid d-lg-flex justify-content-lg-end">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-circle-plus"></i>
                            Tambah</button>
                    </div>
            </form>
        </div>
    </section>
    <script>
        function previewGambar() {
            const gambar = document.querySelector('#carousel');
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
