@extends('layouts.default')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Card Start -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Artikel Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('artikel.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" class="form-control" id="judul" placeholder="Masukan Judul Artikel" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="body">Body</label>
                            <textarea name="body" id="editor" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Kategori">Kategori</label>
                            <select name="kategori_id" id="Kategori" class="form-control" required>
                                @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar Artikel</label><br>
                                <input class="form-control" type="file" name="gambar_artikel" id="gambar" onchange="previewImage(event)"">
                            </div>
                            <div class="mb-3">
                                <img id="imagePreview" src="{{ isset($item) && $item->gambar_artikel ? asset('uploads/' . $user->gambar_artikel) : '#' }}"
                                    class="img-thumbnail" style="max-width: 200px;" 
                                    alt="Preview" {{ isset($item) && $item->gambar_artikel ? '' : 'hidden' }}>
                            </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="is_actived" id="status" class="form-control">
                                <option value="1">Publish</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>
                        <!-- TAGS -->
                        <div class="form-group mb-3">
                            <label for="tags">Pilih Tag</label>
                            <select class="form-control select2" name="tags[]" multiple="multiple" id="tags">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->nama_tag }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- END TAGS -->
                        <div class="form-group text-end">
                            <button class="btn btn-success" type="submit">Simpan</button>
                            <a href="{{ route('artikel.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</div>
@endsection
