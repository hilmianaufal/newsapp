@extends('frontend.layouts.main')

@section('content')
<style>
  .artikel-image {
    width: 100%;
    aspect-ratio: 16 / 9;
    object-fit: cover;
    border-radius: 0.5rem;
  }

  @media (max-width: 576px) {
    .artikel-image {
      aspect-ratio: 16 / 10;
    }
  }

  .text-justify p {
    text-align: justify;
  }
</style>

<div class="container py-5 px-3 px-md-5">
  <div class="row g-4">

    <!-- Konten Utama -->
    <div class="col-lg-8">
      @php
        use Carbon\Carbon;
        $tanggal = Carbon::parse($artikel->created_at);
      @endphp

      <!-- Info Kategori & Penulis -->
      <div class="mb-2 text-muted small d-flex align-items-center gap-3 flex-wrap">
        <div>
          <i class="bi bi-folder-fill text-primary me-1"></i> 
          <a href="/kategori/{{ $artikel->kategori->slug }}" class="text-decoration-none text-dark fw-semibold">
            {{ $artikel->kategori->nama_kategori }}
          </a>
        </div>
        <div>
          <i class="bi bi-person-fill text-secondary me-1"></i>
          {{ $artikel->users->nama ?? 'Admin' }}
        </div>
      </div>

      <!-- Judul -->
      <h1 class="news-title">{{ $artikel->judul }}</h1>

      <!-- Gambar -->
      <img src="{{ asset($artikel->gambar_artikel) }}"
           alt="{{ $artikel->judul }}"
           class="artikel-image mb-4" />

      <!-- Metadata -->
      <p class="news-meta mb-3 small text-muted">
        <i class="bi bi-calendar3 me-1"></i> {{ $tanggal->translatedFormat('d F Y') }}
        | <i class="bi bi-clock me-1"></i> {{ $tanggal->format('H:i') }}
        | <span class="ms-2"><i class="bi bi-eye"></i> <span id="viewCount">0</span> Pembaca</span>
      </p>

      <!-- Isi Artikel -->
      <div class="text-justify mb-4">
        {!! $currentContent !!}
      </div>

      <!-- Pagination -->
      @if ($totalPages > 1)
      <nav class="mt-4">
        <ul class="pagination justify-content-center">
          {{-- Tombol Sebelumnya --}}
          <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
            <a class="page-link" href="?page={{ $page - 1 }}" tabindex="-1">← Sebelumnya</a>
          </li>

          {{-- Nomor Halaman --}}
          @for ($i = 1; $i <= $totalPages; $i++)
            <li class="page-item {{ $i == $page ? 'active' : '' }}">
              <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
            </li>
          @endfor

          {{-- Tombol Selanjutnya --}}
          <li class="page-item {{ $page >= $totalPages ? 'disabled' : '' }}">
            <a class="page-link" href="?page={{ $page + 1 }}">Selanjutnya →</a>
          </li>
        </ul>
      </nav>
      @endif

      <!-- Tags -->
      <h6>Tags:</h6>
      @foreach($artikel->tags as $tag)
          <span class="badge bg-secondary">{{ $tag->nama_tag }}</span>
      @endforeach

      <!-- Tombol Share -->
      <div class="my-4">
        <strong>Bagikan:</strong>
        <div class="d-flex flex-wrap gap-2 mt-2">
          <a href="https://api.whatsapp.com/send?text={{ urlencode($artikel->judul . ' - ' . url('/detail/' . $artikel->slug)) }}"
             class="btn btn-sm btn-success" target="_blank">
            <i class="bi bi-whatsapp me-1"></i> WhatsApp
          </a>
          <a href="https://twitter.com/intent/tweet?text={{ urlencode($artikel->judul) }}&url={{ urlencode(url('/detail/' . $artikel->slug)) }}"
             class="btn btn-sm btn-primary" target="_blank">
            <i class="bi bi-twitter me-1"></i> Twitter
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/detail/' . $artikel->slug)) }}"
             class="btn btn-sm btn-info text-white" target="_blank">
            <i class="bi bi-facebook me-1"></i> Facebook
          </a>
        </div>
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

    <!-- Sidebar -->
    <div class="col-lg-4">
      <h5 class="mb-3">Recent Berita</h5>
      @foreach($artikels as $recent)
        <div class="d-flex mb-3 align-items-start">
          <a href="/detail/{{ $recent->slug }}" class="me-2 flex-shrink-0" style="width: 80px;">
            <img src="{{ asset($recent->gambar_artikel) }}" class="img-fluid rounded" style="height: 60px; object-fit: cover;" alt="{{ $recent->judul }}">
          </a>
          <div>
            <a href="/detail/{{ $recent->slug }}" class="text-decoration-none text-dark">
              <h6 class="mb-1" style="font-size: 0.9rem;">{{ \Illuminate\Support\Str::limit($recent->judul, 45) }}</h6>
            </a>
            <small class="text-muted d-block">{{ \Carbon\Carbon::parse($recent->created_at)->translatedFormat('d M Y') }}</small>
          </div>
        </div>
      @endforeach
    </div>

  </div>
</div>
@endsection
