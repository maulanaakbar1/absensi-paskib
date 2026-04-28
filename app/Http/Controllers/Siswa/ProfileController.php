<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa; 
        
        return view('siswa.profile', compact('user', 'siswa'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'kelas' => 'required|string',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $siswa->update([
            'kelas' => $request->kelas,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}