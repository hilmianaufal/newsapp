<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ManajemenUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('manajemen.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manajemen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
        'nama' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'role' => 'required|in:admin,penulis', // Tambahkan validasi untuk role
    ]);
        $avatarPath = null;
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
    }
    User::create([
        'nama' => $request->nama,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'avatar' => $avatarPath,
        'bio' => $request->bio,
        'no_hp' => $request->no_hp,
        'tanggal_lahir' => $request->tanggal_lahir,
        'role' => $request->role,
    ]);
    Alert::success('Berhasil', 'Data User Berhasil Ditambahkan');
    return redirect()->route('manajemen.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('manajemen.show' , compact ('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('manajemen.edit', compact('user'));
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
         $user = User::findOrFail($id);

    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $id,
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'no_hp' => 'nullable|string|max:20',
        'tanggal_lahir' => 'nullable|date',
        'bio' => 'nullable|string',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'current_password' => 'nullable|required_with:password|string',
        'password' => 'nullable|string|min:8|confirmed',
        'role' => 'required|in:admin,penulis',
        
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
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
        $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
    }

    $user->update($validated);

    Alert::success('Berhasil', 'Profil Anda telah diperbarui');
    return redirect()->route('manajemen.index')->with('success', 'Profil berhasil diperbarui.');
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
