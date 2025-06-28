<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Playlist;
use Illuminate\Http\Request;
class SearchController extends Controller
{
    public function select2(Request $request)
    {
        $search = $request->get('q');
        $results = [];

        // Artikel
        $artikels = Artikel::where('is_actived', 1)
            ->where('judul', 'like', "%{$search}%")
            ->limit(5)
            ->get();
        foreach ($artikels as $artikel) {
            $results[] = [
                'id' => 'artikel_' . $artikel->slug,
                'text' => 'Artikel: ' . $artikel->judul
            ];
        }

        // Tag
        $tags = Tag::where('nama_tag', 'like', "%{$search}%")->limit(5)->get();
        foreach ($tags as $tag) {
            $results[] = [
                'id' => 'tag_' . $tag->slug, // gunakan slug
                'text' => 'Tag: ' . $tag->nama_tag
            ];
        }

        // Kategori
        $kategoris = Kategori::where('nama_kategori', 'like', "%{$search}%")->limit(5)->get();
        foreach ($kategoris as $kategori) {
            $results[] = [
                'id' => 'kategori_' . $kategori->slug, // gunakan slug
                'text' => 'Kategori: ' . $kategori->nama_kategori
            ];
        }

        // Playlist
        $playlists = Playlist::where('judul_playlist', 'like', "%{$search}%")->limit(5)->get();
        foreach ($playlists as $playlist) {
            $results[] = [
                'id' => 'playlist_' . $playlist->slug, // gunakan slug
                'text' => 'Playlist: ' . $playlist->judul_playlist
            ];
        }

        return response()->json(['results' => $results]);
    }
}


