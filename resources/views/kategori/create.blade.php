@extends('layouts.default')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Form Kategori</h2>
                <h5 class="text-white op-7 mb-2">Manajemen Kategori - Silakan tambahkan kategori sesuai kebutuhan</h5>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Start -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Kategori Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategoris.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="kategori">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" id="kategori" placeholder="Contoh: Pendidikan" required>
                        </div>
                        <div class="form-group text-end">
                            <button class="btn btn-success" type="submit">Simpan</button>
                            <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</div>
@endsection
