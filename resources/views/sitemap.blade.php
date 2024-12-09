<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml"
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
    xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"
    xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">

    <!-- Static URLs -->
    <url>
        <loc>{{ url('/') }}</loc>
        <priority>1.0</priority>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc>{{ url('/sejarah') }}</loc>
        <priority>0.8</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ url('/profil-jemaat') }}</loc>
        <priority>0.8</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ url('/majelis-jemaat') }}</loc>
        <priority>0.8</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ url('/kontak') }}</loc>
        <priority>0.5</priority>
        <changefreq>yearly</changefreq>
    </url>
    <url>
        <loc>{{ url('/renungan') }}</loc>
        <priority>0.9</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ url('/warta-jemaat') }}</loc>
        <priority>0.9</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ url('/kabar-jemaat') }}</loc>
        <priority>0.9</priority>
        <changefreq>weekly</changefreq>
    </url>

    <!-- Dynamic URLs for Renungan -->
    @foreach ($renungans as $renungan)
        @if (isset($renungan->slug))
            <url>
                <loc>{{ url('/renungan/' . $renungan->slug) }}</loc>
                <lastmod>{{ $renungan->updated_at->toAtomString() }}</lastmod>
                <priority>0.8</priority>
                <changefreq>weekly</changefreq>
                @if (isset($renungan->gambar))
                    <image:image>
                        <image:loc>{{ url('storage/' . $renungan->gambar) }}</image:loc>
                        <image:title>{{ $renungan->judul }}</image:title>
                    </image:image>
                @endif
            </url>
        @endif
    @endforeach

    <!-- Dynamic URLs for Kabar Jemaat -->
    @foreach ($kabarJemaats as $kabarJemaat)
        @if (isset($kabarJemaat->slug))
            <url>
                <loc>{{ url('/kabar-jemaat/' . $kabarJemaat->slug) }}</loc>
                <lastmod>{{ $kabarJemaat->updated_at->toAtomString() }}</lastmod>
                <priority>0.8</priority>
                <changefreq>weekly</changefreq>
                @if (isset($kabarJemaat->gambar))
                    <image:image>
                        <image:loc>{{ url('storage/' . $kabarJemaat->gambar) }}</image:loc>
                        <image:title>{{ $kabarJemaat->judul }}</image:title>
                    </image:image>
                @endif
            </url>
        @endif
    @endforeach

    <!-- Dynamic URLs for Kategori -->
    @foreach ($categories as $category)
        @if (isset($category->slug))
            <url>
                <loc>{{ url('/kabar-jemaat/kategori/' . $category->slug) }}</loc>
                <lastmod>{{ $category->updated_at->toAtomString() }}</lastmod>
                <priority>0.7</priority>
                <changefreq>monthly</changefreq>
            </url>
        @endif
    @endforeach

</urlset>
