@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <section class="section">
        <div class="card mb-3">

            <div class="card-body">
                <div class="row">
                    <!-- Tabel Kabar Jemaat -->
                    <div class="table-responsive col-md-6">
                        <h5>Kabar Jemaat - Status: Draf & Jadwalkan</h5>
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr class="table-primary">
                                    <th>Judul</th>
                                    <th>Status Publikasi</th>
                                    <th>Tanggal Publikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kabarJemaats as $kabarJemaat)
                                    <tr>
                                        <td>{{ $kabarJemaat->judul }}</td>
                                        <td>{{ $kabarJemaat->status_publikasi }}</td>
                                        <td>{{ $kabarJemaat->published_at ?? 'Belum dijadwalkan' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Tabel Renungan, hanya untuk Admin -->
                    @if (auth()->user()->isAdmin == 1)
                        <div class="table-responsive col-md-6">
                            <h5>Renungan - Status: Draf & Jadwalkan</h5>
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr class="table-primary">
                                        <th>Judul</th>
                                        <th>Status Publikasi</th>
                                        <th>Tanggal Publikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($renungans as $renungan)
                                        <tr>
                                            <td>{{ $renungan->judul }}</td>
                                            <td>{{ $renungan->status_publikasi }}</td>
                                            <td>{{ $renungan->published_at ?? 'Belum dijadwalkan' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Tabel Top Kabar Jemaat -->
                    <div class="col-md-6">
                        <h5>Kabar Jemaat - Pembaca Terbanyak</h5>
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr class="table-primary">
                                    <th>Judul</th>
                                    <th>Jumlah Pembaca</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topKabarJemaats as $kabarJemaat)
                                    <tr>
                                        <td>{{ $kabarJemaat->judul }}</td>
                                        <td>{{ $kabarJemaat->view_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if (auth()->user()->isAdmin == 1)
                        <!-- Tabel Top Renungan -->
                        <div class="col-md-6">
                            <h5>Renungan - Pembaca Terbanyak</h5>
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr class="table-primary">
                                        <th>Judul</th>
                                        <th>Jumlah Pembaca</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topRenungans as $renungan)
                                        <tr>
                                            <td>{{ $renungan->judul }}</td>
                                            <td>{{ $renungan->view_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </section>
@endsection

<script>
    setInterval(function() {
        location.reload();
    }, 30000); // Refresh setiap 30 detik
</script>
