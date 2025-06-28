@extends('layouts.default')

@section('content')


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Card Start -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Tag Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tag.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="judul">Nama Tag</label>
                            <input type="text" name="nama_tag" class="form-control" id="judul" placeholder="Masukan Nama Tag" required>
                        </div>
                        <div class="form-group text-end">
                            <button class="btn btn-success" type="submit">Simpan</button>
                            <a href="{{ route('tag.store') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</div>
@endsection
