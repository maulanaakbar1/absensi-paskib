<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\HariLibur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        // ✅ Cek biodata
        $isComplete = $siswa->nisn && $siswa->alamat && $siswa->nama_ayah;

        $today = Carbon::today();
        $hariIni = $today->translatedFormat('l'); // Senin, Selasa, dll

        $ekskulId = $siswa->ekstrakurikuler_id;

        // ✅ CEK JADWAL
        $adaJadwal = Jadwal::where('ekstrakurikuler_id', $ekskulId)
            ->where('hari', $hariIni)
            ->exists();

        // ✅ CEK LIBUR (DARI DB)
        $isLibur = HariLibur::where('ekstrakurikuler_id', $ekskulId)
            ->whereDate('tanggal', $today)
            ->exists();

        // ✅ CEK SUDAH ABSEN
        $absenHariIni = Absensi::where('siswa_id', $siswa->id)
            ->whereDate('tanggal', $today)
            ->first();

        return view('siswa.absen', compact(
            'absenHariIni',
            'isComplete',
            'adaJadwal',
            'isLibur'
        ));
    }

    public function store(Request $request)
    {
        $siswa = Auth::user()->siswa;

        // ❌ PROTEK BIODATA
        if (!$siswa->nisn || !$siswa->alamat || !$siswa->nama_ayah) {
            return redirect()->route('siswa.profile')
                ->with('error', 'Lengkapi biodata dulu sebelum absen!');
        }

        $today = Carbon::today();
        $hariIni = $today->translatedFormat('l');

        // ❌ CEK JADWAL
        $adaJadwal = Jadwal::where('ekstrakurikuler_id', $siswa->ekstrakurikuler_id)
            ->where('hari', $hariIni)
            ->exists();

        if (!$adaJadwal) {
            return back()->with('error', 'Tidak ada jadwal latihan hari ini!');
        }

        // ❌ CEK LIBUR
        $isLibur = HariLibur::where('ekstrakurikuler_id', $siswa->ekstrakurikuler_id)
            ->whereDate('tanggal', $today)
            ->exists();

        if ($isLibur) {
            return back()->with('error', 'Hari ini adalah hari libur!');
        }

        // ❌ CEK SUDAH ABSEN
        $sudahAbsen = Absensi::where('siswa_id', $siswa->id)
            ->whereDate('tanggal', $today)
            ->exists();

        if ($sudahAbsen) {
            return redirect()->route('siswa.absen.riwayat')
                ->with('error', 'Anda sudah absen hari ini!');
        }

        $request->validate([
            'foto' => 'required',
            'lokasi' => 'required',
            'status' => 'required|in:hadir,izin,sakit'
        ]);

        // ✅ SIMPAN
        Absensi::create([
            'siswa_id' => $siswa->id,
            'tanggal' => $today,
            'jam_masuk' => Carbon::now()->toTimeString(),
            'foto' => $request->foto,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
            'keterangan' => $request->keterangan ?? 'Absensi Kamera',
        ]);

        return redirect()->route('siswa.absen.riwayat')
            ->with('success', 'Berhasil melakukan absensi!');
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