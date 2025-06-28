<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Slide;
use App\Models\Materi;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
        // Admin lihat semua data
        $ttlArtikel = Artikel::count();
        $ttlSlide = Slide::count();
        $ttlVideo = Materi::count();
        $ttlKategori = Kategori::count();
        $artTerbaru = Artikel::latest()->take(4)->get();
        $jmlVideo = Materi::latest()->take(4)->get();
    } else {
        // Penulis hanya lihat data miliknya
        $ttlArtikel = Artikel::where('user_id', $user->id)->count();
        $ttlSlide = Slide::all()->count(); // jika slide terkait user
        $ttlVideo = Materi::all()->count(); // jika materi terkait user
        $ttlKategori = Kategori::count(); // kategori bisa umum

        $artTerbaru = Artikel::where('user_id', $user->id)->latest()->take(4)->get();
        $jmlVideo = Playlist::where('user_id' , $user->id)->latest()->take(4)->get();
    }
         $notifications = auth()->user()->notifications;
         $unread = auth()->user()->unreadNotifications;
        return view('back.dashboard', compact('user','ttlArtikel','ttlSlide','ttlKategori','ttlVideo','artTerbaru','jmlVideo','notifications','unread'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
