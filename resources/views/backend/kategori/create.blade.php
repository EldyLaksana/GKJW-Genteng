@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Masukan Kategori</h1>
    </div>

    <section class="section">
        <div class="card mb-3">
            <div class="card-header d-grid gap-2 d-lg-flex justify-content-lg-end">
                <a href="/dashboard/kategori" type="button" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <form action="/dashboard/kategori" method="post">
                @csrf
                <div class="card-body">
                    <div class="mb-3 col-lg-4">
                        <label for="kategori" class="form-label">Kategori :</label>
                        <input type="text" name="kategori" id="kategori"
                            class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori') }}"
                            required>
                        @error('kategori')
                            <div class="invalid-feedback">
                                Harus diisi
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-4">
                        <label for="slug" class="form-label">Slug :</label>
                        <input type="text" name="slug" id="slug"
                            class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" required>
                        @error('slug')
                            <div class="invalid-feedback">
                                Harus diisi
                            </div>
                        @enderror
                    </div>

                </div>
                <div class="card-footer d-grid d-lg-flex justify-content-lg-end">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-circle-plus"></i>
                        Tambah</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.getElementById('kategori').addEventListener('input', function() {
            var kategori = this.value;
            var slug = kategori.toLowerCase()
                .replace(/[^\w ]+/g, '') // Hapus karakter spesial
                .replace(/ +/g, '-'); // Ganti spasi dengan tanda -

            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
