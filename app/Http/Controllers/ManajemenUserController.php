<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ManajemenUserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('manajemen.index', compact('user'));
    }

    public function create()
    {
        return view('manajemen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|in:admin,penulis',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/avatars'), $filename);
            $avatarPath = 'uploads/avatars/' . $filename;
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

    public function show($id)
    {
        $user = User::find($id);
        return view('manajemen.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('manajemen.edit', compact('user'));
    }

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

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama salah']);
            }
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/avatars'), $filename);
            $validated['avatar'] = 'uploads/avatars/' . $filename;
        }

        $user->update($validated);

        Alert::success('Berhasil', 'Profil berhasil diperbarui');
        return redirect()->route('manajemen.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            $user->delete();
            Alert::success('Berhasil', 'User berhasil dihapus');
            return redirect()->route('manajemen.index')->with('success', 'User berhasil dihapus.');
        }

        Alert::error('Gagal', 'User tidak ditemukan');
        return redirect()->route('manajemen.index');
    }
}
