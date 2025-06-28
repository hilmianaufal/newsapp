<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SlideController extends Controller
{
    public function index()
    {
        $slide = Slide::all();
        return view('slide.index', compact('slide'));
    }

    public function create()
    {
        return view('slide.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_slide' => 'required|min:5',
            'gambar_slide' => 'nullable|image|mimes:jpg,jpeg,jfif,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_slide')) {
            $file = $request->file('gambar_slide');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/slide'), $filename);
            $data['gambar_slide'] = 'uploads/slide/' . $filename;
        }

        Slide::create($data);
        Alert::success('Berhasil', 'Slide Berhasil Ditambahkan');
        return redirect()->route('slide.index')->with('success', 'Slide Berhasil Ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slide = Slide::find($id);
        return view('slide.edit', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul_slide' => 'required',
            'link' => 'required'
        ]);

        $slide = Slide::find($id);

        if (!$slide) {
            Alert::error('Gagal', 'Slide tidak ditemukan');
            return redirect()->route('slide.index');
        }

        if ($request->hasFile('gambar_slide')) {
            // Hapus gambar lama jika ada
            if ($slide->gambar_slide && file_exists(public_path($slide->gambar_slide))) {
                unlink(public_path($slide->gambar_slide));
            }

            $file = $request->file('gambar_slide');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/slide'), $filename);
            $slide->gambar_slide = 'uploads/slide/' . $filename;
        }

        $slide->update([
            'judul_slide' => $request->judul_slide,
            'link' => $request->link,
            'status' => $request->status,
            'gambar_slide' => $slide->gambar_slide // tetap pakai lama jika tidak diubah
        ]);

        Alert::success('Berhasil', 'Slide Berhasil Diupdate');
        return redirect()->route('slide.index')->with('success', 'Slide Berhasil Diupdate');
    }

    public function destroy(Slide $slide)
    {
        // Hapus gambar dari public jika ada
        if ($slide->gambar_slide && file_exists(public_path($slide->gambar_slide))) {
            unlink(public_path($slide->gambar_slide));
        }

        $slide->delete();
        Alert::success('Berhasil', 'Slide Berhasil Dihapus');
        return redirect()->route('slide.index')->with('danger', 'Slide Berhasil Dihapus');
    }
}
