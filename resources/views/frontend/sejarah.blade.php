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
                    <li class="current">Sejarah</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- About 2 Section -->
    <section id="about-2" class="about-2 section">

        <div class="container">
            <div class="content">
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-5 order-lg-2 mb-4">
                        <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
                            <div class="img">
                                <img src="assets/img/img_v_3.jpg" alt="circle image" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7" data-aos="fade-up">
                        <div class="px-3">
                            <h2 class="content-title text-start">
                                Sejarah Singkat GKJW Jemaat Genteng
                            </h2>
                            <p class="mb-3">
                                GKJW Jemaat Genteng, sebuah komunitas yang penuh kasih dan semangat, memiliki kisah
                                perjalanan yang menginspirasi. Semuanya bermula dari sekelompok kecil orang Kristen yang
                                bekerja sebagai perawat di rumah sakit. Di tengah kesibukan mereka, mereka merasakan
                                panggilan untuk saling menguatkan iman dan berbagi kasih kepada sesama.
                            </p>
                            <p class="mb-3">
                                Dengan semangat persaudaraan, mereka mulai mengadakan pertemuan rutin untuk beribadah dan
                                belajar Firman Tuhan. Persekutuan kecil ini kemudian tumbuh semakin besar dan menarik minat
                                orang-orang di sekitarnya untuk bergabung.
                            </p>
                            <p class="mb-3">
                                Seiring dengan bertambahnya jumlah anggota, kebutuhan akan tempat ibadah yang tetap semakin
                                mendesak. Namun, perjalanan untuk menemukan tempat yang cocok bukanlah tanpa tantangan.
                                Dengan penuh ketekunan dan dukungan dari masyarakat sekitar, akhirnya mereka berhasil
                                mewujudkan impian untuk memiliki rumah ibadah sendiri.
                            </p>
                            <p class="mb-3">
                                Dengan berdirinya gedung gereja, GKJW Jemaat Genteng semakin memantapkan langkahnya dalam
                                melayani masyarakat. Gereja tidak hanya menjadi tempat beribadah, tetapi juga menjadi pusat
                                kegiatan sosial dan kemasyarakatan.
                            </p>
                            <p class="mb-3">
                                Hingga kini, GKJW Jemaat Genteng terus berkembang dan menjadi berkat bagi banyak orang.
                                Dengan penuh syukur atas perjalanan yang telah dilalui, jemaat berkomitmen untuk terus setia
                                pada panggilan Tuhan dan menjadi saksi kasih-Nya bagi dunia.
                            </p>
                            <p class="mb-3">
                                GKJW Jemaat Genteng memiliki visi untuk menjadi gereja yang semakin relevan, inklusif, dan
                                berdampak bagi masyarakat. Gereja berkomitmen untuk terus tumbuh dan berkembang, serta
                                menjadi saluran berkat bagi generasi mendatang.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8" data-aos="fade-up">
                        <div class="ratio ratio-16x9">
                            <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/d-2nUwKUO34?si=BzTkL4-PjyzqpsFl"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /About 2 Section -->

@endsection
