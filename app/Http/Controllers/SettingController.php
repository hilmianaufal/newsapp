<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
{
    $setings = Setting::first(); // hanya satu baris
    return view('settings.index', compact('setings'));
}

public function update(Request $request)
{
    $request->validate([
        'logo' => 'image|mimes:png,jpg,jpeg|max:2048',
        'slogan' => 'required',
        'email' => 'required|email',
        'copyright' => 'required',
    ]);

    $setting = Setting::first();
    if (!$setting) $setting = new Setting();

    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/settings'), $filename);
        $setting->logo = 'uploads/settings/'.$filename;
    }
    
    $setting->slogan = $request->slogan;
    $setting->email = $request->email;
    $setting->copyright = $request->copyright;
    $setting->alamat = $request->alamat;
    $setting->no_hp = $request->no_hp;
    $setting->facebook = $request->facebook;
    $setting->instagram = $request->instagram;
    $setting->youtube = $request->youtube;

    $setting->save();

    return redirect()->back()->with('success', 'Pengaturan berhasil disimpan.');
}

}
