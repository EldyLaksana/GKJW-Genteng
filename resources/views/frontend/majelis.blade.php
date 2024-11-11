@extends('frontend.layouts.main')

@section('title', $title)

@section('container')
    <div class="page-title light-background">
        <div class="container">
            <h1>Majelis Jemaat</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li class="current">Majelis Jemaat</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($majelis as $item)
                        <div class="col-lg-3 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('assets/img/pastor.png') }}"
                                class="img-fluid" alt="{{ $item->nama }}">
                            <div class="portfolio-info">
                                <h4>{{ $item->nama }}</h4>
                                <p>{{ $item->jabatan }}</p>
                                {{-- <a href="assets/img/masonry-portfolio/masonry-portfolio-1.jpg" title="App 1"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a> --}}
                            </div>
                        </div><!-- End Portfolio Item -->
                    @endforeach
                </div><!-- End Portfolio Container -->

            </div>

        </div>

    </section><!-- /Portfolio Section -->
@endsection
