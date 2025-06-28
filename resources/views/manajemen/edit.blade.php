
@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah User</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('manajemen.update' , $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                   {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" value="{{ $user->nama }}" id="nama" ">
                </div>

                {{-- Username --}}
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" value="{{ $user->username }}" name="username" id="username" >
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" name="email" id="email" >
                </div>

                {{-- No HP --}}
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ $user->no_hp }}" >
                </div>

                {{-- Tanggal Lahir --}}
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" value="{{ $user->tanggal_lahir }}" name="tanggal_lahir" id="tanggal_lahir">
                </div>

                {{-- Bio --}}
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea class="form-control"  name="bio" id="bio" rows="3">{{ $user->bio }}</textarea>
                </div>

                <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">---Pilih Role---</option>
                               <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                  <option value="penulis" {{ $user->role == 'penulis' ? 'selected' : '' }}>Penulis</option>
                            </select>
                        </div>
                {{-- Avatar --}}
                <div class="mb-3">
                    <label for="avatar" class="form-label">Foto Profil</label><br>
                    
                    @if ($user->avatar)
                        <img src="{{ asset($user->avatar) }}" alt="avatar" width="100" class="mb-2 rounded">
                        <input class="form-control" type="file" name="avatar" id="avatar">
                    @endif
                </div>

                <hr>

                {{-- Password Baru --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password Lama</label>
                    <input type="password" class="form-control" name="current_password" id="password" autocomplete="new-password">
                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- Password Baru --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" name="password" id="password" autocomplete="new-password">
                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" autocomplete="new-password">
                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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

                            
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
