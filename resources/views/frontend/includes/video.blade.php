<div class="container py-5">
  <div class="row g-4">
      <div class="my-4" data-aos="fade-right">
        <h2 class="fw-bold d-flex align-items-center">
            <i class="bi bi-camera-reels-fill text-danger me-2 fs-2 animate__animated animate__bounceIn"></i>
            Video Terbaru
        </h2>
    </div>
    @foreach ($materi as $item)
    @php
        preg_match('/(?:youtube\.com.*(?:\\?|&)v=|youtu\.be\/)([^&]+)/', $item->link, $matches);
        $videoId = $matches[1] ?? null;
        $thumbnail = $videoId ? "https://img.youtube.com/vi/$videoId/hqdefault.jpg" : null;
        $tanggal = \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y');
        $jam = \Carbon\Carbon::parse($item->created_at)->format('H:i') . ' WIB';
    @endphp

    <div class="col-lg-4 col-md-6">
      <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden" data-aos="zoom-in">
        @if ($thumbnail)
        <a href="{{ $item->link }}" target="_blank" rel="noopener">
          <img src="{{ $thumbnail }}" class="card-img-top" alt="{{ $item->judul_materi }}">
        </a>
        @endif
        <div class="card-body d-flex flex-column" data-aos="fade-up">
          <h5 class="card-title d-flex align-items-center mb-2">
            <i class="bi bi-play-circle-fill text-primary me-2 fs-5"></i>
            {{ $item->judul_materi }}
          </h5>
          <div class="mb-2 text-muted small" data-aos="fade-up">
            <i class="bi bi-folder-fill me-1"></i>
            Playlist: {{ $item->playlist->judul_playlist ?? '-' }}
          </div>
          <div class="text-muted small" data-aos="fade-up">
            <i class="bi bi-calendar-event me-1"></i>
            {{ $tanggal }} - {{ $jam }}
          </div>
          <a href="{{ $item->link }}" target="_blank" class="btn btn-outline-primary btn-sm mt-3 rounded-pill w-100">
            <i class="bi bi-box-arrow-up-right me-1"></i> Tonton Video
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
