@extends('frontend.layouts.main')

@section('container')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <h1>Renungan</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li class="current">Renungan</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts 2 Section -->
    <section id="blog-posts-2" class="blog-posts-2 section">

        <div class="container">

            <div class="row gy-5">

                @foreach ($renungans as $renungan)
                    <div class="col-lg-4 col-md-6">
                        <article>

                            <div class="post-img">
                                <a href="/renungan/{{ $renungan->slug }}" class="thumb d-block">
                                    <img src="{{ asset($renungan->gambar ? 'storage/' . $renungan->gambar : 'assets/img/default.jpg') }}"
                                        alt="{{ $renungan->judul }}" class="img-fluid rounded">
                                </a>
                            </div>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><a href="#">Renungan</a></li>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-dot"></i>
                                        <a href="#">
                                            <time datetime="{{ $renungan->published_at->toIso8601String() }}">
                                                {{ $renungan->published_at->translatedFormat('j F Y') }}
                                            </time>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <h2 class="title">
                                <a href="/renungan/{{ $renungan->slug }}">{{ $renungan->judul }}</a>
                            </h2>

                            <p>{{ str_replace('&nbsp;', ' ', $renungan->excerpt) }}</p>

                        </article>
                    </div><!-- End post list item -->
                @endforeach

                <div class="d-flex justify-content-center pagination">
                    {{ $renungans->links() }}
                </div>

                {{-- <div class="col-lg-4 col-md-6">

                    <article>

                        <div class="post-img">
                            <img src="assets/img/blog/blog-2.jpg" alt="" class="img-fluid">
                        </div>

                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center"><a href="blog-details.html">Fashion</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-dot"></i> <a
                                        href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                            </ul>
                        </div>

                        <h2 class="title">
                            <a href="blog-details.html">Nisi magni odit consequatur autem nulla dolorem</a>
                        </h2>

                    </article>

                </div><!-- End post list item --> --}}

                {{-- <div class="col-lg-4 col-md-6">

                    <article>

                        <div class="post-img">
                            <img src="assets/img/blog/blog-3.jpg" alt="" class="img-fluid">
                        </div>

                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center"><a href="blog-details.html">Laws</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-dot"></i> <a
                                        href="blog-details.html"><time datetime="2022-01-01">Jul 5, 2022</time></a></li>
                            </ul>
                        </div>

                        <h2 class="title">
                            <a href="blog-details.html">Possimus soluta ut id suscipit soluta</a>
                        </h2>

                    </article>

                </div><!-- End post list item --> --}}

            </div><!-- End blog posts list -->

        </div>

    </section><!-- /Blog Posts 2 Section -->
@endsection
