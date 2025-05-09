<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <img src="{{ asset('assets/img/logo-gkjw.png') }}" alt="logo-gkjw">
            <h1 class="sitename">GKJW Jemaat Genteng</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="/" class="{{ $judul === 'Beranda' ? 'active' : '' }}">Beranda</a></li>
                {{-- <li><a href="/">Tentang Kami</a></li> --}}
                <li class="dropdown"><a href="#"
                        class="{{ in_array($judul, ['Sejarah', 'Majelis Jemaat', 'Profil Jemaat']) ? 'active' : '' }}"><span>Profil</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="/sejarah" class="{{ $judul === 'Sejarah' ? 'active' : '' }}">Sejarah</a></li>
                        <li><a href="/profil-jemaat" class="{{ $judul === 'Profil Jemaat' ? 'active' : '' }}">Profil
                                Jemaat</a></li>
                        {{-- <li><a href="#">Profil Pendeta</a></li> --}}
                        <li><a href="/majelis-jemaat" class="{{ $judul === 'Majelis Jemaat' ? 'active' : '' }}">Majelis
                                Jemaat</a>
                        </li>
                    </ul>
                </li>
                <li><a href="/warta-jemaat" class="{{ $judul === 'Warta Jemaat' ? 'active' : '' }}">Warta Jemaat</a>
                </li>
                <li><a href="/renungan" class="{{ $judul === 'Renungan' ? 'active' : '' }}">Renungan</a></li>
                {{-- <li class="dropdown"><a href="#"
                        class="{{ in_array($judul, ['Renungan Harian']) ? 'active' : '' }}"><span>Renungan</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="/renungan" class="{{ $judul === 'Renungan Harian' ? 'active' : '' }}">Renungan
                                Harian</a></li>
                        <li><a href="#" class="">Renungan Anak</a></li>
                    </ul>
                </li> --}}
                <li><a href="/kabar-jemaat" class="{{ $judul === 'Kabar Jemaat' ? 'active' : '' }}">Kabar Jemaat</a>
                </li>
                <li><a href="/kontak" class="{{ $judul === 'Kontak' ? 'active' : '' }}">Kontak</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>
