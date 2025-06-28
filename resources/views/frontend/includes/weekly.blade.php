<div class="weekly-news-area py-5 bg-light">
    <div class="container">
        <!-- Section Title -->
        <div class=" mb-5">
           <div class="my-4" data-aos="fade-right">
                <h3 class="fw-bold d-flex align-items-center">
                    <i class="bi bi-bookmark-star-fill text-danger me-2 fs-3 animate__animated animate__fadeInLeft"></i>
                    Top Artikel Minggu Ini
                </h3>
            </div>

        </div>

        <!-- News Cards Grid -->
        <div class="row g-4">
            <!-- Card 1 -->
            @foreach ($berita8 as $item)
                
            <div class="col-md-6 col-lg-3" data-aos="fade-up">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <a href="/detail/{{ $item->slug }}"><img src="{{ asset($item->gambar_artikel) }}" class="card-img-top object-fit-cover" alt="News 1" style="height: 180px;"> </a>
                    <div class="card-body">
                        <span class="badge bg-danger mb-2">{{ $item->kategori->nama_kategori }}</span>
                        <h6 class="card-title">{{ $item->judul }}</h6>
                        <p class="card-text text-muted small">{!! Str::limit($item->body, 60) !!}</p>
                        <a href="#" class="btn btn-sm btn-outline-primary mt-2">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach

         
        </div>
    </div>
</div>
