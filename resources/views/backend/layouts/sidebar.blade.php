<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Dashboard GKJW Genteng</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="#">
                        <span class="material-symbols-outlined">
                            account_circle
                        </span>
                        {{-- {{ Auth::user()->name }} --}}
                        Admin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="#">
                        <span class="material-symbols-outlined">
                            today
                        </span>
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    </a>
                </li>
                <hr class="my-3">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="/dashboard">
                        <span class="material-symbols-outlined">
                            home
                        </span>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page"
                        href="/dashboard/user">
                        <span class="material-symbols-outlined">
                            person_add
                        </span>
                        User
                    </a>
                </li>
                <hr class="my-3">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page"
                        href="/dashboard/jadwal-ibadah">
                        <span class="material-symbols-outlined">
                            event_note
                        </span>
                        Jadwal Ibadah
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page"
                        href="/dashboard/warta-jemaat/create">
                        <span class="material-symbols-outlined">
                            note_alt
                        </span>
                        Warta Jemaat
                    </a>
                </li>
                <hr class="my-3">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page"
                        href="/dashboard/renungan">
                        <span class="material-symbols-outlined">
                            docs
                        </span>
                        Renungan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page"
                        href="/dashboard/kabar-jemaat">
                        <span class="material-symbols-outlined">
                            article
                        </span>
                        Kabar Jemaat
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page"
                        href="/dashboard/kategori">
                        <span class="material-symbols-outlined">
                            category
                        </span>
                        Kategori
                    </a>
                </li>

            </ul>

            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="nav-link d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined">
                                door_open
                            </span>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
