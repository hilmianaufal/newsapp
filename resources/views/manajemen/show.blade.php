@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Pengguna</h4>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Avatar --}}
                <div class="col-md-3 text-center mb-3">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="img-fluid rounded-circle shadow" style="width: 150px;">
                    @else
                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width:150px;height:150px;">
                            <span>Tidak Ada Foto</span>
                        </div>
                    @endif
                </div>

                {{-- Informasi User --}}
                <div class="col-md-9">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama</th>
                            <td>: {{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>: {{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>: {{ $user->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>: {{ \Carbon\Carbon::parse($user->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Bio</th>
                            <td>: {{ $user->bio ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>: <span class="badge {{ $user->role == 'admin' ? 'bg-success' : 'bg-info' }}">{{ ucfirst($user->role) }}</span></td>
                        </tr>
                    </table>

                    <a href="{{ route('manajemen.edit', $user->id) }}" class="btn btn-warning">Edit Profil</a>
                    <a href="{{ route('manajemen.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
