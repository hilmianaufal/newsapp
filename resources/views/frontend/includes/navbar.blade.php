<nav class="navbar navbar-expand-lg navbar-light bg-light  shadow-sm sticky-top">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand fw-bold text-primary" href="/">KebonCintaNet</a>

    <!-- Toggle untuk mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu dan Search -->
    <div class="collapse  navbar-collapse" id="navbarContent">
      <!-- Menu Tengah -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item ">
          <a class="nav-link active" href="/">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/kategori/pendidikan-islam">Pendidikan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/kategori/beasiswa">Beasiswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/kategori/khazanah">Khazanah</a>
        </li>

        <!-- Dropdown Kategori -->
       <li class="nav-item dropdown dropdown-animated">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">Kategori</a>
            <ul class="dropdown-menu shadow fade-down">
                @foreach ($kategori as $item)
                    
                <li><a class="dropdown-item" href="/kategori/{{ $item->slug }}"><i class="bi bi-bank2 me-2 text-primary"></i> {{ $item->nama_kategori }}</a></li>
                @endforeach
       
            </ul>
            </li>
         @guest
                    <!-- Jika belum login -->
                    <li class="nav-item">
                    <a class="nav-link" class="" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
                    </li>
                @else
                    <!-- Jika sudah login -->
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->nama }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a></li>
                    </ul>
                    </li>

                    <!-- Form logout tersembunyi -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    </form>
                @endguest
      </ul>
      <!-- Search -->
    <form class="d-flex position-relative align-items-center gap-2" role="search" id="searchForm">
        <input class="form-control me-2 rounded-pill" type="search" placeholder="Cari berita..." id="searchInput" autocomplete="off">

        <!-- Tombol Search dengan ikon -->
        <button class="btn-search rounded-circle border-0 bg-transparent" type="button"  aria-label="Cari">
            <i class="bi bi-search fs-5 text-primary"></i>
        </button>

        <!-- Tombol toggle mode gelap -->
        <button id="modeToggle" type="button" class="btn-darkmode rounded-circle border-0 bg-transparent" aria-label="Toggle Mode">
            🌙
        </button>

        <!-- Hasil pencarian -->
        <div id="searchResults" class="list-group position-absolute top-100 start-0 w-100 mt-1 shadow-sm d-none" style="z-index: 1000;"></div>
        </form>


    </div>
  </div>
</nav>