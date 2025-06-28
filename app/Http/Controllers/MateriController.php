<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Playlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $playlist = Playlist::all();
        $materi = Materi::all();
        return view('materi.index', compact('playlist','materi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $playlist = Playlist::all();
        return view('materi.create',compact('playlist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
        'judul_materi' => 'required|min:4'
    ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul_materi);
        $data['gambar_materi'] = $request->file('gambar_materi')->store('materi');

        // $data['is_actived'] = $request->is_actived;
        Materi::create($data);
        Alert::success('Berhasil', 'Materi Berhasil Ditambahkan');
        return redirect()->route('materi.index')->with('success', 'Materi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materi = Materi::find($id);
        return view('materi.edit', compact('materi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (empty($request->file('gambar_materi'))) {

            $materi = Materi::find($id);
            $materi->update([
                'judul_materi' => $request->judul_materi,
                'deskripsi' => $request->deskripsi,
                'slug' => Str::slug($request->judul_materi),
                'is_active' => $request->is_active,



            ]);
                return redirect()->route('materi.index')->with('success', 'Materi berhasil diedit.');
        } else {
                 $materi = Materi::find($id);
                 Storage::delete($materi->gambar_materi);
                 $materi->update([
                'judul_materi' => $request->judul_materi,
                'deskripsi' => $request->deskripsi,
                'slug' => Str::slug($request->judul_materi),
                'is_active' => $request->is_active,
                'gambar_materi' => $request->file('gambar_materi')->store('materi')

            ]);
            Alert::success('Berhasil', 'Materi Berhasil Ditambahkan');
            return redirect()->route('materi.index')->with('success', 'Materi berhasil diedit.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        $materi->delete();
         Storage::delete($materi->gambar_materi);
         Alert::success('Berhasil', 'Materi Berhasil Dihapus');
        return redirect()->route('materi.index')->with('danger', 'Materi berhasil dihapus.');
    }
}
