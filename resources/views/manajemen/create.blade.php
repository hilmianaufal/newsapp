@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah User</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('manajemen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                   {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" id="nama" ">
                </div>

                {{-- Username --}}
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" >
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" >
                </div>

                {{-- No HP --}}
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control" name="no_hp" id="no_hp" >
                </div>

                {{-- Tanggal Lahir --}}
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                </div>

                {{-- Bio --}}
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea class="form-control" name="bio" id="bio" rows="3"></textarea>
                </div>

                <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">---Pilih Role---</option>
                                <option value="admin">Admin</option>
                                <option value="penulis">Penulis</option>
                            </select>
                        </div>
                {{-- Avatar --}}
                <div class="mb-3">
                    <label for="avatar" class="form-label">Foto Profil</label><br>
                    <input class="form-control" type="file" name="avatar" id="avatar" onchange="previewImage(event)"">
                </div>
                <div class="mb-3">
                    <img id="imagePreview" src="{{ isset($user) && $user->avatar ? asset('storage/' . $user->avatar) : '#' }}"
                        class="img-thumbnail" style="max-width: 200px;" 
                        alt="Preview" {{ isset($user) && $user->avatar ? '' : 'hidden' }}>
                </div>

                <hr>

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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                            
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>
</div>
@endsection
