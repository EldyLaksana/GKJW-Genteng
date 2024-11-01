<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml"
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
    xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"
    xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">

    <!-- Static URLs -->
    <url>
        <loc>{{ url('/') }}</loc>
    </url>
    <url>
        <loc>{{ url('/kontak') }}</loc>
    </url>
    <url>
        <loc>{{ url('/renungan') }}</loc>
    </url>
    <url>
        <loc>{{ url('/warta-jemaat') }}</loc>
    </url>
    <url>
        <loc>{{ url('/kabar-jemaat') }}</loc>
    </url>

    <!-- Dynamic URLs for Renungan -->
    @foreach ($renungans as $renungan)
        <url>
            <loc>{{ url('/renungan/' . $renungan->slug) }}</loc>
            <lastmod>{{ $renungan->updated_at->toAtomString() }}</lastmod>
        </url>
    @endforeach

    <!-- Dynamic URLs for Kabar Jemaat -->
    @foreach ($kabarJemaats as $kabarJemaat)
        <url>
            <loc>{{ url('/kabar-jemaat/' . $kabarJemaat->slug) }}</loc>
            <lastmod>{{ $kabarJemaat->updated_at->toAtomString() }}</lastmod>
        </url>
    @endforeach

</urlset>
