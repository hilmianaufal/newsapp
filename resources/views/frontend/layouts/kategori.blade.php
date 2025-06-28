@extends('frontend.layouts.kategori_old')

@section('kategori')
    <section class="py-5">
      <div class="container">
        <h2 class="mb-4 text-center fw-bold">Artikel: {{ $kategori->nama_kategori }}</h2>
        <div class="row g-4">
          @forelse ($artikel as $a)
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
              <a href="/detail/{{ $a->slug }}"></a><img src="{{ asset($a->gambar_artikel) }}" class="card-img-top" alt="{{ $a->judul }}">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $a->judul }}</h5>
                <p class="card-text text-muted small mb-3">{{ Str::limit(strip_tags($a->body), 100) }}</p>
                <a href="/detail/{{ $a->slug }}" class="btn btn-outline-primary mt-auto">Baca Selengkapnya</a>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center text-muted">Belum ada artikel dalam kategori ini.</div>
          @endforelse
        </div>
      </div>
    </section>
@endsection