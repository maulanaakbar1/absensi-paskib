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
            'nis' => 'required|string|unique:siswas,nis,' . $siswa->id,
            'jenis_kelamin' => 'required|in:L,P',
            'nisn' => 'required|string|unique:siswas,nisn,' . $siswa->id,
            'alamat' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'nama_ayah' => 'nullable|string',
            'nama_ibu' => 'nullable|string',
            'no_telp_ayah' => 'nullable|string|max:15',
            'no_telp_ibu' => 'nullable|string|max:15',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $siswa->update([
            'nis' => $request->nis, 
            'jenis_kelamin' => $request->jenis_kelamin, 
            'kelas' => $request->kelas,
            'nisn' => $request->nisn,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_telp_ayah' => $request->no_telp_ayah,
            'no_telp_ibu' => $request->no_telp_ibu,
        ]);

        return back()->with('success', 'Profil dan data personal berhasil diperbarui!');
    }
}