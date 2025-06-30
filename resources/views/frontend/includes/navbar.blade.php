<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
  <div class="container px-3 px-md-4">
    <!-- Logo -->
    <a class="navbar-brand" href="/">
      <img src="{{ asset($setting->logo ?? 'default-logo.png') }}" alt="Logo" height="40">
    </a>

    <!-- Toggle untuk mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu dan Search -->
    <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarContent">
      <!-- Menu Tengah -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="/kategori/berita">Berita</a></li>
        <li class="nav-item"><a class="nav-link" href="/kategori/pendidikan">Pendidikan</a></li>
        <li class="nav-item"><a class="nav-link" href="/kategori/khazanah">Khazanah</a></li>
        <li class="nav-item"><a class="nav-link" href="/kategori/prestasi">Prestasi</a></li>
        <li class="nav-item"><a class="nav-link" href="/kategori/teknologi">Teknologi</a></li>
        <li class="nav-item"><a class="nav-link" href="/kategori/parenting">Parenting</a></li>
        <li class="nav-item"><a class="nav-link" href="/kategori/beasiswa">Beasiswa</a></li>

        <!-- Dropdown Kategori -->
        <li class="nav-item dropdown dropdown-animated">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Kategori</a>
          <ul class="dropdown-menu shadow fade-down">
            @foreach ($kategori as $item)
              <li>
                <a class="dropdown-item" href="/kategori/{{ $item->slug }}">
                  <i class="bi bi-bank2 me-2 text-primary"></i>{{ $item->nama_kategori }}
                </a>
              </li>
            @endforeach
          </ul>
        </li>

        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
              <i class="fas fa-sign-in-alt fa-beat me-1 text-primary"></i>
            </a>
          </li>
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->nama }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
              </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
          </li>
        @endguest
      </ul>

      <!-- Form Search -->
      <form class="d-flex align-items-center gap-2 mt-2 mt-lg-0 w-100 w-lg-auto" role="search" id="searchForm">
        <input id="searchInput" class="form-control rounded-pill flex-grow-1" type="search" placeholder="Cari berita..." autocomplete="off">

        <!-- Tombol Search -->
        <button class="btn-search rounded-circle border-0 bg-transparent" type="button" aria-label="Cari">
          <i class="bi bi-search fs-5 text-primary"></i>
        </button>

        <!-- Tombol Mode Gelap -->
        <button id="modeToggle" type="button" class="btn-darkmode rounded-circle border-0 bg-transparent" aria-label="Toggle Mode">
          🌙
        </button>

        <!-- Hasil pencarian -->
        <div id="searchResults" class="list-group position-absolute top-100 start-0 w-100 mt-1 shadow-sm d-none" style="z-index: 1000;"></div>
      </form>
    </div>
  </div>
</nav>
