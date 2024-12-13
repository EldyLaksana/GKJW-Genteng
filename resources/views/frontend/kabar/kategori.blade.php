@extends('frontend.layouts.main')

@section('title', $title)

@section('container')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <h1>{{ $kategori->kategori }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/kabar-jemaat">Kabar Jemaat</a></li>
                    <li class="current">Kategori - {{ $kategori->kategori }}</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts 2 Section -->
    <section id="blog-posts-2" class="blog-posts-2 section">

        <div class="container">
            <!-- Form Pencarian -->
            <form action="/kabar-jemaat/kategori/{{ $kategori->slug }}" method="GET" class="search-form mb-4">
                <div class="input-group">
                    <input type="text" name="cari" class="form-control" placeholder="Cari judul kabar jemaat..."
                        value="{{ request('cari') }}">
                    <button type="submit" class="btn">Cari</button>
                </div>
            </form>
            <div class="row gy-5">

                @foreach ($kabarJemaats as $kabarJemaat)
                    <div class="col-lg-4 col-md-6">
                        <article>

                            <div class="post-img">
                                <a href="/kabar-jemaat/{{ $kabarJemaat->slug }}" class="thumb d-block">
                                    <img src="{{ asset($kabarJemaat->gambar ? 'storage/' . $kabarJemaat->gambar : 'assets/img/default.jpg') }}"
                                        alt="{{ $kabarJemaat->judul }}" class="img-fluid rounded">
                                </a>
                            </div>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><a href="#">Kabar Jemaat</a></li>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-dot"></i>
                                        <a href="#">
                                            <time datetime="{{ $kabarJemaat->published_at->toIso8601String() }}">
                                                {{ $kabarJemaat->published_at->translatedFormat('j F Y') }}
                                            </time>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <h2 class="title">
                                <a href="/kabar-jemaat/{{ $kabarJemaat->slug }}">{{ $kabarJemaat->judul }}</a>
                            </h2>

                            <p>{{ str_replace('&nbsp;', ' ', $kabarJemaat->excerpt) }}</p>

                            <div class="author-name">
                                <strong class="d-block">{{ $kabarJemaat->user->name ?? 'Admin' }}</strong>
                                {{-- <span class="">{{ $kabarJemaat->kategori->kategori }}</span> --}}
                                <span>
                                    <a href="/kabar-jemaat/kategori/{{ $kabarJemaat->kategori->slug }}">
                                        {{ $kabarJemaat->kategori->kategori }}
                                    </a>
                                </span>
                            </div>

                        </article>
                    </div><!-- End post list item -->
                @endforeach

                <div class="d-flex justify-content-center blog-pagination">
                    {{ $kabarJemaats->links() }}
                </div>

            </div><!-- End blog posts list -->

        </div>

    </section><!-- /Blog Posts 2 Section -->
@endsection
