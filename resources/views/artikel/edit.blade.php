@extends('layouts.default')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Form Artikel</h2>
                <h5 class="text-white op-7 mb-2">Manajemen Artikel Silakan Edit kategori sesuai kebutuhan</h5>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Card Start -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Artikel </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('artikel.update', $artikel->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" value="{{ $artikel->judul }}" class="form-control" id="judul" placeholder="Masukan Judul Artikel" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="body">Body</label>
                            <textarea name="body" id="konten"  cols="30" rows="10" class="form-control"> {{ $artikel->body }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Kategori">Kategori</label>

                            <select name="kategori_id" id="Kategori" class="form-control" required>
                                @foreach ($kategori as $item)


                                <option value="{{ $item->id }}" {{ $item->id == $artikel->kategori_id ? 'selected' : '' }}>{{ $item->nama_kategori }}</option>

                                @endforeach
                            </select>
                        </div>

                            <div class="form-group mb-3">
                                <label for="tags">Tags</label>
                                <select name="tags[]" id="tags" class="form-control select2" multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" 
                                            {{ $artikel->tags->contains($tag->id) ? 'selected' : '' }}>
                                            {{ $tag->nama_tag }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="is_actived" id="status" class="form-control">
                                <option value="1" {{ $artikel->is_actived == '1' ? 'selected' : '' }}>Publish</option>
                                <option value="0" {{ $artikel->is_actived == '0' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                           <label for="gambar">Gambar Artikel</label>
                           <input type="file" name="gambar_artikel" class="form-control" id="gambar" >
                           <br>
                           <img src="{{ asset('uploads/' . $artikel->gambar_artikel) }}" alt="" width="100">
                       </div>
                        <div class="form-group text-end">
                            <button class="btn btn-success" type="submit">Simpan</button>
                            <a href="{{ route('artikel.store') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</div>
@endsection
