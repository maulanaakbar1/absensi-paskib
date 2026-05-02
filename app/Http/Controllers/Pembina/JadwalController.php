<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $ekskulId = $user->pembina->ekstrakurikuler_id;
        
        $jadwals = Jadwal::where('ekstrakurikuler_id', $ekskulId)->get();
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('pembina.jadwal_latihan', compact('jadwals', 'hariList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'nullable|string' 
        ]);

        Jadwal::create([
            'ekstrakurikuler_id' => auth()->user()->pembina->ekstrakurikuler_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan, 
        ]);

        return back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());
        return back()->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        Jadwal::destroy($id);
        return back()->with('success', 'Jadwal berhasil dihapus');
    }
}