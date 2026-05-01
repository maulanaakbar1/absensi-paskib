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
        
        $jumlahHari = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;

        // --- TAMBAHKAN BARIS INI ---
        $user = auth()->user(); 
        // ---------------------------

        if ($user->role == 'admin') {
            $siswas = Siswa::with(['user','absensis' => function($q) use ($bulan,$tahun){
                $q->whereMonth('tanggal',$bulan)
                ->whereYear('tanggal',$tahun);
            }])->get();
        } else {
            // Sekarang variabel $user sudah bisa digunakan di sini
            $ekskulId = $user->pembina->ekstrakurikuler_id;

            $siswas = Siswa::with(['user','absensis' => function($q) use ($bulan,$tahun){
                $q->whereMonth('tanggal',$bulan)
                ->whereYear('tanggal',$tahun);
            }])->where('ekstrakurikuler_id',$ekskulId)->get();
        }

        $namaBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        return view('pembina.rekap_absensi', compact('siswas', 'bulan', 'tahun', 'jumlahHari', 'namaBulan'));
    }

    public function manage(Request $request)
    {
        $tanggal = $request->get('tanggal', date('Y-m-d'));
        
        $user = auth()->user();
        $ekskulId = $user->pembina->ekstrakurikuler_id;

        $siswas = Siswa::with(['user', 'absensis' => function($q) use ($tanggal) {
            $q->whereDate('tanggal', $tanggal);
        }])
        ->where('ekstrakurikuler_id', $ekskulId)
        ->get();

        return view('pembina.absensi_manage', compact('siswas', 'tanggal'));
    }
    
}