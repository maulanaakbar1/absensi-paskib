<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index()
    {
        $anggota = Siswa::with(['user', 'ekstrakurikuler'])->latest()->get();
        $ekskul = Ekstrakurikuler::all();
        return view('admin.siswa', compact('anggota', 'ekskul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nis' => 'required|unique:siswas,nis',
            'kelas' => 'required',
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikulers,id'
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'siswa',
            ]);

            Siswa::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'kelas' => $request->kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'ekstrakurikuler_id' => $request->ekstrakurikuler_id,
            ]);
        });

        return back()->with('success', 'Siswa baru berhasil didaftarkan.');
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
        ]);

        DB::transaction(function () use ($request, $user, $siswa) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            $siswa->update([
                'nis' => $request->nis,
                'kelas' => $request->kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'ekstrakurikuler_id' => $request->ekstrakurikuler_id,
            ]);
        });

        return back()->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;
        $siswa->delete();
        $user->delete();

        return back()->with('success', 'Data siswa dan akun akses berhasil dihapus.');
    }
}