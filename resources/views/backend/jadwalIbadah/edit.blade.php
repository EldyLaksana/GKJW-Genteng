@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Masukan Jadwal Ibadah</h1>
    </div>

    <section class="section">
        <div class="card mb-3">
            <div class="card-header d-grid gap-2 d-lg-flex justify-content-lg-end">
                <a href="/dashboard/jadwal-ibadah" type="button" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <form action="/dashboard/jadwal-ibadah/{{ $jadwal->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3 col-lg-6">
                        <label for="kegiatan" class="form-label">Kegiatan :</label>
                        <input type="text" name="kegiatan" id="kegiatan"
                            class="form-control @error('kegiatan') is-invalid @enderror"
                            value="{{ old('kegiatan', $jadwal->kegiatan) }}" required>
                        @error('kegiatan')
                            <div class="invalid-feedback">
                                Harus diisi
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="mb-3 col-lg-4">
                            <label for="hari" class="form-label">Hari :</label>
                            <input type="text" name="hari" id="hari"
                                class="form-control @error('hari') is-invalid @enderror"
                                value="{{ old('hari', $jadwal->hari) }}" required>
                            @error('hari')
                                <div class="invalid-feedback">
                                    Harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-2">
                            <label for="jam" class="form-label">Jam :</label>
                            <input type="text" name="jam" id="jam"
                                class="form-control @error('jam') is-invalid @enderror"
                                value="{{ old('jam', $jadwal->jam) }}" required>
                            @error('jam')
                                <div class="invalid-feedback">
                                    Harus diisi
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label for="tempat" class="form-label">Tempat :</label>
                        <input type="text" name="tempat" id="tempat"
                            class="form-control @error('tempat') is-invalid @enderror"
                            value="{{ old('tempat', $jadwal->tempat) }}" required>
                        @error('tempat')
                            <div class="invalid-feedback">
                                Harus diisi
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-grid d-lg-flex justify-content-lg-end">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen"></i> Ubah</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr("#jam", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i", // Format 24-jam
            time_24hr: true
        });
    </script>
@endsection
