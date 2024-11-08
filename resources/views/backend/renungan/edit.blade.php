@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Renungan</h1>
    </div>

    <section class="section">
        <div class="card mb-3">
            <div class="card-header d-grid gap-2 d-lg-flex justify-content-lg-end">
                <a href="/dashboard/renungan" type="button" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <form action="/dashboard/renungan/{{ $renungan->slug }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="mb-3 col-lg-6">
                        <label for="judul" class="form-label">Judul :</label>
                        <input type="text" name="judul" id="judul"
                            class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $renungan->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="slug" class="form-label">Slug :</label>
                        <input type="text" name="slug" id="slug"
                            class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug', $renungan->slug) }}" required>
                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="gambar" class="form-label">Gambar :</label>
                        <input type="hidden" name="gambarLama" value="{{ $renungan->gambar }}">
                        @if ($renungan->gambar)
                            <img src="{{ asset('storage/' . $renungan->gambar) }}"
                                class="gambar-preview img-fluid mb-3 col-sm-6 d-block">
                        @else
                            <img class="gambar-preview img-fluid mb-3 col-sm-6">
                        @endif
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
                            value="{{ old('sumber_gambar', $renungan->sumber_gambar) }}">
                    </div>
                    <div class="mb-3 col-lg-8">
                        <label for="renungan" class="form-label">Renungan :</label>
                        <input type="hidden" id="renungan" name="renungan"
                            value="{{ old('renungan', $renungan->renungan) }}">
                        <trix-editor input="renungan"></trix-editor>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="sumber" class="form-label">Sumber :</label>
                        <input type="text" class="form-control" placeholder="" name="sumber" id="sumber"
                            value="{{ old('sumber', $renungan->sumber) }}">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="status_publikasi" class="form-label">Status Publikasi :</label>
                        <select name="status_publikasi" id="status_publikasi" class="form-control">
                            <option value="Sekarang"
                                {{ old('status_publikasi', $renungan->status_publikasi) == 'Sekarang' ? 'selected' : '' }}>
                                Sekarang
                            </option>
                            <option value="Jadwalkan"
                                {{ old('status_publikasi', $renungan->status_publikasi) == 'Jadwalkan' ? 'selected' : '' }}>
                                Jadwalkan</option>
                            <option value="Draf"
                                {{ old('status_publikasi', $renungan->status_publikasi) == 'Draf' ? 'selected' : '' }}>Draf
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-6 mb-3" id="published_at_container"
                        style="display: {{ old('status_publikasi', $renungan->status_publikasi) == 'Jadwalkan' ? 'block' : 'none' }};">
                        <label for="published_at" class="form-label">Tanggal Publikasi :</label>
                        <input type="text" name="published_at" id="published_at" class="form-control"
                            placeholder="Pilih tanggal dan jam" value="{{ old('published_at', $renungan->published_at) }}">
                        {{-- <small class="form-text text-muted">Biarkan kosong untuk mempublikasikan sekarang.</small> --}}
                    </div>
                </div>
                <div class="card-footer d-grid d-lg-flex justify-content-lg-end">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen"></i>
                        Ubah</button>
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
