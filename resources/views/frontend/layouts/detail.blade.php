@extends('frontend.layouts.main')

@section('content')
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
              <a href="/detail/{{ $recent->slug }}" style="text-decoration: none; color: black;">
                    <h6 class="card-title mb-1">{{ $recent->judul }}</h6>
                </a>
              <p class="card-text text-muted small">{{ \Carbon\Carbon::parse($recent->created_at)->translatedFormat('d M Y') }}</p>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>

  </div>
</div>
@endsection