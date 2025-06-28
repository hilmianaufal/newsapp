<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IklanController extends Controller
{
    public function index()
    {
        $iklan = Iklan::all();
        $unread = auth()->user()->unreadNotifications;
        return view('iklan.index', compact('iklan', 'unread'));
    }

    public function create()
    {
        return view('iklan.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_iklan' => 'required|min:5',
            'gambar_iklan' => 'nullable|image|mimes:jpg,jpeg,jfif,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_iklan')) {
            $file = $request->file('gambar_iklan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/iklan'), $filename);
            $data['gambar_iklan'] = 'uploads/iklan/' . $filename;
        }

        Iklan::create($data);

        Alert::success('Berhasil', 'Iklan Berhasil Ditambahkan');
        return redirect()->route('iklan.index')->with('success', 'Iklan Berhasil Ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $iklan = Iklan::find($id);
        return view('iklan.edit', compact('iklan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul_iklan' => 'required',
            'link' => 'required'
        ]);

        $iklan = Iklan::find($id);

        if (!$iklan) {
            Alert::error('Gagal', 'Iklan tidak ditemukan');
            return redirect()->route('iklan.index');
        }

        if ($request->hasFile('gambar_iklan')) {
            if ($iklan->gambar_iklan && file_exists(public_path($iklan->gambar_iklan))) {
                unlink(public_path($iklan->gambar_iklan));
            }

            $file = $request->file('gambar_iklan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/iklan'), $filename);
            $iklan->gambar_iklan = 'uploads/iklan/' . $filename;
        }

        $iklan->update([
            'judul_iklan' => $request->judul_iklan,
            'link' => $request->link,
            'status' => $request->status,
            'gambar_iklan' => $iklan->gambar_iklan // tetap pakai lama jika tidak diganti
        ]);

        Alert::success('Berhasil', 'Iklan Berhasil Diupdate');
        return redirect()->route('iklan.index')->with('success', 'Iklan Berhasil Diupdate');
    }

    public function destroy(Iklan $iklan)
    {
        if ($iklan->gambar_iklan && file_exists(public_path($iklan->gambar_iklan))) {
            unlink(public_path($iklan->gambar_iklan));
        }

        $iklan->delete();
        Alert::success('Berhasil', 'Iklan Berhasil Dihapus');
        return redirect()->route('iklan.index')->with('danger', 'Iklan Berhasil Dihapus');
    }

    public function showIklan()
    {
        $iklan = Iklan::all();
        return view('frontend.layouts.frontend', compact('iklan'));
    }
}
