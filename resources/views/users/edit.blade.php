@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Profile</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $user->nama) }}">
                </div>

                {{-- Username --}}
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ old('username', $user->username) }}">
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}">
                </div>

                {{-- No HP --}}
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                </div>

                {{-- Tanggal Lahir --}}
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
                </div>

                {{-- Bio --}}
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea class="form-control" name="bio" id="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
                </div>

                {{-- Avatar --}}
                <div class="mb-3">
                    <label for="avatar" class="form-label">Foto Profil</label><br>
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar" width="100" class="mb-2 rounded">
                    @endif
                    <input class="form-control" type="file" name="avatar" id="avatar">
                </div>

                <hr>

                <h5 class="text-secondary mt-4">Ganti Password</h5>

                {{-- Password Lama --}}
                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Lama</label>
                    <input type="password" class="form-control" name="current_password" id="current_password" autocomplete="current-password">
                </div>

                {{-- Password Baru --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" name="password" id="password" autocomplete="new-password">
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
