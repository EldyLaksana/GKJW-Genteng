@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Masukan Warta Jemaat</h1>
    </div>

    <section class="section">
        <div class="card mb-3">
            <div class="card-header d-grid gap-2 d-lg-flex justify-content-lg-end">
                <a href="/dashboard" type="button" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <form action="/warta-jemaat" method="post">
                @csrf
                <div class="card-body">
                    <div class="mb-3 col-lg-6">
                        <label for="embed" class="form-label">Embed :</label>
                        <input type="text" name="embed" id="embed"
                            class="form-control @error('embed') is-invalid @enderror" value="{{ old('embed') }}" required>
                        @error('embed')
                            <div class="invalid-feedback">
                                Harus diisi
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-grid d-lg-flex justify-content-lg-end">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-shop"></i> Tambah</button>
                </div>
            </form>
        </div>
    </section>

    {{-- <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr("#jam", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i", // Format 24-jam
            time_24hr: true
        });
    </script> --}}
@endsection
