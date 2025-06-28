<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Playlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MateriController extends Controller
{
    public function index()
    {
        $playlist = Playlist::all();
        $materi = Materi::all();
        return view('materi.index', compact('playlist','materi'));
    }

    public function create()
    {
        $playlist = Playlist::all();
        return view('materi.create', compact('playlist'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_materi' => 'required|min:4',
            'gambar_materi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul_materi);

        // Simpan gambar ke public/uploads/materi jika ada
        if ($request->hasFile('gambar_materi')) {
            $file = $request->file('gambar_materi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/materi'), $filename);
            $data['gambar_materi'] = 'uploads/materi/' . $filename;
        }

        Materi::create($data);
        Alert::success('Berhasil', 'Materi Berhasil Ditambahkan');
        return redirect()->route('materi.index')->with('success', 'Materi berhasil disimpan.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $materi = Materi::find($id);
        return view('materi.edit', compact('materi'));
    }

    public function update(Request $request, $id)
    {
        $materi = Materi::find($id);

        if (!$materi) {
            Alert::error('Gagal', 'Materi tidak ditemukan');
            return redirect()->route('materi.index');
        }

        // Jika ada gambar baru
        if ($request->hasFile('gambar_materi')) {
            if ($materi->gambar_materi && file_exists(public_path($materi->gambar_materi))) {
                unlink(public_path($materi->gambar_materi));
            }

            $file = $request->file('gambar_materi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/materi'), $filename);
            $materi->gambar_materi = 'uploads/materi/' . $filename;
        }

        $materi->update([
            'judul_materi' => $request->judul_materi,
            'deskripsi' => $request->deskripsi,
            'slug' => Str::slug($request->judul_materi),
            'is_active' => $request->is_active,
            'gambar_materi' => $materi->gambar_materi // tetap pakai lama kalau tidak diganti
        ]);

        Alert::success('Berhasil', 'Materi Berhasil Diupdate');
        return redirect()->route('materi.index')->with('success', 'Materi berhasil diedit.');
    }

    public function destroy(Materi $materi)
    {
        // Hapus gambar dari folder public jika ada
        if ($materi->gambar_materi && file_exists(public_path($materi->gambar_materi))) {
            unlink(public_path($materi->gambar_materi));
        }

        $materi->delete();
        Alert::success('Berhasil', 'Materi Berhasil Dihapus');
        return redirect()->route('materi.index')->with('danger', 'Materi berhasil dihapus.');
    }
}
