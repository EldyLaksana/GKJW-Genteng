<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#34bf49">
    <title>@yield('title')</title>
    {{-- <meta name="description"
        content="GKJW Jemaat Genteng adalah komunitas Kristen yang penuh kasih, berkomitmen untuk melayani Tuhan dan sesama melalui ibadah, pelayanan, dan pengajaran Alkitab. Bergabunglah dengan kami dalam pelayanan dan kegiatan rohani."> --}}
    <meta name="description" content="@yield('meta_description', 'GKJW Jemaat Genteng adalah komunitas Kristen yang melayani Tuhan.')">
    <meta name="keywords"
        content="renungan Kristen, ibadah gereja, komunitas rohani, pelayanan gereja, pengajaran Alkitab, doa bersama, kebaktian gereja, pelayanan rohani, kegiatan gereja, kekristenan, gereja, GKJW, Greja Kristen Jawi Wetan">


    {{-- Favicons --}}
    <link href="{{ asset('assets/img/logo-gkjw.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo-gkjw.png') }}" rel="apple-touch-icon">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Vendor CSS Files --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}">
    {{-- Main CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body>

    @include('frontend.layouts.header')

    <main id="main">
        @yield('container')
    </main>

    @include('frontend.layouts.footer')

    <!-- Scroll Top -->
    <a href="/" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- Vendos JS File --}}
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    {{-- Main JS File --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
