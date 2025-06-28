<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class IklanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iklan = Iklan::all();
         $unread = auth()->user()->unreadNotifications;
        return view('iklan.index', compact('iklan','unread'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('iklan.create');
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
            'judul_iklan' => 'required||min:5',
            'gambar_iklan' => 'mimes:jpg,jpeg,jfif,png'
        ]);

        if(!empty($request->file('gambar_iklan'))){
            $data = $request->all();
            $data['gambar_iklan'] = $request->file('gambar_iklan')->store('iklan');

            Iklan::create($data);
        } else {
            $data = $request->all();
            Iklan::create($data);

        }
        Alert::success('Berhasil', 'Iklan Berhasil Ditambahkan');
        return redirect()->route('iklan.index')->with('success', 'Iklan Berhasil Di Tambahkan');

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
        $iklan = Iklan::find($id);
        return view('iklan.edit', compact('iklan'));
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
             $this->validate($request,[
            'judul_iklan' => 'required',
            'link' => 'required'
        ]);

        if (!empty($request->file('gambar_iklan'))) {

            $data = Iklan::find($id);
            $data->update([
                'judul_iklan' => $request->judul_iklan,
                'link' => $request->link,
                'status' => $request->status,
                'gambar_iklan' => $request->file('gambar_iklan')->store('iklan')

            ]);
        } else {
            $data = Iklan::find($id);
            $data->update([
                'judul_iklan' => $request->judul_iklan,
                'link' => $request->link,
                'status' => $request->status,


            ]);
        }
        Alert::success('Berhasil', 'Iklan Berhasil Di update');
        return redirect()->route('iklan.index')->with('success', 'Iklan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Iklan $iklan)
    {
        $iklan->delete();
        Storage::delete($iklan->gambar_iklan);
        Alert::success('Berhasil', 'Artikel Berhasil Dihapus');
        return redirect()->route('iklan.index')->with('danger', 'Iklan Berhasil Dihapus');
    }

    public function showIklan(){
        $iklan = Iklan::all();

        return view('frontend.layouts.frontend', compact('iklan'));
    }
}
