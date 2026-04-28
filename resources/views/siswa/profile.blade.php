@extends('layouts.app') 

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50">
            <h3 class="text-xl font-extrabold text-slate-800">Profil Saya</h3>
            <p class="text-sm text-slate-500">Kelola informasi pribadi dan keamanan akun Anda</p>
        </div>

        <div class="p-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100 font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('siswa.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama --}}
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>

                    {{-- NIS (Read Only) --}}
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">NIS (Nomor Induk Siswa)</label>
                        <input type="text" value="{{ $siswa->nis }}" disabled 
                            class="w-full px-4 py-3 rounded-xl border border-slate-100 bg-slate-50 text-slate-400 cursor-not-allowed">
                    </div>

                    {{-- Email --}}
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>

                    {{-- Kelas --}}
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Kelas</label>
                        <input type="text" name="kelas" value="{{ old('kelas', $siswa->kelas) }}" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                </div>

                <hr class="my-8 border-slate-100">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Password Baru --}}
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 text-red-500">Password Baru (Kosongkan jika tidak ganti)</label>
                        <input type="password" name="password" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        class="px-8 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection