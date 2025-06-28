<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Slide::all();
        return view('slide.index', compact('slide'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slide.create');
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
            'judul_slide' => 'required||min:5',
            'gambar_slide' => 'mimes:jpg,jpeg,jfif,png'
        ]);

        if(!empty($request->file('gambar_slide'))){
            $data = $request->all();
            $data['gambar_slide'] = $request->file('gambar_slide')->store('slide');

            Slide::create($data);
        } else {
            $data = $request->all();
            Slide::create($data);

        }
        Alert::success('Berhasil', 'Slide Berhasil Ditambahkan');
        return redirect()->route('slide.index')->with('success', 'Slide Berhasil Di Tambahkan');


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
        $slide = Slide::find($id);

        return view('slide.edit', compact('slide'));
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
            'judul_slide' => 'required',
            'link' => 'required'
        ]);

        if (!empty($request->file('gambar_slide'))) {

            $data = Slide::find($id);
            $data->update([
                'judul_slide' => $request->judul_slide,
                'link' => $request->link,
                'status' => $request->status,
                'gambar_slide' => $request->file('gambar_slide')->store('slide')

            ]);
        } else {
            $data = Slide::find($id);
            $data->update([
                'judul_slide' => $request->judul_slide,
                'link' => $request->link,
                'status' => $request->status,


            ]);
        }
        Alert::success('Berhasil', 'Slide Berhasil Diupdate');
         return redirect()->route('slide.index')->with('success', 'Slide Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();
        Storage::delete($slide->gambar_slide);
        Alert::success('Berhasil', 'Slide Berhasil Dihapus');
        return redirect()->route('slide.index')->with('danger', 'Slide Berhasil Di Hapus');
    }
}
