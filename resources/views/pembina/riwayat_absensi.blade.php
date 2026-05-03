@extends('layouts.app')

@section('title_page', 'Riwayat Absensi Anggota')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center bg-slate-50/50 gap-4">
            <div>
                <h3 class="font-bold text-slate-800 text-lg">Riwayat Absensi Anggota</h3>
                <p class="text-xs text-slate-500">Memantau seluruh kehadiran siswa di ekstrakurikuler Anda</p>
            </div>
            
            <a href="{{ route('pembina.rekap.index') }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Lihat Rekap Bulanan
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase border-b text-center w-16">No</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase border-b">Nama</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase border-b">Kelas</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase border-b">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase border-b">Jam</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase border-b">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase border-b text-center">Foto</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase border-b text-center">Lokasi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                @forelse($riwayat as $index => $row)
                <tr class="hover:bg-slate-50/50 transition">

                    {{-- NO --}}
                    <td class="px-6 py-4 text-sm text-slate-400 text-center font-medium">
                        {{ $riwayat->firstItem() + $index }}
                    </td>

                    {{-- NAMA --}}
                    <td class="px-6 py-4 text-sm font-bold text-slate-700">
                        {{ $row->siswa->user->name }}
                    </td>

                    {{-- KELAS (DIPISAH) --}}
                    <td class="px-6 py-4 text-sm text-slate-600 font-semibold">
                        {{ $row->siswa->kelas }}
                    </td>

                    {{-- TANGGAL --}}
                    <td class="px-6 py-4 text-sm text-slate-600">
                        {{ \Carbon\Carbon::parse($row->tanggal)->translatedFormat('d M Y') }}
                    </td>

                    {{-- JAM --}}
                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $row->jam_masuk ?? '--:--' }}
                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-4">
                        @php
                            $statusColor = [
                                'hadir' => 'bg-emerald-50 text-emerald-600',
                                'sakit' => 'bg-amber-50 text-amber-600',
                                'izin'  => 'bg-blue-50 text-blue-600',
                                'alpa'  => 'bg-red-50 text-red-600',
                            ][$row->status] ?? 'bg-slate-50 text-slate-600';
                        @endphp

                        <span class="px-3 py-1 rounded-lg text-[10px] font-extrabold uppercase {{ $statusColor }}">
                            {{ $row->status }}
                        </span>
                    </td>

                    {{-- FOTO (DIBESARKAN) --}}
                    <td class="px-4 py-4 text-center">
                        @if($row->foto)
                            <button onclick="openImage('{{ $row->foto }}')">
                                <img src="{{ $row->foto }}" 
                                    class="w-16 md:w-20 h-auto aspect-[3/4] md:aspect-square object-cover rounded-xl border shadow hover:scale-105 transition mx-auto">
                            </button>
                        @else
                            <span class="text-slate-300 text-xs">-</span>
                        @endif
                    </td>

                    {{-- LOKASI (DIPISAH) --}}
                    <td class="px-6 py-4 text-center">
                        @if($row->lokasi)
                            <a href="https://www.google.com/maps?q={{ $row->lokasi }}" target="_blank"
                                class="group inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition shadow-sm">

                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    class="h-5 w-5 group-hover:scale-110 transition" 
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                        @else
                            <span class="text-slate-300 text-xs">-</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-slate-400">
                        Belum ada data
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        
        @if($riwayat->hasPages())
        <div class="p-6 bg-slate-50 border-t">
            {{ $riwayat->links() }}
        </div>
        @endif
    </div>
</div>

{{-- MODAL FOTO --}}
<div id="imageModal" class="fixed inset-0 bg-slate-900/80 hidden items-center justify-center z-[100] backdrop-blur-sm p-4" onclick="closeImage()">
    <div class="relative max-w-3xl w-full bg-white rounded-3xl overflow-hidden shadow-2xl" onclick="event.stopPropagation()">
        <div class="p-4 border-b border-slate-100 flex justify-between items-center">
            <h4 class="font-bold text-slate-800">Bukti Foto Absensi</h4>
            <button onclick="closeImage()" class="text-slate-400 hover:text-red-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-2 bg-slate-100">
            <img id="modalImage" class="w-full max-h-[70vh] object-contain rounded-xl">
        </div>
    </div>
</div>

<script>
function openImage(src) {
    document.getElementById('modalImage').src = src;
    const modal = document.getElementById('imageModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeImage() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection