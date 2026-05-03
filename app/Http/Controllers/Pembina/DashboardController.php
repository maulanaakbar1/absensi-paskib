<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Models\Pembina;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data pembina dan ekskulnya
        $pembina = Pembina::where('user_id', Auth::id())
            ->with('ekstrakurikuler')
            ->first();

        if (!$pembina || !$pembina->ekstrakurikuler) {
            return view('pembina.dashboard', ['pembina' => $pembina, 'jumlahSiswa' => 0]);
        }

        $ekskulId = $pembina->ekstrakurikuler_id;

        // 2. Hitung jumlah siswa di ekskul tersebut
        $jumlahSiswa = Siswa::where('ekstrakurikuler_id', $ekskulId)->count();

        // 3. Ambil jadwal terdekat (berdasarkan hari ini)
        $daftarHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $hariIni = $daftarHari[date('N') - 1];
        
        $jadwalTerdekat = Jadwal::where('ekstrakurikuler_id', $ekskulId)
            ->where('hari', $hariIni)
            ->first();

        // 4. Ambil ringkasan absensi hari ini (opsional untuk tambahan info)
        $absensiHariIni = Absensi::whereHas('siswa', function($q) use ($ekskulId) {
                $q->where('ekstrakurikuler_id', $ekskulId);
            })
            ->whereDate('tanggal', Carbon::today())
            ->count();

        return view('pembina.dashboard', compact('pembina', 'jumlahSiswa', 'jadwalTerdekat', 'absensiHariIni'));
    }
}