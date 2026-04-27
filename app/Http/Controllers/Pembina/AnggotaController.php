<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Siswa::with(['user', 'ekstrakurikuler'])->get();
        $ekskul = Ekstrakurikuler::all();
        return view('pembina.anggota', compact('anggota', 'ekskul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nis' => 'required|unique:siswas',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'ekstrakurikuler_id' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa'
        ]);

        Siswa::create([
            'user_id' => $user->id,
            'ekstrakurikuler_id' => $request->ekstrakurikuler_id,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return back()->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
            'kelas' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $siswa->update($request->only(['nis', 'kelas', 'jenis_kelamin', 'ekstrakurikuler_id']));

        return back()->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->user->delete(); // Ini otomatis hapus siswas karena cascade
        return back()->with('success', 'Anggota berhasil dihapus!');
    }
}