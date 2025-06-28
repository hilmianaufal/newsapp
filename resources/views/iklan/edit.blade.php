@extends('layouts.default')

@section('content')


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Start -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Iklan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('iklan.update' , $iklan->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="judul">Judul Iklan</label>
                            <input type="text" name="judul_iklan" value="{{ $iklan->judul_iklan }}" class="form-control" id="judul" placeholder="Masukan Judul Slide" required></input>
                        </div>
                        <div class="form-group mb-3">
                            <label for="body">URL</label>
                            <input name="link" cols="30" value="{{ $iklan->link }}>"  rows="10" class="form-control"></input>
                        </div>
                         <div class="form-group mb-3">
                            <label for="gambar">Gambar </label>
                            <input type="file" name="gambar_iklan" class="form-control" id="gambar" >
                            <br>
                            <img src="{{ asset('uploads/' . $iklan->gambar_iklan) }}" width="100" alt="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1"{{ $iklan->status == '1' ? 'selected' : '' }}>Publish</option>
                                <option value="0"{{ $iklan->status == '0' ? 'selected' : '' }}>Draft</option>
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
