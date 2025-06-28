@extends('layouts.default')

@section('content')

<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <h2 class="text-white pb-2 fw-bold">Manajemen Komentar</h2>
        <p class="text-white mb-0">Kelola komentar pengguna dengan mudah.</p>
    </div>
</div>

<div class="page-inner mt-4">
    <div class="row">
        <!-- Kolom Komentar Terbaru -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i> Komentar Terbaru</h5>
                </div>
                <div class="card-body">
                    @forelse ($komentarLama as $comment)
                        <div class="card mb-3 border-start border-primary border-3 shadow-sm">
                            <div class="card-body py-2 px-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>{{ $comment->nama }}</strong>
                                        <p class="mb-1">{{ Str::limit($comment->pesan, 100) }}</p>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="text-end">
                                        <a href="/detail/{{ $comment->artikel->slug }}" class="text-white btn btn-sm btn-primary me-2" title="Lihat Artikel">
                                            View Artikel
                                        </a>
                                        <form action="{{ route('komentar.destroy', $comment->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger text-white " title="Hapus Komentar" onclick="return confirm('Hapus komentar ini?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada komentar terbaru.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Kolom Komentar Terlama -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i> Komentar Terlama</h5>
                </div>
                <div class="card-body">
                    @forelse ($komentarBaru as $comment)
                        <div class="card mb-3 border-start border-secondary border-3 shadow-sm">
                            <div class="card-body py-2 px-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>{{ $comment->nama }}</strong>
                                        <p class="mb-1">{{ Str::limit($comment->pesan, 100) }}</p>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="text-end">
                                        <a href="/detail/{{ $comment->artikel->slug }}" class="text-white btn btn-sm btn-primary me-2" title="Lihat Artikel">
                                            View Artikel
                                        </a>
                                        <form action="{{ route('komentar.destroy', $comment->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger text-white" title="Hapus Komentar" onclick="return confirm('Hapus komentar ini?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada komentar lama.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
