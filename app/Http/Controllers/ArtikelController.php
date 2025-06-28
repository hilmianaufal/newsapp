<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user = Auth::user();

    if ($user->role === Role::Admin) {
        // Admin lihat semua artikel
        $artikel = Artikel::all();
    } else {
        // Penulis hanya lihat artikel miliknya
        $artikel = Artikel::where('user_id', $user->id)->get();
    }
         $unread = auth()->user()->unreadNotifications;
        return view('artikel.index',compact('artikel','unread'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $tags = Tag::all();
        return view('artikel.create', compact('kategori','tags'));
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
        'judul' => 'required|min:4',
        'body' => 'required',
        'kategori_id' => 'required|exists:kategoris,id',
        'gambar_artikel' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'tags' => 'array|nullable', // Validasi array tag ID
        'tags.*' => 'exists:tags,id' // Setiap elemen harus valid
    ]);

    $data = $request->all();
    $data['slug'] = Str::slug($request->judul);
    $data['gambar_artikel'] = $request->file('gambar_artikel')->store('artikel');
    $data['user_id'] = Auth::id();
    $data['views'] = 0;

    $artikel = Artikel::create($data);

    // Simpan relasi ke tabel pivot jika ada
    if ($request->has('tags')) {
        $artikel->tags()->attach($request->tags);
    }

    Alert::success('Berhasil', 'Artikel Berhasil Ditambahkan');
    return redirect()->route('artikel.index');
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
        $artikel = Artikel::with('tags')->findOrFail($id);
        $kategori = Kategori::all();
        $tags = Tag::all();
        return view('artikel.edit', compact('artikel', 'kategori' ,'tags'));
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
    $artikel = Artikel::find($id);

    if (empty($request->file('gambar_artikel'))) {
        $artikel->update([
            'judul' => $request->judul,
            'body' => $request->body,
            'slug' => Str::slug($request->judul),
            'kategori_id' => $request->kategori_id,
            'is_actived' => $request->is_actived,
            'user_id' => Auth::id()
        ]);
    } else {
        Storage::delete($artikel->gambar_artikel);
        $artikel->update([
            'judul' => $request->judul,
            'body' => $request->body,
            'slug' => Str::slug($request->judul),
            'kategori_id' => $request->kategori_id,
            'is_actived' => $request->is_actived,
            'user_id' => Auth::id(),
            'gambar_artikel' => $request->file('gambar_artikel')->store('artikel')
        ]);
    }

    // 🚨 Tambahkan ini untuk menyimpan relasi tag
    if ($request->has('tags')) {
        $artikel->tags()->sync($request->tags);
    }

    Alert::success('Berhasil', 'Artikel Berhasil Diupdate');
    return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diedit.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        Storage::delete($artikel->gambar_artikel);
        Alert::success('Berhasil', 'Artikel Berhasil Dihapus');
        return redirect()->route('artikel.index')->with('danger', 'Artikel berhasil dihapus.');
    }

    public function searchSuggestions(Request $request)
{
    $results = Artikel::where('judul', 'like', '%' . $request->q . '%')->select('judul', 'slug')->limit(5)->get();
    return response()->json($results);
}

}
