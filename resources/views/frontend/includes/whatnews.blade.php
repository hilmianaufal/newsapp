<section class="whats-news-area pt-50 pb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Judul dan Tabs -->
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <div class="my-4" data-aos="fade-right">
                                <h3 class="fw-bold d-flex align-items-center">
                                    <i class="bi bi-lightning-charge-fill text-danger me-2 fs-3 animate__animated animate__fadeInLeft"></i>
                                    Whats New?
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="properties__button">
                            <!-- Nav Tabs -->
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach ($kategori as $index => $item)
                                        <a class="nav-item nav-link {{ $index == 0 ? 'active' : '' }}"
                                           id="tab-{{ $item->id }}"
                                           data-bs-toggle="tab"
                                           href="#kategori-{{ $item->id }}"
                                           role="tab"
                                           aria-controls="kategori-{{ $item->id }}"
                                           aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                           {{ $item->nama_kategori }}
                                        </a>
                                    @endforeach
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Konten Tab -->
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="nav-tabContent">
                            @foreach ($kategori as $index => $item)
                                <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                     id="kategori-{{ $item->id }}"
                                     role="tabpanel"
                                     aria-labelledby="tab-{{ $item->id }}">
                                    <div class="whats-news-caption">
                                        <div class="row">
                                            @forelse ($item->artikel as $art)
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="single-what-news mb-100">
                                                        <div class="what-img">
                                                          <a href="/detail/{{ $art->slug }}">  <img src="{{ asset($art->gambar_artikel) }}" alt=""> </a>
                                                        </div>
                                                        <div class="what-cap">
                                                            <span class="color1">{{ $item->nama_kategori }}</span>
                                                            <h4><a href="/detail/{{ $art->slug }}">{{ $art->judul }}</a></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="ml-3">Tidak ada artikel.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
 <div class="col-lg-4">    {{-- Card Berita Singkat --}}
    <div class="latest-news mb-4">
        <div class="mb-3" data-aos="fade-right">
                    <h5 class="fw-bold d-flex align-items-center">
                        <i class="bi bi-broadcast-pin text-danger me-2 fs-5 animate__animated animate__fadeInLeft"></i>
                        Berita Terkini
                    </h5>
                </div>
        @foreach ($berita6 as $berita)
            <div class="card mb-3 border-0 shadow-sm small-news-card">
                <div class="row g-0">
                    <div class="col-4" data-aos="fade-down">
                        <img src="{{ asset($berita->gambar_artikel) }}" class="img-fluid rounded-start" alt="{{ $berita->judul }}" data-aos="fade-down">
                    </div>
                    <div class="col-8" data-aos="fade-down">
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1">
                                <a href="/detail/{{ $berita->slug }}" class="text-dark text-decoration-none">
                                    {{ Str::limit($berita->judul, 50) }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                {{ $berita->created_at->format('d M Y, H:i') }}
                            </small>
                            <p class="card-text mt-1 mb-0">
                                {{ Str::limit(strip_tags($berita->body), 60) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Poster Iklan --}}
    <div class="news-poster d-none d-lg-block" data-aos="fade-left">
        <a href="{{ $iklan->link }}">
            <img src="{{ asset($iklan->gambar_iklan) }}" alt="">
        </a>
    </div>
</div>

        </div>
    </div>
</section>
