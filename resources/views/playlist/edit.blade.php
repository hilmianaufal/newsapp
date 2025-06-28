@extends('layouts.default')

@section('content')


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Start -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Playlist</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('playlist.update' , $playlist->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="judul">Judul Playlist</label>
                            <input type="text" name="judul_playlist" value="{{ $playlist->judul_playlist }}" class="form-control" id="judul" placeholder="Masukan Judul Artikel" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="body">Deskripsi</label>
                            <textarea name="deskripsi" cols="30" value="" id="konten" rows="10" class="form-control">{{ $playlist->deskripsi }}</textarea>
                        </div>
                         <div class="form-group mb-3">
                            <label for="gambar">Gambar </label>
                            <input type="file" name="gambar_playlist" class="form-control" id="gambar" >
                            <br>
                            <img src="{{ asset('uploads/' . $playlist->gambar_playlist) }}" width="100" alt="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="is_active" id="status" class="form-control">
                                <option value="1"{{ $playlist->is_active == '1' ? 'selected' : '' }}>Publish</option>
                                <option value="0"{{ $playlist->is_active == '0' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                        <div class="form-group text-end">
                            <button class="btn btn-success" type="submit">Simpan</button>
                            <a href="{{ route('playlist.store') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</div>
@endsection
