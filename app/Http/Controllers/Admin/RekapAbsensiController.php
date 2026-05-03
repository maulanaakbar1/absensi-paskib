<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Ekstrakurikuler;
use App\Models\HariLibur;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RekapAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));
        $ekskul = $request->get('ekskul', 'all');

        $jumlahHari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;

        $query = Siswa::with([
            'user',
            'absensis' => function ($q) use ($bulan, $tahun) {
                $q->whereMonth('tanggal', $bulan)
                    ->whereYear('tanggal', $tahun);
            }
        ]);

        if ($ekskul != 'all') {
            $query->where('ekstrakurikuler_id', $ekskul);
        }

        $siswas = $query->get();

        $listEkskul = Ekstrakurikuler::all();

        $hariLibur = HariLibur::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $jadwals = Jadwal::all();

        $namaBulan = [
            '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April',
            '05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus',
            '09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'
        ];

        return view('admin.rekap_absensi', compact(
            'siswas',
            'bulan',
            'tahun',
            'jumlahHari',
            'namaBulan',
            'listEkskul',
            'ekskul',
            'hariLibur',
            'jadwals'
        ));
    }
}