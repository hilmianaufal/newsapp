@extends('layouts.default')

@section('content')


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Card Start -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Playlist Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('playlist.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="judul">Judul Playlist</label>
                            <input type="text" name="judul_playlist" class="form-control" id="judul" placeholder="Masukan Judul Artikel" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="body">Deskripsi</label>
                            <textarea name="deskripsi" cols="60" id="konten" rows="100" style="height: 300px; width: 100%; class="form-control"></textarea>
                        </div>
                         <div class="form-group mb-3">
                            <label for="gambar">Gambar </label>
                            <input type="file" name="gambar_playlist" class="form-control" id="gambar" >
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="is_actived" id="status" class="form-control">
                                <option value="1">Publish</option>
                                <option value="0">Draft</option>
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
