@extends('layouts.default')

@section('content')


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Start -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Slide</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('slide.update' , $slide->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="judul">Judul Slide</label>
                            <input type="text" name="judul_slide" value="{{ $slide->judul_slide }}" class="form-control" id="judul" placeholder="Masukan Judul Slide" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="body">URL</label>
                            <textarea name="link" cols="30" value="" id="konten" rows="10" class="form-control">{{ $slide->link }}</textarea>
                        </div>
                         <div class="form-group mb-3">
                            <label for="gambar">Gambar </label>
                            <input type="file" name="gambar_slide" class="form-control" id="gambar" >
                            <br>
                            <img src="{{ asset('uploads/' . $slide->gambar_slide) }}" width="100" alt="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1"{{ $slide->status == '1' ? 'selected' : '' }}>Publish</option>
                                <option value="0"{{ $slide->status == '0' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                        <div class="form-group text-end">
                            <button class="btn btn-success" type="submit">Simpan</button>
                            <a href="{{ route('slide.store') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</div>
@endsection
