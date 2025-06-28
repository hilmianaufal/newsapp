@extends('layouts.default')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <h2 class="text-white fw-bold">Pesan dari Admin</h2>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        @if (session('success'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            </div>
        @endif

        @forelse($pesans as $pesan)
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow rounded-3 h-100">
                    <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                        <div class="fw-semibold">{{ $pesan->nama }}</div>
                        <form action="{{ route('pesan.hapus', $pesan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger rounded-circle" title="Hapus Pesan">
                                <i class="bi bi-trash3-fill"></i> Hapus
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <p class="text-dark mb-2">
                            <i class="bi bi-chat-left-text-fill me-1 text-secondary"></i>
                            {{ $pesan->isi }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center text-muted small">
                            <div>
                                <i class="bi bi-person-fill me-1"></i> {{ $pesan->pengirim->nama ?? 'Admin' }}
                            </div>
                            <div>
                                <i class="bi bi-clock-fill me-1"></i> {{ $pesan->created_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle-fill me-1"></i> Belum ada pesan dari admin.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
