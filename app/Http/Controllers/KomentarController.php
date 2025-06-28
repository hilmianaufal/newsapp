<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artikel;
use App\Models\Komentar;
use Illuminate\Http\Request;
use App\Notifications\KomentarBaru;
use RealRashid\SweetAlert\Facades\Alert;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $komentarLama = Komentar::latest()->take(10)->get();
        $komentarBaru = Komentar::oldest()->take(10)->get();
         $unread = auth()->user()->unreadNotifications;
        return view('komentar.index', compact('komentarBaru','komentarLama','unread'));
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
        

public function store(Request $request, Artikel $artikel)
{
    // Validasi input
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'pesan' => 'required|string',
    ]);

    // Simpan komentar ke artikel terkait
    $komentar = $artikel->komentars()->create($validated);

    // Kirim notifikasi ke semua user (termasuk admin, penulis, dll)
    $users = User::all(); // opsional: tidak kirim ke diri sendiri
    foreach ($users as $user) {
        $user->notify(new KomentarBaru($komentar));
    }

    // Redirect kembali dengan pesan sukses
    return back()->with('success', 'Komentar berhasil dikirim.');
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
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();
        Alert::success('Berhasil', 'Komentar berhasil dihapus');

        return redirect()->route('komentar.index');
    }
}
