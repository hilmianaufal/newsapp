@extends('layouts.default')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <h2 class="text-white fw-bold">History Pesan Admin</h2>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        @if (session('success'))
            <div class="col-12">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @forelse($pesans as $pesan)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ $pesan->penerima->nama }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2 text-dark">{{ $pesan->penerima->isi }}</p>
                        <div class="text-muted small mt-3 d-flex justify-content-between">
                            <span><i class="bi bi-person-circle me-1"></i> {{ $pesan->penerima->nama ?? 'Admin' }}</span>
                            <span>{{ $pesan->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada pesan dari admin.
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection
