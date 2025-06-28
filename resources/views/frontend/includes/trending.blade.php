<div class="row align-items-center">
    {{-- Trending Now --}}
    <div class="col-lg-6 col-md-5">
        <div class="trending-tittle mb-2">
            <strong>Trending now</strong>
            <div class="trending-animated">
                <ul id="js-news" class="js-hidden">
                    @foreach ($artikel as $item)
                        <li class="news-item">{{ $item->judul }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Iklan --}}
    <div class="col-lg-6 col-md-7">
        <div class="news-poster " data-aos="fade-up">
            <a href="{{ $iklan2->link }}">
                <img src="{{ asset($iklan2->gambar_iklan) }}"
                     alt="Iklan"
                     class="w-100 rounded"
                     style="height: 90px; object-fit: cover;">
            </a>
        </div>
    </div>
</div>
