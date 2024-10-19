<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">GKJW Jemaat Genteng</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="/" class="{{ $judul === 'Beranda' ? 'active' : '' }}">Beranda</a></li>
                {{-- <li><a href="/">Tentang Kami</a></li> --}}
                <li class="dropdown"><a href="#"><span>Profil</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="/sejarah" class="{{ $judul === 'Sejarah' ? 'active' : '' }}">Sejarah</a></li>
                        <li><a href="#">Profil Jemaat</a></li>
                        <li><a href="#">Profil Pendeta</a></li>
                        <li><a href="#">Kemajelisan</a></li>
                    </ul>
                </li>
                <li><a href="/warta-jemaat" class="{{ $judul === 'Warta Jemaat' ? 'active' : '' }}">Warta Jemaat</a>
                </li>
                <li><a href="/renungan">Renungan</a></li>
                <li><a href="/kabar-jemaat">Kabar Jemaat</a></li>
                <li><a href="/kontak" class="{{ $judul === 'Kontak' ? 'active' : '' }}">Kontak</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>
