@extends('layouts.default')

@section('content')


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Card Start -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Iklan Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('iklan.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="judul">Judul Iklan</label>
                            <input type="text" name="judul_iklan" class="form-control" id="judul" placeholder="Masukan Judul Slide" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="body">URL</label>
                            <input type="text" name="link" class="form-control" id="judul" placeholder="Masukan URL Slide" required>
                        </div>
                         <div class="form-group mb-3">
                            <label for="gambar">Gambar Iklan</label>
                            <input type="file" name="gambar_iklan" class="form-control" id="gambar" >
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Publish</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>
                        <div class="form-group text-end">
                            <button class="btn btn-success" type="submit">Simpan</button>
                            <a href="{{ route('iklan.store') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</div>
@endsection
