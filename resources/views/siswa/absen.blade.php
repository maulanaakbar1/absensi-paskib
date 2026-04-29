@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4">
    <div class="max-w-md w-full">
        
        {{-- Header Status --}}
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Presensi Kehadiran</h2>
            <p class="text-slate-500 mt-2">Silakan lakukan absensi harian Anda di bawah ini.</p>
        </div>

        {{-- Card Utama --}}
        <div class="bg-white rounded-[2.5rem] border border-slate-200 overflow-hidden shadow-xl shadow-slate-200/60 transition-all duration-300">
            {{-- Header Card dengan Gradient Tipis --}}
            <div class="p-8 border-b border-slate-100 bg-gradient-to-br from-slate-50 to-white flex flex-col items-center">
                <div class="bg-white p-3 rounded-2xl shadow-sm border border-slate-100 mb-4">
                    <span class="text-blue-600 font-bold text-sm tracking-widest uppercase">
                        {{ now()->translatedFormat('M Y') }}
                    </span>
                </div>
                <h3 class="font-black text-slate-800 text-3xl">{{ now()->translatedFormat('d') }}</h3>
                <p class="text-sm font-medium text-slate-400 uppercase tracking-[0.2em] mt-1">
                    {{ now()->translatedFormat('l') }}
                </p>
            </div>

            {{-- Body Card --}}
            <div class="p-10 text-center">
                @if($absenHariIni)
                    {{-- State: Sudah Absen --}}
                    <div class="relative inline-flex mb-6">
                        <div class="absolute inset-0 bg-emerald-200 blur-2xl opacity-40 rounded-full"></div>
                        <div class="relative h-24 w-24 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-emerald-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    
                    <h4 class="font-bold text-slate-800 text-xl">Absensi Berhasil!</h4>
                    <div class="mt-3 inline-block px-4 py-2 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-sm text-slate-500">
                            Masuk pada <span class="font-bold text-slate-800">{{ $absenHariIni->jam_masuk }} WIB</span>
                        </p>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('siswa.absen.riwayat') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700 transition flex items-center justify-center gap-2">
                            Lihat Riwayat Saya
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                @else
                    {{-- State: Belum Absen --}}
                    <div class="relative inline-flex mb-6">
                        <div class="absolute inset-0 bg-blue-200 blur-2xl opacity-40 rounded-full"></div>
                        <div class="relative h-24 w-24 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-lg shadow-blue-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <h4 class="font-bold text-slate-800 text-xl">Siap untuk Hadir?</h4>
                    <p class="text-sm text-slate-400 mt-2">Pastikan Anda berada di lingkungan sekolah.</p>

                    <form action="{{ route('siswa.absen.store') }}" method="POST" class="mt-8">
                        @csrf
                        <button type="submit" 
                                class="w-full py-4 bg-blue-600 text-white rounded-2xl font-bold text-lg hover:bg-blue-700 hover:-translate-y-1 active:scale-95 transition-all duration-200 shadow-xl shadow-blue-200">
                            Hadir Sekarang
                        </button>
                    </form>
                @endif
            </div>
        </div>
        
    </div>
</div>
@endsection