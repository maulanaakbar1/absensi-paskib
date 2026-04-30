<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RekapAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));
        
        $jumlahHari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;

        $user = Auth::user();

            if (!$user->pembina) {
                return redirect()->back()->with('error', 'Akun Anda tidak terdaftar sebagai Pembina.');
            }

            $ekskulId = $user->pembina->ekstrakurikuler_id;

            $siswas = Siswa::with(['user', 'absensis' => function($query) use ($bulan, $tahun) {
                $query->whereMonth('tanggal', $bulan)
                    ->whereYear('tanggal', $tahun);
            }])
            ->where('ekstrakurikuler_id', $ekskulId) // Gunakan variabel yang sudah divalidasi
            ->get();

        $namaBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        return view('pembina.rekap_absensi', compact('siswas', 'bulan', 'tahun', 'jumlahHari', 'namaBulan'));
    }
}