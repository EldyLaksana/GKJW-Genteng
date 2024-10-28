@extends('frontend.layouts.main')

@section('container')
    {{-- <h1>Hello World</h1> --}}
    <section id="about" class="about section">

        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2" data-aos="fade-up" data-aos-delay="400">
                    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/img/img_h_6.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/img/img_h_7.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/img/img_h_8.jpg" class="d-block w-100" alt="...">
                            </div>
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
                <div class="col-lg-4 order-lg-1">
                    <span class="section-subtitle" data-aos="fade-up">Selamat Datang</span>
                    <h1 class="mb-4" data-aos="fade-up">
                        Di Website GKJW Jemaat Genteng
                    </h1>
                    <p data-aos="fade-up">
                        Kami menyambut Anda dengan sukacita. Di sini, Anda dapat menemukan informasi tentang ibadah,
                        kegiatan, dan pelayanan kami. Kami percaya setiap orang memiliki tempat dalam kasih Tuhan dan
                        berharap Anda merasa diterima serta terinspirasi untuk bertumbuh dalam iman.
                    </p>
                    <p data-aos="fade-up">
                        Jelajahi website kami atau kunjungi kami di gereja. Kami siap mendukung perjalanan iman Anda!
                    </p>
                    <p data-aos="fade-up"><strong>Tuhan Yesus memberkati!</strong></p>
                    {{-- <p class="mt-5" data-aos="fade-up">
                        <a href="#" class="btn btn-get-started">Get Started</a>
                    </p> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- About 2 Section -->
    <section id="about-2" class="about-2 section light-background">

        <div class="container">
            <div class="content">
                <div class="row justify-content-center">
                    <div class="table-responsive col-lg-10 mb-4">
                        <h2 class="text-center mb-3">Jadwal Kegiatan Gereja</h2>
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
            </div>
        </div>
    </section><!-- /About 2 Section -->

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            {{-- <p>Recent Posts</p> --}}
            <h1>Renungan</h1>
        </div><!-- End Section Title -->
        <div class="container">

            <div class="row gy-4">
                @foreach ($renungans as $renungan)
                    <div class="col-md-6 col-lg-4">
                        <div class="post-entry" data-aos="fade-up" data-aos-delay="100">
                            <a href="#" class="thumb d-block">
                                <img src="{{ asset($renungan->gambar ? 'storage/' . $renungan->gambar : 'assets/img/default.jpg') }}"
                                    alt="{{ $renungan->judul }}" class="img-fluid rounded">
                            </a>

                            <div class="post-content">
                                <div class="meta">
                                    <a href="#" class="cat">Renungan</a> •
                                    <span class="date">{{ $renungan->published_at->format('F d, Y') }}</span>
                                </div>
                                <h3><a href="#">{{ $renungan->judul }}</a></h3>
                                <p>{{ $renungan->excerpt }}</p>

                                <div class="d-flex author align-items-center">
                                    <div class="author-name">
                                        <strong class="d-block">{{ $renungan->sumber ?? 'Admin' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


                {{-- <div class="col-md-6 col-lg-4">
                    <div class="post-entry" data-aos="fade-up" data-aos-delay="200">
                        <a href="#" class="thumb d-block"><img src="assets/img/img_h_2.jpg" alt="Image"
                                class="img-fluid rounded"></a>

                        <div class="post-content">
                            <div class="meta">
                                <a href="#" class="cat">Renungan</a> •
                                <span class="date">July 20, 2020</span>
                            </div>
                            <h3><a href="#">There live the blind texts they live</a></h3>
                            <p>
                                Far far away, behind the word mountains, far from the countries
                                Vokalia and Consonantia, there live the blind texts.
                            </p>

                            <div class="d-flex author align-items-center">

                                <div class="author-name">
                                    <strong class="d-block">Winston Gold</strong>
                                    <span class="">Lead Product Designer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-md-6 col-lg-4">
                    <div class="post-entry" data-aos="fade-up" data-aos-delay="300">
                        <a href="#" class="thumb d-block"><img src="assets/img/img_h_3.jpg" alt="Image"
                                class="img-fluid rounded"></a>

                        <div class="post-content">
                            <div class="meta">
                                <a href="#" class="cat">Renungan</a> •
                                <span class="date">July 20, 2020</span>
                            </div>
                            <h3><a href="#">There live the blind texts they live</a></h3>
                            <p>
                                Far far away, behind the word mountains, far from the countries
                                Vokalia and Consonantia, there live the blind texts.
                            </p>

                            <div class="d-flex author align-items-center">
                                <div class="author-name">
                                    <strong class="d-block">Winston Gold</strong>
                                    <span class="">Lead Product Designer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section><!-- /Blog Posts Section -->

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            {{-- <p>Recent Posts</p> --}}
            <h1>Kabar Jemaat</h1>
        </div><!-- End Section Title -->
        <div class="container">

            <div class="row gy-4">
                <div class="col-md-6 col-lg-4">
                    <div class="post-entry" data-aos="fade-up" data-aos-delay="100">
                        <a href="#" class="thumb d-block"><img src="assets/img/img_h_4.jpg" alt="Image"
                                class="img-fluid rounded"></a>

                        <div class="post-content">
                            <div class="meta">
                                <a href="#" class="cat">Kabar Jemaat</a> •
                                <span class="date">July 20, 2020</span>
                            </div>
                            <h3><a href="#">There live the blind texts they live</a></h3>
                            <p>
                                Far far away, behind the word mountains, far from the countries
                                Vokalia and Consonantia, there live the blind texts.
                            </p>

                            <div class="d-flex author align-items-center">
                                {{-- <div class="pic">
                                    <img src="assets/img/team/team-3.jpg" alt="Image"
                                        class="img-fluid rounded-circle">
                                </div> --}}
                                <div class="author-name">
                                    <strong class="d-block">Winston Gold</strong>
                                    <span class="">Lead Product Designer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="post-entry" data-aos="fade-up" data-aos-delay="200">
                        <a href="#" class="thumb d-block"><img src="assets/img/img_h_2.jpg" alt="Image"
                                class="img-fluid rounded"></a>

                        <div class="post-content">
                            <div class="meta">
                                <a href="#" class="cat">Kabar Jemaat</a> •
                                <span class="date">July 20, 2020</span>
                            </div>
                            <h3><a href="#">There live the blind texts they live</a></h3>
                            <p>
                                Far far away, behind the word mountains, far from the countries
                                Vokalia and Consonantia, there live the blind texts.
                            </p>

                            <div class="d-flex author align-items-center">
                                {{-- <div class="pic">
                                    <img src="assets/img/team/team-2.jpg" alt="Image"
                                        class="img-fluid rounded-circle">
                                </div> --}}
                                <div class="author-name">
                                    <strong class="d-block">Winston Gold</strong>
                                    <span class="">Lead Product Designer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="post-entry" data-aos="fade-up" data-aos-delay="300">
                        <a href="#" class="thumb d-block"><img src="assets/img/img_h_3.jpg" alt="Image"
                                class="img-fluid rounded"></a>

                        <div class="post-content">
                            <div class="meta">
                                <a href="#" class="cat">Kabar Jemaat</a> •
                                <span class="date">July 20, 2020</span>
                            </div>
                            <h3><a href="#">There live the blind texts they live</a></h3>
                            <p>
                                Far far away, behind the word mountains, far from the countries
                                Vokalia and Consonantia, there live the blind texts.
                            </p>

                            <div class="d-flex author align-items-center">
                                {{-- <div class="pic">
                                    <img src="assets/img/team/team-1.jpg" alt="Image"
                                        class="img-fluid rounded-circle">
                                </div> --}}
                                <div class="author-name">
                                    <strong class="d-block">Winston Gold</strong>
                                    <span class="">Lead Product Designer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Blog Posts Section -->
@endsection
