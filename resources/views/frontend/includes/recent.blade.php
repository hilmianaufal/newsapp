<div class="container py-5">
    <div class="row">
        <!-- Kolom Artikel Thumbnail -->
        <div class="col-md-8">
            <h4 class="mb-4">Recent Artikel</h4>
            <div class="row g-3">
                @foreach ($berita6 as $article)
                <div class="col-sm-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0" data-aos="flip-left">
                        <img src="{{ asset($article->gambar_artikel) }}" class="card-img-top rounded-top" alt="{{ $article->judul }}" style="height: 120px; object-fit: cover;">
                        <div class="card-body p-2" data-aos="fade-down">
                            <h6 class="card-title mb-1" style="font-size: 0.9rem">
                                <a href="{{ route('artikel.show', $article->slug) }}" class="text-decoration-none text-dark">
                                    {{ Str::limit($article->judul, 45) }}
                                </a>
                            </h6>
                            <small class="text-muted" style="font-size: 0.75rem;">
                                By {{ $article->users->name }} • {{ $article->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Kolom Link Judul Artikel -->
        <div class="col-md-4 mt-5 mt-md-0">
            <h5 class="mb-3">More Articles</h5>
            <ul class="list-group list-group-flush">
                @foreach ($artikel as $article)
                <li class="list-group-item px-0 border-0">
                    <a href="/detail/{{ $article->slug }}" class="d-flex align-items-center text-decoration-none text-secondary small" data-aos="fade-up">
                        <i class="bi bi-chevron-right me-2 text-primary"></i>
                        {{ Str::limit($article->judul, 50) }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
