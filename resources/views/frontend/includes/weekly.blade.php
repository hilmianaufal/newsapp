<div class="weekly-news-area py-5 bg-light">
  <div class="container">
    <!-- Judul Section -->
    <div class="mb-4" data-aos="fade-right">
      <h3 class="fw-bold d-flex align-items-center">
        <i class="bi bi-bookmark-star-fill text-danger me-2 fs-3 animate__animated animate__fadeInLeft"></i>
        Top Artikel Minggu Ini
      </h3>
    </div>

    <!-- Grid Artikel -->
    <div class="row g-4">
      @foreach ($berita8 as $item)
      <div class="col-12 col-sm-6 col-lg-3" data-aos="fade-up">
        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
          <a href="/detail/{{ $item->slug }}">
            <img src="{{ asset($item->gambar_artikel) }}"
                 class="card-img-top object-fit-cover"
                 style="height: 180px; object-fit: cover;" alt="{{ $item->judul }}">
          </a>
          <div class="card-body">
            <span class="badge bg-danger mb-2">{{ $item->kategori->nama_kategori }}</span>
            <h6 class="card-title fw-semibold">{{ \Illuminate\Support\Str::limit($item->judul, 60) }}</h6>
            <p class="card-text text-muted small">{!! \Illuminate\Support\Str::limit(strip_tags($item->body), 70) !!}</p>
            <a href="/detail/{{ $item->slug }}" class="btn btn-sm btn-outline-primary mt-2">Read More</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
