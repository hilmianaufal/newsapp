<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Iklan;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Materi;
use App\Models\Slide;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $artikel = Artikel::where('is_actived', 1)->latest()->get();
        $ktg = Kategori::latest()->first();
        $art = Artikel::latest()->first();
        $berita3 = Artikel::where('is_actived' ,1)->latest()->take(3)->get();
        $berita5 = Artikel::where('is_actived' ,1)->latest()->take(7)->get();
        $berita6 = Artikel::where('is_actived' ,1)->latest()->take(6)->get();
        $berita8 = Artikel::where('is_actived' ,1)->latest()->take(8)->get();
        $materi = Materi::where('is_active', 1)->latest()->take(3)->get();
        $iklan = Iklan::where('status', 1)->first();
        $iklan2 = Iklan::where('status', 1)->latest()->first();
       $slide = Slide::all();

        return view('frontend.layouts.frontend', compact('kategori' ,'artikel' ,'ktg' ,'art','berita3' ,'berita5','berita6','materi' ,'iklan','iklan2','berita8','slide'));
    }

    public function detail ($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        $artikels = Artikel::where('is_actived' , 1)->latest()->take(5)->get();
        $kategori = Kategori::all();
        $komentar = Komentar::where('artikel_id', $artikel->id)->get();
        $tags =  Artikel::with('tags')->where('slug', $slug)->firstOrFail();


        return view('frontend.layouts.detail', compact('artikel','artikels', 'kategori' ,'komentar','tags' ));
    }

    public function showKategori($slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();
        $artikel = $kategori->artikel()->latest()->get();
        $jmlKategori = Kategori::all();

        return view('frontend.layouts.kategori', compact('artikel', 'kategori' ,'jmlKategori'));
    }

    // Di controller
    public function tabArtikel() {
        $kategori = Kategori::with(['artikels' => function($query) {
            $query->where('is_actived', 1)->latest()->take(4);
        }])->get();

    return view('frontend.includes.whatnews', compact('kategori'));
    }
    
    




}
