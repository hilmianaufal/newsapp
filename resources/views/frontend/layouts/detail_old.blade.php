<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Berita</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .news-title {
      font-size: 2rem;
      font-weight: 700;
    }
    .news-meta {
      font-size: 0.9rem;
      color: #6c757d;
    }
    .carousel-caption {
      background-color: rgba(0, 0, 0, 0.5);
      padding: 1rem;
      border-radius: 0.5rem;
    }
    .card-img-top {
      object-fit: cover;
      height: 200px;
    }
    .navbar-nav .nav-link {
  font-weight: 500;
  transition: all 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
        color: #0d6efd;
        }
        /* Animasi Fade-Down */
        .fade-down {
        animation: fadeDown 0.3s ease-in-out;
        }

        @keyframes fadeDown {
        0% {
            opacity: 0;
            transform: translateY(-10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
        }
            .dropdown-menu .dropdown-item {
        transition: background-color 0.2s ease;
        }
        .dropdown-menu .dropdown-item:hover {
        background-color: #f8f9fa;
        }
        
        body.dark-mode {
            background-color: #121212;
            color: #eaeaea;
        }

        .dark-mode .navbar, .dark-mode .dropdown-menu {
            background-color: #1f1f1f !important;
        }

        .dark-mode .nav-link,
        .dark-mode .dropdown-item {
            color: #eaeaea !important;
        }

        .dark-mode .dropdown-item:hover {
            background-color: #333;
        }

        .fade-down {
            animation: fadeDown 0.3s ease-in-out;
        }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand fw-bold text-primary" href="/">BeritaNet</a>

    <!-- Toggle untuk mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu dan Search -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <!-- Menu Tengah -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="/">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Berita</a>
        </li>

        <!-- Dropdown Kategori -->
       <li class="nav-item dropdown dropdown-animated">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">Kategori</a>
            <ul class="dropdown-menu shadow fade-down">
                <li><a class="dropdown-item" href="#"><i class="bi bi-bank2 me-2 text-primary"></i> Politik</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-bar-chart-line me-2 text-success"></i> Ekonomi</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-cpu me-2 text-warning"></i> Teknologi</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-trophy me-2 text-danger"></i> Olahraga</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-film me-2 text-info"></i> Hiburan</a></li>
            </ul>
            </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Tentang</a>
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
    <form class="d-flex position-relative" role="search" id="searchForm">
        <input class="form-control me-2 rounded-pill" type="search" placeholder="Cari berita..." id="searchInput" autocomplete="off">
        <button class="btn btn-outline-primary rounded-pill" type="submit"><i class="bi bi-search"></i></button>
        <!-- Tempat hasil pencarian -->
        <div id="searchResults" class="list-group position-absolute top-100 start-0 w-100 mt-1 mr-2 shadow-sm d-none" style="z-index: 1000;"></div>
        <button id="modeToggle" class="btn  btn-sm p-2">🌙</button>
    </form>

    </div>
  </div>
</nav>


<div class="container py-5">
  <div class="row g-4">

    <!-- Konten Utama -->
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-body">
          @php
            use Carbon\Carbon;
            $tanggal = Carbon::parse($artikel->created_at);
          @endphp

          <!-- Gambar Berita -->
          <h1 class="news-title">{{ $artikel->judul }}</h1>
          <img src="{{ asset('uploads/'. $artikel->gambar_artikel) }}"
               alt="{{ $artikel->judul }}"
               class="img-fluid rounded mb-4 artikel-image"
               style="width: 100%; height: 400px; object-fit: cover;" />
    
          <!-- Judul & Metadata -->
          
          <p class="news-meta mb-3">
            <i class="bi bi-calendar3 me-1"></i> {{ $tanggal->translatedFormat('d F Y') }}
            | <i class="bi bi-clock me-1"></i> {{ $tanggal->format('H:i') }}
            | <i class="bi bi-folder me-1"></i> {{ $artikel->kategori->nama_kategori }}
            | <span class="ms-2"><i class="bi bi-eye"></i> <span id="viewCount">0</span> Pembaca</span>
          </p>
            
          
          
          <!-- Isi Berita -->
          <p>{!! $artikel->body !!}</p>
          
          <h6>Tags:</h6>
           @foreach($artikel->tags as $tag)
               <span class="badge bg-secondary">{{ $tag->nama_tag }}</span>
           @endforeach
    
            
          <!-- Share -->
          <div class="my-4">
            <strong>Bagikan:</strong>
            <a href="https://api.whatsapp.com/send?text={{ urlencode($artikel->judul . ' - ' . url('/artikel/' . $artikel->slug)) }}"
               class="btn btn-sm btn-success me-1" target="_blank">WhatsApp</a>
            <a href="https://twitter.com/intent/tweet?text={{ urlencode($artikel->judul) }}&url={{ urlencode(url('/artikel/' . $artikel->slug)) }}"
               class="btn btn-sm btn-primary me-1" target="_blank">Twitter</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/artikel/' . $artikel->slug)) }}"
               class="btn btn-sm btn-info text-white" target="_blank">Facebook</a>
          </div>

          <!-- Carousel -->
          <h4 class="mt-5 mb-3">Berita Terbaru</h4>
          <div id="carouselBerita" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="2500">
            <div class="carousel-inner">
              @foreach ($artikels as $index => $art)
              <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
              <a href="/detail/{{ $art->slug }}">  <img src="{{ asset('uploads/' . $art->gambar_artikel) }}" class="d-block w-100 rounded" style="height: 300px; object-fit: cover;" alt="{{ $art->judul }}"></a>
                <div class="carousel-caption d-none d-md-block">
                  <h5>{!! $art->judul !!}</h5>
                  <p>{!! \Illuminate\Support\Str::limit($art->body, 100) !!}</p>
                </div>
              </div>
              @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselBerita" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
              <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselBerita" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
              <span class="visually-hidden">Selanjutnya</span>
            </button>
          </div>

          <!-- Komentar -->
          <h4 class="mb-4">Komentar Pengguna</h4>
          <form action="{{ route('komentar.store', $artikel) }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" required />
            </div>
            <div class="mb-3">
              <label for="komentar" class="form-label">Komentar</label>
              <textarea class="form-control" id="komentar" name="pesan" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
          </form>

          @foreach ($komentar as $item)
              
          <div class="d-flex mb-3">
            <div>
              <strong>{{ $item->nama }}</strong><br />
              <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
              <p class="mb-0 mt-2">{{ $item->pesan }}</p>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title mb-3">Recent Berita</h5>

          @foreach($artikels as $recent)
          <div class="card mb-3">
           <a href="/detail/{{ $recent->slug }}"> <img src="{{ asset('uploads/' . $recent->gambar_artikel) }}" class="card-img-top" alt="{{ $recent->judul }}"></a>
            <div class="card-body p-2">
              <h6 class="card-title mb-1">{{ $recent->judul }}</h6>
              <p class="card-text text-muted small">{{ \Carbon\Carbon::parse($recent->created_at)->translatedFormat('d M Y') }}</p>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>

  </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-light pt-5 mt-5">
  <div class="container pb-4">
    <div class="row">
      <!-- Kolom 1: Logo & Kontak -->
      <div class="col-md-4 mb-4">
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-newspaper fs-2 text-primary me-2"></i>
          <h4 class="fw-bold m-0">BeritaNet</h4>
        </div>
        <p class="text-muted">Media terpercaya untuk informasi aktual dan mendalam.</p>
        <p><i class="bi bi-geo-alt-fill me-2"></i>Jl. Merdeka No. 123, Jakarta</p>
        <p><i class="bi bi-telephone-fill me-2"></i>(021) 123-4567</p>
        <p><i class="bi bi-envelope-fill me-2"></i>redaksi@beritanet.id</p>
      </div>

      <!-- Kolom 2: Kategori Terbaru -->
      <div class="col-md-4 mb-4">
        <h5 class="fw-semibold mb-3"><i class="bi bi-grid-3x3-gap-fill text-primary me-2"></i>Kategori Terbaru</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-light text-decoration-none d-block py-1"><i class="bi bi-tag-fill me-2"></i>Politik</a></li>
          <li><a href="#" class="text-light text-decoration-none d-block py-1"><i class="bi bi-tag-fill me-2"></i>Ekonomi</a></li>
          <li><a href="#" class="text-light text-decoration-none d-block py-1"><i class="bi bi-tag-fill me-2"></i>Teknologi</a></li>
          <li><a href="#" class="text-light text-decoration-none d-block py-1"><i class="bi bi-tag-fill me-2"></i>Olahraga</a></li>
        </ul>
      </div>

      <!-- Kolom 3: Komentar Terlama -->
      <div class="col-md-4 mb-4">
        <h5 class="fw-semibold mb-3"><i class="bi bi-chat-dots-fill text-primary me-2"></i>Komentar Terlama</h5>
        <ul class="list-unstyled">
          <li class="mb-2">
            <i class="bi bi-person-circle me-2 text-light"></i>
            <span class="text-muted">Andi:</span>
            <span class="text-light">"Berita ini sangat membantu!"</span>
          </li>
          <li class="mb-2">
            <i class="bi bi-person-circle me-2 text-light"></i>
            <span class="text-muted">Rina:</span>
            <span class="text-light">"Informasinya akurat."</span>
          </li>
          <li class="mb-2">
            <i class="bi bi-person-circle me-2 text-light"></i>
            <span class="text-muted">Budi:</span>
            <span class="text-light">"Saya suka formatnya."</span>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Footer Bawah -->
  <div class="bg-secondary text-center text-white py-3">
    &copy; 2025 <strong>BeritaNet</strong>. Semua Hak Dilindungi.
  </div>
</footer>


<!-- View Counter Script -->
<script>
  const newsId = {{ $artikel->id }};
  let views = localStorage.getItem(newsId);
  views = views ? parseInt(views) + 1 : 1;
  localStorage.setItem(newsId, views);
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("viewCount").textContent = views;
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  $('#searchInput').on('keyup', function () {
    let query = $(this).val();
    if (query.length > 2) {
      $.ajax({
        url: "{{ route('search.suggestions') }}", // Ganti sesuai route kamu
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

  // Sembunyikan saat klik luar
  $(document).on('click', function (e) {
    if (!$(e.target).closest('#searchForm').length) {
      $('#searchResults').addClass('d-none');
    }
  });
});
</script>
<script>
  const toggle = document.getElementById('modeToggle');
  toggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    toggle.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
  });
</script>


</body>
</html>
