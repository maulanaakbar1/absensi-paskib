@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('title_page', 'Dashboard Admin')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition hover:shadow-md">
            <p class="text-slate-500 text-sm font-medium">Total Siswa</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-1">120</h3>
            <div class="mt-4 flex items-center text-xs text-green-500 font-bold bg-green-50 w-fit px-2 py-1 rounded-lg">
                +12% Bulan ini
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition hover:shadow-md">
            <p class="text-slate-500 text-sm font-medium">Jumlah Ekskul</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-1">14</h3>
            <p class="text-xs text-slate-400 mt-4">Aktif Semester Ini</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition hover:shadow-md">
            <p class="text-slate-500 text-sm font-medium">Kehadiran Rata-rata</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-1">92%</h3>
            <p class="text-xs text-slate-400 mt-4">Stabil dari minggu lalu</p>
        </div>
    </div>

    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-[2.5rem] p-10 text-white relative overflow-hidden shadow-xl shadow-blue-100">
        <div class="relative z-10">
            <h2 class="text-3xl font-bold italic tracking-tight">Selamat Datang di AbsensiPro!</h2>
            <p class="mt-2 text-blue-100 max-w-md font-medium">Kelola seluruh kegiatan ekstrakurikuler SMKN 1 Talaga dengan mudah dan transparan di sini.</p>
        </div>
        <div class="absolute right-[-20px] bottom-[-20px] opacity-20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-64 w-64" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
        </div>
    </div>
@endsection