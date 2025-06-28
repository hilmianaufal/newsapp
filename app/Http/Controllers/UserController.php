<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
         $unread = auth()->user()->unreadNotifications;
        return view('users.index', compact('user','unread'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
        $user = Auth::user();
        return view('users.edit',compact('user'));
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
      
    $user = Auth::user();

    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'no_hp' => 'nullable|string|max:20',
        'tanggal_lahir' => 'nullable|date',
        'bio' => 'nullable|string',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'current_password' => 'nullable|required_with:password|string',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Ganti password jika diminta
    if ($request->filled('password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }
        $validated['password'] = Hash::make($request->password);
    } else {
        unset($validated['password']);
    }

    // Handle avatar upload
    if ($request->hasFile('avatar')) {
        if ($user->avatar && Storage::exists($user->avatar)) {
            Storage::delete($user->avatar);
        }
        $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
    }

    // Update user
    $user->update($validated);
    Alert::success('Berhasil', 'Profil Anda telah diperbarui');
    return redirect()->route('user.index')->with('success', 'Profil berhasil diperbarui.');
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
