@extends('layouts.app') 

@section('content')
<div class="p-6">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        {{-- Header & Filter --}}
        <div class="p-6 border-b border-slate-100">
            <form action="{{ route('pembina.rekap.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-semibold text-slate-600 mb-2">Pilih Bulan</label>
                    <select name="bulan" class="w-full border-slate-200 rounded-xl focus:ring-emerald-500">
                        @foreach($namaBulan as $key => $name)
                            <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-semibold text-slate-600 mb-2">Pilih Tahun</label>
                    <select name="tahun" class="w-full border-slate-200 rounded-xl focus:ring-emerald-500">
                        @for($i = date('Y'); $i >= date('Y')-2; $i--)
                            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="bg-cyan-500 hover:bg-cyan-600 text-white px-8 py-2.5 rounded-xl font-bold transition duration-200">
                    Filter
                </button>
            </form>
        </div>

        {{-- Legend --}}
        <div class="px-6 py-4 flex flex-wrap gap-6 bg-slate-50/50">
            <div class="flex items-center gap-2"><div class="w-4 h-4 bg-emerald-100 border border-emerald-200 rounded"></div> <span class="text-xs font-medium text-slate-600">Hadir</span></div>
            <div class="flex items-center gap-2"><div class="w-4 h-4 bg-amber-100 border border-amber-200 rounded"></div> <span class="text-xs font-medium text-slate-600">Sakit</span></div>
            <div class="flex items-center gap-2"><div class="w-4 h-4 bg-blue-100 border border-blue-200 rounded"></div> <span class="text-xs font-medium text-slate-600">Izin</span></div>
            <div class="flex items-center gap-2"><div class="w-4 h-4 bg-slate-400 rounded"></div> <span class="text-xs font-medium text-slate-600">Alpa</span></div>
            <div class="flex items-center gap-2"><div class="w-4 h-4 bg-red-500 rounded"></div> <span class="text-xs font-medium text-slate-600">Libur</span></div>
        </div>

        <div class="p-6">
            <h2 class="text-center text-xl font-bold text-slate-700 mb-6">Rekap Absensi Bulan {{ $namaBulan[$bulan] }} {{ $tahun }}</h2>
            
            <div class="overflow-x-auto border rounded-xl">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-4 py-3 border-b border-r font-bold text-center">No</th>
                            <th class="px-4 py-3 border-b border-r font-bold">NISN</th>
                            <th class="px-4 py-3 border-b border-r font-bold">Nama Siswa</th>
                            <th class="px-4 py-3 border-b border-r font-bold">Kelas</th>
                            @for($i = 1; $i <= $jumlahHari; $i++)
                                <th class="px-2 py-3 border-b border-r font-bold text-center w-8">{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($siswas as $index => $siswa)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 border-r text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 border-r">{{ $siswa->nisn }}</td>
                            <td class="px-4 py-3 border-r font-medium uppercase">
                                {{ $siswa->user->name ?? '-' }}
                            </td>
                            <td class="px-4 py-3 border-r">{{ $siswa->kelas }}</td>
                            
                            @for($i = 1; $i <= $jumlahHari; $i++)
                                @php
                                    $tgl = sprintf('%02d', $i);
                                    $fullDate = "$tahun-$bulan-$tgl";
                                    $absen = $siswa->absensis->firstWhere('tanggal', $fullDate);
                                    
                                    $bgColor = '';
                                    $statusChar = '';
                                    if($absen) {
                                        if($absen->status == 'hadir') $bgColor = 'bg-emerald-100 text-emerald-700';
                                        elseif($absen->status == 'sakit') $bgColor = 'bg-amber-100 text-amber-700';
                                        elseif($absen->status == 'izin') $bgColor = 'bg-blue-100 text-blue-700';
                                        elseif($absen->status == 'alpa') $bgColor = 'bg-slate-400 text-white';
                                        $statusChar = strtoupper(substr($absen->status, 0, 1));
                                    }
                                @endphp
                                <td class="p-1 border-r text-center {{ $bgColor }} text-[10px] font-bold">
                                    {{ $statusChar }}
                                </td>
                            @endfor
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection