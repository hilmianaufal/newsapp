<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use App\Models\Playlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user();
        if($user->role === Role::Admin) {
            $playlist = Playlist::all();
        } else {
            $playlist = Playlist::where('user_id', $user->id)->get();
        }
             $unread = auth()->user()->unreadNotifications;
        return view('playlist.index',compact('playlist','unread'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('playlist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'judul_playlist' => 'required|min:4',
        'gambar_playlist' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->all();
    $data['slug'] = Str::slug($request->judul_playlist);
    $data['user_id'] = Auth::id();
    $data['deskripsi'] = $request->deskripsi;
    $data['is_active'] = 0;

    // Simpan gambar langsung ke public/uploads/playlist
    if ($request->hasFile('gambar_playlist')) {
        $file = $request->file('gambar_playlist');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/playlist'), $filename);
        $data['gambar_playlist'] = 'uploads/playlist/' . $filename;
    }

    Playlist::create($data);
    Alert::success('Berhasil', 'Playlist Berhasil Ditambahkan');
    return redirect()->route('playlist.index')->with('success', 'Playlist berhasil disimpan.');
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
        $playlist = Playlist::find($id);
        return view('playlist.edit', compact('playlist'));
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
    $playlist = Playlist::find($id);

    if (!$playlist) {
        Alert::error('Gagal', 'Playlist tidak ditemukan');
        return redirect()->route('playlist.index');
    }

    // Jika ada file gambar baru
    if ($request->hasFile('gambar_playlist')) {
        // Hapus gambar lama jika ada
        if ($playlist->gambar_playlist && file_exists(public_path($playlist->gambar_playlist))) {
            unlink(public_path($playlist->gambar_playlist));
        }

        // Upload gambar baru
        $file = $request->file('gambar_playlist');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/playlist'), $filename);
        $playlist->gambar_playlist = 'uploads/playlist/' . $filename;
    }

    // Update field lainnya
    $playlist->update([
        'judul_playlist' => $request->judul_playlist,
        'deskripsi' => $request->deskripsi,
        'slug' => Str::slug($request->judul_playlist),
        'is_active' => $request->is_active,
        'user_id' => Auth::id(),
        'gambar_playlist' => $playlist->gambar_playlist // pakai yang baru atau tetap lama
    ]);

    Alert::success('Berhasil', 'Playlist Berhasil Diupdate');
    return redirect()->route('playlist.index')->with('success', 'Playlist berhasil diedit.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
        Storage::delete($playlist->gambar_playlist);
        Alert::success('Berhasil', 'Playlist Berhasil di Hapus');
        return redirect()->route('playlist.index')->with('danger', 'Artikel berhasil dihapus.');

    }
}
