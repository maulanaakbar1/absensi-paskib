<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{User, Pembina};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PembinaController extends Controller {
    public function index() {
        $pembinas = Pembina::with('user')->latest()->get();
        return view('admin.pembina', compact('pembinas'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pembina',
        ]);

        Pembina::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'no_telp' => $request->no_telp,
        ]);

        return back()->with('success', 'Pembina berhasil ditambahkan');
    }

    public function update(Request $request, $id) {
        $pembina = Pembina::findOrFail($id);
        $user = $pembina->user;

        $user->update(['name' => $request->name]);
        $pembina->update([
            'nip' => $request->nip,
            'no_telp' => $request->no_telp
        ]);

        return back()->with('success', 'Data diperbarui');
    }

    public function destroy($id) {
        $pembina = Pembina::findOrFail($id);
        $pembina->user->delete(); // Cascade delete akan menghapus data pembinanya
        return back()->with('success', 'Pembina dihapus');
    }
}