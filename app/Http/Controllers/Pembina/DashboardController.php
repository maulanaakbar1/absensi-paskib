<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Models\Pembina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pembina = Pembina::where('user_id', Auth::id())
            ->with('ekstrakurikuler')
            ->first();

        return view('pembina.dashboard', compact('pembina'));
    }
}