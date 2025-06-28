<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Berita</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-color: #f8f9fa;
    }

    main {
      flex: 1;
    }

    .news-title {
      font-size: 2rem;
      font-weight: 700;
    }

    .news-meta {
      font-size: 0.9rem;
      color: #6c757d;
    }

    .card-img-top {
      object-fit: cover;
      height: 200px;
    }

    .fade-down {
      animation: fadeDown 0.3s ease-in-out;
    }

    @keyframes fadeDown {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .navbar-nav .nav-link {
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #0d6efd;
    }

    .dropdown-menu .dropdown-item:hover {
      background-color: #f8f9fa;
    }

    body.dark-mode {
      background-color: #121212;
      color: #eaeaea;
    }

    .dark-mode .navbar, 
    .dark-mode .dropdown-menu {
      background-color: #1f1f1f !important;
    }

    .dark-mode .nav-link,
    .dark-mode .dropdown-item {
      color: #eaeaea !important;
    }

    .dark-mode .dropdown-item:hover {
      background-color: #333;
    }
  </style>
</head>
<body>
  
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="/">KebonCintaNet</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
           <li class="nav-item">
          <a class="nav-link" href="/kategori/pendidikan-islam">Pendidikan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/kategori/beasiswa">Beasiswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/kategori/khazanah">Khazanah</a>
        </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Kategori</a>
            <ul class="dropdown-menu shadow fade-down">
              @foreach ($jmlKategori as $item)
              <li><a class="dropdown-item" href="/kategori/{{ $item->slug }}"><i class="bi bi-bank2 me-2 text-primary"></i> {{ $item->nama_kategori }}</a></li>
              @endforeach
            </ul>
          </li>
         
          @guest
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a></li>
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->nama }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>
              </ul>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
          @endguest
        </ul>

        <form class="d-flex position-relative" id="searchForm" role="search">
          <input class="form-control me-2 rounded-pill" type="search" placeholder="Cari berita..." id="searchInput" autocomplete="off">
          <button class="btn btn-outline-primary rounded-pill" type="submit"><i class="bi bi-search"></i></button>
          <div id="searchResults" class="list-group position-absolute top-100 start-0 w-100 mt-1 shadow-sm d-none" style="z-index: 1000;"></div>
          <button id="modeToggle" class="btn btn-sm p-2">🌙</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Konten Utama -->
  <main>
    @yield('kategori')
  </main>

  <!-- Footer -->
<footer class="footer-area footer-padding bg-dark text-light">
    <div class="container">
        <div class="row gy-4">
            <!-- Kolom 1: Logo & Kontak -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-logo mb-3">
                    {{-- <a href="/"> --}}
                        {{-- <img src="assets/img/logo/logo2_footer.png" alt="Logo" style="max-height: 50px;"> --}}
                        <h1>KebonCintaNet</h1>
                    {{-- </a> --}}
                </div>
                <p class="small mb-2 text-white">
                    Kami menyediakan artikel terbaru dan terpercaya untuk Anda. Kunjungi kami dan dapatkan informasi terbaik.
                </p>
                <ul class="list-unstyled small">
                    <li><i class="fas fa-map-marker-alt me-2 text-warning"></i> Jl. Urip Sumoharjo No.18</li>
                    <li><i class="fas fa-phone-alt me-2 text-warning"></i> 087724345243  </li>
                    <li><i class="fas fa-envelope me-2 text-warning"></i> pondokkeboncinta@gmail.com</li>
                </ul>
                <div class="footer-social mt-3">
                    <a href="#"><i class="fab fa-facebook-f text-light me-3"></i></a>
                    <a href="#"><i class="fab fa-instagram text-light me-3"></i></a>
                    <a href="#"><i class="fab fa-twitter text-light"></i></a>
                </div>
            </div>

            <!-- Kolom 2: Kategori Populer -->
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-3">Kategori Populer</h5>
                <ul class="list-unstyled">
                    @foreach ($jmlKategori as $item)
                        
                    <li><a href="/kategori/{{ $item->slug }}" class="text-decoration-none text-light d-flex align-items-center mb-2">
                        <i class="fas fa-newspaper me-2 text-warning"></i>{{ $item->nama_kategori }}
                    </a></li>
                    @endforeach
                    
                </ul>
            </div>

            <!-- Kolom 3: Kategori Lain -->
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-3">Kategori Lainnya</h5>
                <ul class="list-unstyled">
                    @foreach ($jmlKategori as $item)
                        
                    <li><a href="/kategori/{{ $item->slug }}" class="text-decoration-none text-light d-flex align-items-center mb-2">
                        <i class="fas fa-newspaper me-2 text-warning"></i>{{ $item->nama_kategori }}
                    </a></li>
                    @endforeach
                    
                </ul>
            </div>
        </div>

        <hr class="text-secondary my-4">

        <div class="row">
            <div class="col-md-6 small">
                <p class="mb-0">&copy; {{ now()->year }} All rights reserved. Developed by <a href="#" class="text-warning">Hilmi An Naufal</a></p>
            </div>
            <div class="col-md-6 text-md-end small">
                <a href="#" class="text-light me-3">Terms</a>
                <a href="#" class="text-light me-3">Privacy</a>
                <a href="#" class="text-light">Contact</a>
            </div>
        </div>
    </div>
</footer>
  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#searchInput').on('keyup', function () {
        let query = $(this).val();
        if (query.length > 2) {
          $.ajax({
            url: "{{ route('search.suggestions') }}",
            method: "GET",
            data: { q: query },
            success: function (data) {
              let output = '';
              if (data.length > 0) {
                data.forEach(item => {
                  output += `<a href="/detail/${item.slug}" class="list-group-item list-group-item-action">${item.judul}</a>`;
                });
              } else {
                output = '<div class="list-group-item text-muted">Tidak ditemukan</div>';
              }
              $('#searchResults').html(output).removeClass('d-none');
            }
          });
        } else {
          $('#searchResults').addClass('d-none');
        }
      });

      $(document).on('click', function (e) {
        if (!$(e.target).closest('#searchForm').length) {
          $('#searchResults').addClass('d-none');
        }
      });
    });

    // Toggle mode
    const toggle = document.getElementById('modeToggle');
    toggle.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      toggle.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init();</script>
</body>
</html>
