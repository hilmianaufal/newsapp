<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <!-- Trending Top -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body p-0">
                        <div id="carouselBerita" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                            <div class="carousel-inner">
                                @foreach ($slide as $key => $item)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-aos="flip-right">
                                    <a href="{{ $item->link }}">
                                        <img src="{{ asset($item->gambar_slide) }}" class="d-block w-100" alt="{{ $item->judul }}">
                                    </a>
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                                        <h2><a href="{{ $item->link}}" class="text-white text-decoration-none">{{ $item->judul_slide }}</a></h2>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselBerita" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselBerita" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Trending Bottom -->
              <div class="card mb-4 shadow-sm">
                    <div class="card-body position-relative">
                        <!-- Tombol panah -->
                            <button class="position-absolute top-50 start-0 translate-middle-y z-3 bg-light border-0"
                                    style="width: 30px; height: 30px;"
                                    onclick="scrollBerita(-1)">
                                <div class="d-flex align-items-center justify-content-center w-100 h-100">
                                    <i class="bi bi-chevron-left fs-6"></i>
                                </div>
                            </button>

                            <button class="position-absolute top-50 end-0 translate-middle-y z-3 bg-light border-0"
                                    style="width: 30px; height: 30px;"
                                    onclick="scrollBerita(1)">
                                <div class="d-flex align-items-center justify-content-center w-100 h-100">
                                    <i class="bi bi-chevron-right fs-6"></i>
                                </div>
                            </button>
                        <!-- Container berita -->
                        <div id="beritaSlider" class="d-flex overflow-hidden gap-3">
                            @foreach($berita6 as $art)
                            <div class="card flex-shrink-0" style="width: 250px;">
                                <img src="{{ asset($art->gambar_artikel) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="">
                                <div class="card-body">
                                    <span class="badge bg-primary mb-1">{{ $art->kategori->nama_kategori }}</span>
                                    <h6 class="card-title"><a href="/detail/{{ $art->slug }}" class="text-decoration-none">{{ $art->judul }}</a></h6>
                                    <p class="card-text small text-muted mb-0"><i class="bi bi-person-fill me-1"></i>{{ $art->users->nama }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>


            </div>

            <!-- Right Content -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <h4 class="text-center pt-3"><i class="bi bi-clock-history me-2 text-primary"></i>Berita Terbaru</h4>
                    <div class="card-body">
                        @foreach ($berita5 as $item)
                            <div class="d-flex mb-3" data-aos="fade-left">
                                <img src="{{ asset($item->gambar_artikel) }}" style="width: 150px; height: 100px; object-fit: cover;" class="me-3 rounded" alt="{{ $item->judul }}">
                                <div>
                                    <span class="badge bg-secondary">{{ $item->kategori->nama_kategori }}</span>
                                    <h6 class="mb-1 mt-1">
                                        <a href="/detail/{{ $item->slug }}" class="text-decoration-none">{{ $item->judul }}</a>
                                    </h6>
                                    <small class="text-muted d-block">
                                        <i class="bi bi-person-fill me-1"></i>{{ $item->users->nama }}
                                    </small>
                                    <small class="text-muted d-block">
                                        <i class="bi bi-clock me-1"></i>{{ $item->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
