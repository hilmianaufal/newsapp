@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0"><i class="bi bi-gear-fill me-2"></i>Pengaturan Website</h4>
        </div>

        <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Kolom Kiri --}}
                    <div class="col-md-6">
                        {{-- Slogan --}}
                        <div class="mb-4">
                            <label for="slogan" class="form-label fw-bold">Slogan Website</label>
                            <input type="text" id="slogan" name="slogan" class="form-control"
                                   placeholder="Masukkan slogan website"
                                   value="{{ old('slogan', $setings->slogan ?? '') }}">
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">Alamat Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                   placeholder="contoh@email.com"
                                   value="{{ old('email', $setings->email ?? '') }}">
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-4">
                            <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="3">{{ old('alamat', $setings->alamat ?? '') }}</textarea>
                        </div>

                        {{-- No HP --}}
                        <div class="mb-4">
                            <label for="no_hp" class="form-label fw-bold">No. WhatsApp / HP</label>
                            <input type="text" id="no_hp" name="no_hp" class="form-control"
                                   value="{{ old('no_hp', $setings->no_hp ?? '') }}">
                        </div>

                        {{-- Copyright --}}
                        <div class="mb-4">
                            <label for="copyright" class="form-label fw-bold">Copyright</label>
                            <input type="text" id="copyright" name="copyright" class="form-control"
                                   placeholder="Contoh: &copy; 2025 All Rights Reserved by ..."
                                   value="{{ old('copyright', $setings->copyright ?? '') }}">
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="col-md-6">
                        {{-- Logo --}}
                        <div class="mb-4 text-center">
                            <label class="form-label fw-bold">Logo Website</label><br>
                            @if(isset($setings->logo))
                                <img src="{{ asset($setings->logo) }}" alt="Logo" class="img-thumbnail mb-2" style="max-height: 120px;">
                            @endif
                            <input type="file" name="logo" class="form-control mt-2">
                        </div>

                        {{-- Facebook --}}
                        <div class="mb-4">
                            <label for="facebook" class="form-label fw-bold">
                                <i class="bi bi-facebook text-primary me-1"></i>Link Facebook
                            </label>
                            <input type="url" id="facebook" name="facebook" class="form-control"
                                   placeholder="https://facebook.com/namamu"
                                   value="{{ old('facebook', $setings->facebook ?? '') }}">
                        </div>

                        {{-- Instagram --}}
                        <div class="mb-4">
                            <label for="instagram" class="form-label fw-bold">
                                <i class="bi bi-instagram text-danger me-1"></i>Link Instagram
                            </label>
                            <input type="url" id="instagram" name="instagram" class="form-control"
                                   placeholder="https://instagram.com/namamu"
                                   value="{{ old('instagram', $setings->instagram ?? '') }}">
                        </div>

                        {{-- YouTube --}}
                        <div class="mb-4">
                            <label for="youtube" class="form-label fw-bold">
                                <i class="bi bi-youtube text-danger me-1"></i>Link YouTube
                            </label>
                            <input type="url" id="youtube" name="youtube" class="form-control"
                                   placeholder="https://youtube.com/namamu"
                                   value="{{ old('youtube', $setings->youtube ?? '') }}">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save me-1"></i> Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
