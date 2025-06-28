

@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">My Profile</h4>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Foto Profil --}}
                <div class="col-md-3 text-center">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('default-avatar.png') }}"
                         class="img-fluid rounded-circle mb-3" alt="Avatar" style="max-width: 150px;">
                </div>

                {{-- Detail Profil --}}
                <div class="col-md-9">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><span class="badge bg-primary text-white">{{ ucfirst($user->role) }}</span></td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>{{ $user->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $user->tanggal_lahir ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Bio</th>
                            <td>{{ $user->bio ?? '-' }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


