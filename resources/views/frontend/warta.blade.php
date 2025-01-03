@extends('frontend.layouts.main')

@section('title', $title)

@section('container')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <h1>Warta Jemaat</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li class="current">Warta Jemaat</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- About 2 Section -->
    <section id="about-2" class="about-2 section">
        <div class="container">
            <div class="content">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8 mb-4" data-aos="fade-up">
                        <div class="text-center">
                            <h2 class="mb-3">Warta Jemaat</h2>
                            @if (!empty($warta->embed))
                                <div class="ratio ratio-16x9">
                                    {!! $warta->embed !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <h3 class="text-center mb-4 mt-4" data-aos="fade-up">Warta Jemaat Sebelumnya</h3>
                    <div class="d-flex flex-wrap flex-md-row flex-column justify-content-center" data-aos="fade-up">
                        @foreach ($wartaSebelumnya as $item)
                            <div class="col-lg-4 col-md-6 col-12 mb-4" data-aos="fade-up">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="ratio ratio-16x9">
                                            {!! $item->embed !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section><!-- /About 2 Section -->
@endsection
