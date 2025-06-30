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
use RealRashid\SweetAlert\Facades\Alert;

class ArtikelController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === Role::Admin) {
            $artikel = Artikel::latest()->get();
        } else {
            $artikel = Artikel::where('user_id', $user->id)->latest()->get();
        }

        $unread = auth()->user()->unreadNotifications;
        return view('artikel.index', compact('artikel', 'unread'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $tags = Tag::all();
        return view('artikel.create', compact('kategori', 'tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|min:4',
            'body' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar_artikel' => 'required|image|mimes:jpg,jpeg,png,webp,jfif|max:2048',
            'tags' => 'array|nullable',
            'tags.*' => 'exists:tags,id'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);
        $data['user_id'] = Auth::id();
        $data['views'] = 0;

        // Simpan gambar ke public/uploads/artikel
        if ($request->hasFile('gambar_artikel')) {
            $file = $request->file('gambar_artikel');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('uploads/artikel');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['gambar_artikel'] = 'uploads/artikel/' . $filename;
        }

        $artikel = Artikel::create($data);

        if ($request->has('tags')) {
            $artikel->tags()->attach($request->tags);
        }

        Alert::success('Berhasil', 'Artikel Berhasil Ditambahkan');
        return redirect()->route('artikel.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $artikel = Artikel::with('tags')->findOrFail($id);
        $kategori = Kategori::all();
        $tags = Tag::all();
        return view('artikel.edit', compact('artikel', 'kategori', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($request->hasFile('gambar_artikel')) {
            // Hapus gambar lama
            if ($artikel->gambar_artikel && file_exists(public_path($artikel->gambar_artikel))) {
                unlink(public_path($artikel->gambar_artikel));
            }

            $file = $request->file('gambar_artikel');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('uploads/artikel');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $artikel->gambar_artikel = 'uploads/artikel/' . $filename;
        }

        $artikel->update([
            'judul' => $request->judul,
            'body' => $request->body,
            'slug' => Str::slug($request->judul),
            'kategori_id' => $request->kategori_id,
            'is_actived' => $request->is_actived,
            'user_id' => Auth::id(),
            'gambar_artikel' => $artikel->gambar_artikel,
        ]);

        if ($request->has('tags')) {
            $artikel->tags()->sync($request->tags);
        }

        Alert::success('Berhasil', 'Artikel Berhasil Diupdate');
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diedit.');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->gambar_artikel && file_exists(public_path($artikel->gambar_artikel))) {
            unlink(public_path($artikel->gambar_artikel));
        }

        $artikel->delete();

        Alert::success('Berhasil', 'Artikel Berhasil Dihapus');
        return redirect()->route('artikel.index')->with('danger', 'Artikel berhasil dihapus.');
    }

    public function searchSuggestions(Request $request)
    {
        $results = Artikel::where('judul', 'like', '%' . $request->q . '%')
            ->select('judul', 'slug')
            ->limit(5)
            ->get();

        return response()->json($results);
    }
}
