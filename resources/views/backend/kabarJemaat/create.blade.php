@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Masukan Kabar Jemaat</h1>
    </div>

    <section class="section">
        <div class="card mb-3">
            <div class="card-header d-grid gap-2 d-lg-flex justify-content-lg-end">
                <a href="/dashboard/kabar-jemaat" type="button" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <form action="/dashboard/kabar-jemaat" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    <div class="mb-3 col-lg-6">
                        <label for="judul" class="form-label">Judul :</label>
                        <input type="text" name="judul" id="judul"
                            class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="slug" class="form-label">Slug :</label>
                        <input type="text" name="slug" id="slug"
                            class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" required>
                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="kategori" class="form-label">Kategori :</label>
                        <select name="kategori_id" id="kategori" class="form-select">
                            @foreach ($kategoris as $kategori)
                                @if (old('kategori_id') === $kategori->id)
                                    <option value="{{ $kategori->id }} selected">{{ $kategori->kategori }}</option>
                                @else
                                    <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="gambar" class="form-label">Gambar :</label>
                        <img class="gambar-preview img-fluid mb-3 col-sm-6">
                        <input type="file" name="gambar" id="gambar"
                            class="form-control @error('gambar') is-invalid @enderror" onchange="previewGambar()">
                        @error('gambar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="sumber_gambar" class="form-label">Sumber :</label>
                        <input type="text" class="form-control" placeholder="" name="sumber_gambar" id="sumber_gambar"
                            value="{{ old('sumber_gambar') }}">
                    </div>
                    <div class="mb-3 col-lg-8">
                        <label for="isi" class="form-label">Isi :</label>
                        <input type="hidden" id="isi" name="isi" value="{{ old('isi') }}">
                        <trix-editor input="isi"></trix-editor>
                    </div>
                    @if (Auth::user()->isAdmin === 1)
                        <div class="mb-3 col-lg-6">
                            <label for="embed" class="form-label">Embed Video :</label>
                            <input type="text" name="embed" id="embed"
                                class="form-control @error('embed') is-invalid @enderror" value="{{ old('embed') }}">
                            <small class="form-text text-muted">Jika ingin menambahkan video dapat diisi embed </small>
                        </div>
                    @endif
                    <div class="col-lg-6 mb-3">
                        <label for="sumber" class="form-label">Sumber :</label>
                        {{-- <input type="text" class="form-control" placeholder="" name="sumber" id="sumber"
                            value="{{ old('sumber') }}"> --}}
                        <textarea name="sumber" id="sumber" rows="1" class="form-control">{{ old('sumber') }}</textarea>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="status_publikasi" class="form-label">Status Publikasi :</label>
                        <select name="status_publikasi" id="status_publikasi" class="form-control">
                            <option value="Sekarang" {{ old('status_publikasi') == 'Sekarang' ? 'selected' : '' }}>
                                Sekarang
                            </option>
                            <option value="Jadwalkan" {{ old('status_publikasi') == 'Jadwalkan' ? 'selected' : '' }}>
                                Jadwalkan</option>
                            <option value="Draf" {{ old('status_publikasi') == 'Draf' ? 'selected' : '' }}>
                                Draf
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-6 mb-3" id="published_at_container" style="display: none">
                        <label for="published_at" class="form-label">Tanggal Publikasi :</label>
                        <input type="text" name="published_at" id="published_at" class="form-control"
                            placeholder="Pilih tanggal dan jam" value="{{ old('published_at') }}">
                        {{-- <small class="form-text text-muted">Biarkan kosong untuk mempublikasikan sekarang.</small> --}}
                    </div>
                </div>
                <div class="card-footer d-grid d-lg-flex justify-content-lg-end">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-circle-plus"></i>
                        Tambah</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.getElementById('judul').addEventListener('input', function() {
            var judul = this.value;
            var slug = judul.toLowerCase()
                .replace(/[^\w ]+/g, '') // Hapus karakter spesial
                .replace(/ +/g, '-'); // Ganti spasi dengan tanda -

            document.getElementById('slug').value = slug;
        });

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

        document.addEventListener('DOMContentLoaded', function() {
            const statusPublikasi = document.getElementById('status_publikasi');
            const publishedAtContainer = document.getElementById('published_at_container');

            // Tampilkan atau sembunyikan input published_at saat halaman dimuat
            togglePublishedAtInput();

            // Event listener untuk perubahan status publikasi
            statusPublikasi.addEventListener('change', togglePublishedAtInput);

            function togglePublishedAtInput() {
                if (statusPublikasi.value === 'Jadwalkan') {
                    publishedAtContainer.style.display = 'block';
                } else {
                    publishedAtContainer.style.display = 'none';
                }
            }

            // Inisialisasi Flatpickr pada input published_at
            flatpickr("#published_at", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                locale: {
                    firstDayOfWeek: 1 // Set awal minggu ke Senin
                }
            });
        });
    </script>
@endsection
