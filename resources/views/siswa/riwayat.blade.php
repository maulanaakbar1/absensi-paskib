@extends('layouts.app')

@section('title_page', 'Riwayat Absensi')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <div>
                <h3 class="font-bold text-slate-800 text-lg">Semua Riwayat Absensi</h3>
                <p class="text-xs text-slate-500">Daftar kehadiran Anda selama ini</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center w-16">No</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Hari & Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Jam Masuk</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($semuaRiwayat as $index => $row)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4 text-sm text-slate-400 text-center font-medium">
                            {{ $semuaRiwayat->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-slate-700">
                            {{ \Carbon\Carbon::parse($row->tanggal)->translatedFormat('l, d F Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500 font-medium">
                            {{ $row->jam_masuk }} WIB
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase bg-emerald-50 text-emerald-600 border border-emerald-100">
                                {{ $row->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">
                            {{ $row->keterangan ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 002-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="text-slate-400 text-sm italic">Belum ada data absensi untuk ditampilkan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Tombol Navigasi Halaman (Pagination) --}}
        <div class="p-6 bg-slate-50/50 border-t border-slate-100">
            {{ $semuaRiwayat->links() }}
        </div>
    </div>
</div>
@endsection