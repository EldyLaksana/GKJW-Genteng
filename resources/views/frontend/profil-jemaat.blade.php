@extends('frontend.layouts.main')

@section('title', $title)

@section('container')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <h1>Profil Jemaat</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li class="current">Profil Jemaat</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <section id="about-2" class="about-2 section">
        <div class="container">
            <div class="content">
                <div class="row justify-content-center mb-4">
                    <!-- Kolom gambar (urutan pertama, gambar di atas teks) -->
                    <div class="col-lg-9 col-md-10 order-1 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
                            {{-- <div class="img">
                                <img src="assets/img/img_h_3.jpg" alt="circle image" class="img-fluid">
                            </div> --}}
                            <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($carousel as $index => $item)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $item->carousel) }}" class="d-block w-100"
                                                alt="carousel">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom teks (urutan kedua, di bawah gambar) -->
                    <div class="col-lg-12 col-md-12 order-2" data-aos="fade-up">
                        <div class="px-3">
                            <h2 class="content-title text-start">
                                Profil GKJW Jemaat Genteng
                            </h2>

                            <p><strong>Alamat:</strong> Jl. Kelud no. 7, Genteng Kulon, Genteng, Banyuwangi, 68465</p>
                            <p><strong>Kontak:</strong> 081234567890</p>
                            <p><strong>Website:</strong> gkjwgenteng.or.id</p>

                            <br>

                            <h2 class="content-title text-start">
                                Pelayanan GKJW Jemaat Genteng
                            </h2>

                            <p>GKJW jemaat Genteng memiliki jemaat sebanyak 150 orang. GKJW Jemaat Genteng memiliki 2
                                pepanthan yaitu Pepanthan Parastembok dan Pepanthan Jambewangi. GKJW Jemaat Genteng masuk
                                dalam Majelis Daerah Besuki Timur</p>

                            <br>

                            <h2 class="content-title text-start">Jadwal Kegiatan Gereja</h2>
                            <div class="row justify-content-center">
                                <div class="table-responsive col-lg-10 mb-4">
                                    {{-- <h2 class="text-center mb-3">Jadwal Kegiatan Gereja</h2> --}}
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kegiatan</th>
                                                <th scope="col">Hari</th>
                                                <th scope="col">Jam</th>
                                                <th scope="col">Tempat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jadwal as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->kegiatan }}</td>
                                                    <td>{{ $item->hari }}</td>
                                                    <td>{{ $item->jam }}</td>
                                                    <td>{{ $item->tempat }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <br>

                            <h2 class="content-title text-start">Komisi Pelayanan</h2>
                            <ul>
                                <li><strong>Komisi Anak-Anak:</strong> Membimbing dan mendidik anak-anak dalam iman Kristen.
                                </li>
                                <li><strong>Komisi Pemuda:</strong> Program untuk mendukung perkembangan iman dan
                                    kepemimpinan pemuda.</li>
                                <li><strong>Komisi Wanita:</strong> Kegiatan rohani dan sosial untuk wanita jemaat.</li>
                                <li><strong>Komisi Pria:</strong> Program pembinaan rohani dan pelayanan sosial untuk pria
                                    jemaat.</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /About 2 Section -->

@endsection
