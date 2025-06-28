    <div class="weekly2-news-area  weekly2-pading gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                           <div class="my-4" data-aos="fade-right">
                                <h3 class="fw-bold d-flex align-items-center">
                                    <i class="bi bi-newspaper text-danger me-2 fs-3 animate__animated animate__fadeInLeft"></i>
                                    Berita Lainnya
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly2-news-active dot-style d-flex dot-style">
                        @foreach ($artikel as $art )
                            
                        <div class="weekly2-single" data-aos="flip-right">
                            <div class="weekly2-img">
                                <img src="{{ asset($art->gambar_artikel) }}" alt="">
                            </div>
                            <div class="weekly2-caption" data-aos="fade-down">
                                <span class="color1">{{ $art->kategori->nama_kategori }}</span>
                                <p>{{ \Carbon\Carbon::parse($art->created_at)->translatedFormat('d F Y') }}</p>
                                <h4><a href="/detail/{{ $art->slug }}">{{ $art->judul }}</a></h4>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
