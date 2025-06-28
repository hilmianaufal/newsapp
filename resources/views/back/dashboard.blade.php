@extends('layouts.default')

@section('content')

<style>
  body {
    background-color: #ffffff;
    color: #6b7280;
    font-family: 'Inter', sans-serif;
  }
  .page-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 4rem 1rem 5rem;
  }

  .dashboard-wrapper {
    background: white;
    border-radius: 1rem;
    padding: 2.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
    margin-bottom: 2rem;
  }

  .cards-row {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
  }


  .card:hover {
    box-shadow: 0 6px 16px rgb(0 0 0 / 0.1);
  }
  .card:hover .card-icon {
    transform: rotate(12deg) scale(1.1);
    transition: transform 0.4s ease;
  }
  .card .card-title {
    font-weight: 700;
    font-size: 1.125rem;
    margin-bottom: 0.5rem;
  }
  .card .number {
    font-weight: 800;
    font-size: 2.25rem;
    margin-top: 0.25rem;
  }

  .bg-articles {
    background-image: linear-gradient(135deg, #ABDCFF 10%, #0396FF 100%);
    color: white;
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  .bg-uploads {
    background-image: linear-gradient(135deg, #FCCF31 10%, #F55555 100%);
    color: white;
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  .bg-videos {
    background-image: linear-gradient(135deg, #FFF720 10%, #3CD500 100%);
    color: white;
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  .bg-categories {
    background-image: linear-gradient(135deg, #FAB2FF 10%, #1904E5 100%);
    color: white;
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  .card-icon {
    width: 48px;
    height: 48px;
    stroke: white;
    fill: none;
    flex-shrink: 0;
    transition: transform 0.4s ease;
  }

  .card-text {
    flex-grow: 1;
  }

  .content-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
  }

  .content-card .card-title-lg {
    font-weight: 800;
    font-size: 1.75rem;
    margin-bottom: 1rem;
    color: #111827;
  }

  .list-item {
    border-radius: 0.75rem;
    padding: 1rem 1.5rem;
    background: #f9fafb;
    margin-bottom: 1rem;
    box-shadow: 0 1px 3px rgb(0 0 0 / 0.05);
    display: flex;
    align-items: center;
    gap: 1.25rem;
    transition: background-color 0.3s ease;
  }
  .list-item:hover {
    background-color: #e5e7eb;
  }
  .list-item img {
    width: 64px;
    height: 64px;
    border-radius: 0.5rem;
    object-fit: cover;
    flex-shrink: 0;
  }
  .list-item .content {
    flex-grow: 1;
  }
  .list-item .title {
    font-weight: 700;
    font-size: 1.1rem;
    color: #111827;
    margin-bottom: 0.25rem;
  }
  .list-item .meta {
    font-size: 0.9rem;
    color: #6b7280;
  }
  .list-item .meta span {
    margin-right: 1.25rem;
  }

  @media (max-width: 900px) {
    .content-row {
      grid-template-columns: 1fr;
    }
  }
     .card-container {
      display: flex;
      gap: 1.5rem;
      flex-wrap: wrap;
    }

    .card {
      position: relative;
      flex: 1 1 220px;
      padding: 1.5rem;
      border-radius: 12px;
      color: #fff;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      
    }

    .card .amount {
      font-size: 1.75rem;
      font-weight: bold;
      margin-bottom: 0.25rem;
    }

    .card .label {
      font-size: 1rem;
      opacity: 0.9;
    }

    .card .icon {
      position: absolute;
      top: 1.2rem;
      right: 1.2rem;
      font-size: 1.5rem;
      opacity: 0.5;
    }

    .card .chart-line {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 60px;
      background-repeat: no-repeat;
      background-position: bottom;
      background-size: contain;
      opacity: 0.4;
    }

    .blue    { background: linear-gradient(to right, #36D1DC, #5B86E5); }
    .red     { background: linear-gradient(to right, #f83600, #f9d423); }
    .green   { background: linear-gradient(to right, #11998e, #38ef7d); }
    .purple  { background: linear-gradient(to right, #9d50bb, #6e48aa); }
</style>

<div class="page-inner">
  <div class="dashboard-wrapper">

<div class="card-container">
    <div class="card blue">
      <div class="amount">{{ $ttlArtikel }}</div>
      <div class="label">Total Artikel</div>
      <div class="icon"><i class="fas fa-flip fa-file-text"></i></div>
      <div class="chart-line" style="background-image: url('chart1.svg');"></div>
    </div>

    <div class="card red">
      <div class="amount">{{ $ttlKategori }}</div>
      <div class="label">Total Kategori</div>
      <div class="icon"><i class="fas fa-tags fa-flip"></i></div>
      <div class="chart-line" style="background-image: url('chart2.svg');"></div>
    </div>

    <div class="card green">
      <div class="amount">{{ $ttlSlide }}</div>
      <div class="label">Total Slide</div>
      <div class="icon"><i class="fas fa-flip fa-video"></i></div>
      <div class="chart-line" style="background-image: url('chart3.svg');"></div>
    </div>

    <div class="card purple">
      <div class="amount">{{ $ttlVideo }}</div>
      <div class="label">Total Video</div>
      <div class="icon"><i class="fas fa-flip fa-image"></i></div>
      <div class="chart-line" style="background-image: url('chart4.svg');"></div>
    </div>
  </div>

    <div class="content-row">
      <section class="card content-card" aria-label="Playlist Videos">
        <h2 class="card-title-lg">Playlist Videos</h2>
        @foreach ($jmlVideo as $item)
        <article class="list-item">
          <img src="{{ asset($item->gambar_playlist) }}" alt="Thumbnail" />
          <div class="content">
            <h3 class="title">{{ $item->judul_materi }}</h3>
            <p class="meta">
              <span><i class="fas fa-calendar-alt"></i> {{ $item->created_at->format('d-m-Y H:i:s') }}</span>
              <span><i class="fas fa-circle"></i> {{ $item->judul_playlist }}</span>
              <span><i class="fas fa-circle {{ $item->is_active ? 'text-green-500' : 'text-gray-400' }}"></i> {{ $item->is_active ? 'Published' : 'Draft' }}</span>
            </p>
          </div>
        </article>
        @endforeach
      </section>

      <section class="card content-card" aria-label="Uploaded Articles">
        <h2 class="card-title-lg">Uploaded Artikel Terbaru</h2>
        @foreach ($artTerbaru as $item)
        <article class="list-item">
          <img src="{{ asset($item->gambar_artikel) }}" alt="{{ $item->slug }}" />
          <div class="content">
            <h3 class="title">{{ $item->judul }}</h3>
            <p class="meta">
              <span><i class="fas fa-user"></i> {{ $user->nama }}</span>
              <span><i class="fas fa-calendar-alt"></i> {{ $item->created_at->format('d-m-Y H:i:s') }}</span>
              <span><i class="fas fa-circle {{ $item->is_actived ? 'text-green-500' : 'text-gray-400' }}"></i> {{ $item->is_actived ? 'Published' : 'Draft' }}</span>
            </p>
          </div>
        </article>
        @endforeach
      </section>
    </div>

  </div>
</div>

@endsection
