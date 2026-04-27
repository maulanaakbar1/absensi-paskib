@extends('layouts.app')
@section('title', 'Dashboard Pembina')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-2xl font-bold text-slate-800">Halo, {{ Auth::user()->name }}! 👋</h3>
            <p class="text-slate-500 text-sm">Selamat datang kembali di panel pembina ekskul.</p>
        </div>
        <div class="bg-white px-4 py-2 rounded-2xl border border-slate-200 flex items-center gap-3">
            <div class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></div>
            <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Status: Pembina Aktif</span>
        </div>
    </div>

    {{-- Main Stat Card --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                {{-- Logo/Image Ekskul --}}
                <div class="h-32 w-32 rounded-[2rem] bg-blue-600 flex items-center justify-center text-white text-4xl font-black shadow-2xl shadow-blue-200 overflow-hidden">
                    @if($pembina && $pembina->ekstrakurikuler && $pembina->ekstrakurikuler->foto)
                        <img src="{{ asset('storage/' . $pembina->ekstrakurikuler->foto) }}" class="w-full h-full object-cover">
                    @else
                        {{ substr($pembina->ekstrakurikuler->nama ?? '?', 0, 1) }}
                    @endif
                </div>
                
                <div>
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-[0.2em]">Ekskul yang Dibina</span>
                    <h2 class="text-3xl font-black text-slate-800 mt-1 mb-2">
                        {{ $pembina->ekstrakurikuler->nama ?? 'Belum Ditugaskan' }}
                    </h2>
                    <p class="text-slate-500 leading-relaxed max-w-md">
                        {{ $pembina->ekstrakurikuler->deskripsi ?? 'Silahkan hubungi admin untuk menetapkan tugas pembina pada unit ekstrakurikuler.' }}
                    </p>
                </div>
            </div>

            {{-- Background Decoration --}}
            <div class="absolute -right-10 -top-10 h-40 w-40 bg-blue-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-700"></div>
        </div>

        {{-- Side Widget --}}
        <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white shadow-xl flex flex-col justify-between">
            <div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Total Anggota</p>
                <h4 class="text-5xl font-black italic">0 <span class="text-xl font-normal not-italic text-slate-500">Siswa</span></h4>
            </div>
            <div class="mt-8 pt-6 border-t border-slate-800">
                <a href="#" class="flex items-center justify-between group">
                    <span class="font-bold text-sm">Lihat Daftar Anggota</span>
                    <div class="h-10 w-10 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-amber-50 border border-amber-100 p-6 rounded-3xl flex items-start gap-4">
            <div class="h-12 w-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center shadow-lg shadow-amber-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                </svg>
            </div>
            <div>
                <h5 class="font-bold text-slate-800">Pengumuman Terakhir</h5>
                <p class="text-sm text-slate-600 mt-1 italic">"Belum ada pengumuman terbaru untuk dibagikan ke anggota."</p>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-100 p-6 rounded-3xl flex items-start gap-4">
            <div class="h-12 w-12 rounded-2xl bg-blue-500 text-white flex items-center justify-center shadow-lg shadow-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h5 class="font-bold text-slate-800">Jadwal Terdekat</h5>
                <p class="text-sm text-slate-600 mt-1 italic">"Tidak ada jadwal latihan minggu ini."</p>
            </div>
        </div>
    </div>
</div>
@endsection