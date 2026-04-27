<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Pembina;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEkskul = Ekstrakurikuler::count();
        $totalPembina = Pembina::count();
        
        return view('admin.dashboard', compact('totalEkskul', 'totalPembina'));
    }
}