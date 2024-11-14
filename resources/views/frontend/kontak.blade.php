@extends('frontend.layouts.main')

@section('title', $title)

@section('container')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <h1>Kontak</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li class="current">Kontak</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <div class="container" data-aos="fade">

            <div class="row gy-5 gx-lg-5">

                <div class="col-lg-4">

                    <div class="info">
                        <h3>Hubungi Kami</h3>
                        <p>Jika ada keperluan dapat menghubungi kontak di bawah ini</p>

                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>Alamat:</h4>
                                <p>Jalan Kelud no. 7, Genteng, Banyuwangi</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <p>admin@gkjwgenteng.org</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-phone flex-shrink-0"></i>
                            <div>
                                <h4>Telepon:</h4>
                                <p>+6281234567890</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                </div>

                <div class="col-lg-8 col-12">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d348.90569116290396!2d114.1459741546683!3d-8.360546668522874!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd155000a5b14e1%3A0xa8a123f9560c82ff!2sGKJW%20Jemaat%20Genteng!5e0!3m2!1sid!2sid!4v1729236170350!5m2!1sid!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen=""
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Contact Section -->
@endsection
