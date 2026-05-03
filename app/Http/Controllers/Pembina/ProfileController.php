<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Models\Pembina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pembina = Pembina::where('user_id', $user->id)->first();
        return view('pembina.profile', compact('user', 'pembina'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $pembina = Pembina::firstOrCreate([
            'user_id' => $user->id
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nip' => 'nullable|unique:pembinas,nip,' . $pembina->id,
            'no_telp' => 'nullable|max:15',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') 
                ? Hash::make($request->password) 
                : $user->password,
        ]);

        // Update pembina
        $pembina->update([
            'nip' => $request->nip,
            'no_telp' => $request->no_telp,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}