@extends('frontend.layouts.main')

@section('title', $title)

@section('container')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <h1>Sejarah</h1>
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
                    <div class="col-lg-10 col-md-10 order-1 mb-4">
                        <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
                            <div class="img">
                                <img src="assets/img/img_h_3.jpg" alt="circle image" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom teks (urutan kedua, di bawah gambar) -->
                    <div class="col-lg-12 col-md-12 order-2" data-aos="fade-up">
                        <div class="px-3">
                            <h2 class="content-title text-start">
                                Profil GKJW Jemaat Genteng
                            </h2>

                            <p><strong>Nama Gereja:</strong> Gereja Kristen Jawa Wetan (GKJW) Jemaat Genteng</p>
                            <p><strong>Alamat:</strong> [Alamat gereja]</p>
                            <p><strong>Kontak:</strong> [Nomor telepon/email]</p>
                            <p><strong>Website:</strong> [URL website jika ada]</p>
                            <p><strong>Jumlah Jemaat:</strong> [Jumlah jemaat]</p>

                            <h2 class="content-title text-start">Kegiatan Utama</h2>
                            <ul>
                                <li><strong>Ibadah Minggu:</strong> Ibadah rutin setiap Minggu untuk seluruh jemaat.</li>
                                <li><strong>Sekolah Minggu:</strong> Pendidikan Kristen untuk anak-anak.</li>
                                <li><strong>Persekutuan Doa:</strong> Kegiatan doa bersama untuk memperdalam iman.</li>
                            </ul>

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

                            <h2 class="content-title text-start">Pelayanan Sosial</h2>
                            <p>Gereja aktif dalam berbagai kegiatan bakti sosial dan membantu masyarakat sekitar melalui
                                program bantuan dan pemberdayaan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /About 2 Section -->

@endsection
