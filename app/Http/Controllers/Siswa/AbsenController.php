<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa;
        
        $absenHariIni = Absensi::where('siswa_id', $siswa->id)
                                ->whereDate('tanggal', Carbon::today())
                                ->first();

        $riwayatAbsen = Absensi::where('siswa_id', $siswa->id)
                                ->orderBy('tanggal', 'desc')
                                ->take(5)
                                ->get();

        return view('siswa.absen', compact('absenHariIni', 'riwayatAbsen'));
    }

    public function store(Request $request)
    {
        $siswa = Auth::user()->siswa;

        // Cek apakah sudah absen hari ini
        $sudahAbsen = Absensi::where('siswa_id', $siswa->id)
                            ->whereDate('tanggal', Carbon::today())
                            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Anda sudah melakukan absensi hari ini!');
        }

        Absensi::create([
            'siswa_id' => $siswa->id,
            'tanggal' => Carbon::today(),
            'jam_masuk' => Carbon::now()->format('H:i:s'),
            'status' => 'hadir',
            'keterangan' => 'Hadir tepat waktu',
        ]);

        return back()->with('success', 'Berhasil melakukan absensi!');
    }

    public function riwayat()
    {
        $siswa = Auth::user()->siswa;

        $semuaRiwayat = Absensi::where('siswa_id', $siswa->id)
                                ->orderBy('tanggal', 'desc')
                                ->paginate(10);

        return view('siswa.riwayat', compact('semuaRiwayat'));
    }
}