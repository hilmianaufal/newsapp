<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Iklan;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Materi;
use App\Models\Setting;
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
        $setings = Setting::first();

        return view('frontend.layouts.frontend', compact('kategori' ,'artikel' ,'ktg' ,'art','berita3' ,'berita5','berita6','materi' ,'iklan','iklan2','berita8','slide','setings'));
    }

    public function detail($slug, Request $request)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        $artikels = Artikel::where('is_actived', 1)->latest()->take(20)->get();
        $kategori = Kategori::all();
        $komentar = Komentar::where('artikel_id', $artikel->id)->get();
        $tags = Artikel::with('tags')->where('slug', $slug)->firstOrFail();
        $setings = Setting::first();

        // 🔹 Pisahkan otomatis setiap 4 paragraf
       // 🔹 Bersihkan tag HTML dulu
        $textOnly = $artikel->body;

        // 🔹 Pecah berdasarkan titik dan spasi setelahnya (tanda akhir kalimat)
        $sentences = preg_split('/(?<=[.?!])\s+/', $textOnly, -1, PREG_SPLIT_NO_EMPTY);

        // 🔹 Gabung ulang jadi kalimat utuh dalam satu halaman (misal 5 kalimat per halaman)
        $grouped = array_chunk($sentences, 20);

        $page = max((int)$request->query('page', 1), 1);
        $currentContent = isset($grouped[$page - 1]) ? implode(' ', $grouped[$page - 1]) : implode(' ', $grouped[0]);
        $totalPages = count($grouped);

        return view('frontend.layouts.detail', compact(
            'artikel', 'artikels', 'kategori', 'komentar', 'tags', 'setings',
            'currentContent', 'totalPages', 'page'
        ));
    }


    public function showKategori($slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();
        $artikel = $kategori->artikel()->latest()->get();
        $jmlKategori = Kategori::all();
        $setting = Setting::first();

        return view('frontend.layouts.kategori', compact('artikel', 'kategori' ,'jmlKategori' ,'setting'));
    }

    // Di controller
    public function tabArtikel() {
        $kategori = Kategori::with(['artikels' => function($query) {
            $query->where('is_actived', 1)->latest()->take(4);
        }])->get();

    return view('frontend.includes.whatnews', compact('kategori'));
    }
    
    




}
