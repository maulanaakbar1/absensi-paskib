<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
        class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-200 flex flex-col transition-transform duration-300 ease-in-out md:relative md:translate-x-0 md:flex">
    
    <div class="p-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-blue-600">AbsensiPro</h1>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Pembina Panel</p>
        </div>
        <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    
    <nav class="flex-1 px-4 space-y-2">
        {{-- Dashboard --}}
        <a href="{{ route('pembina.dashboard') }}" 
            class="flex items-center gap-3 {{ Request::is('pembina/dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        {{-- Data Anggota --}}
        <a href="{{ route('pembina.anggota.index') }}"
            class="flex items-center gap-3 {{ Request::is('pembina/anggota*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Data Anggota
        </a>

        {{-- Rekap Absensi --}}
        <a href="{{ route('pembina.rekap.index') }}" 
            class="flex items-center gap-3 {{ Request::is('pembina/rekap*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 002-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Rekap Absensi
        </a>

        {{-- Manajemen Absensi (Halaman Baru) --}}
        <a href="{{ route('pembina.absensi.manage') }}" 
            class="flex items-center gap-3 {{ Request::is('pembina/absensi/manage*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Manajemen Absensi
        </a>

        {{-- Jadwal Latihan --}}
        <a href="{{ route('pembina.jadwal.index') }}" 
            class="flex items-center gap-3 {{ Request::is('pembina/jadwal*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Jadwal Latihan
        </a>

        {{-- Hari Libur --}}
        <a href="{{ route('pembina.libur.index') }}" 
            class="flex items-center gap-3 {{ Request::is('pembina/hari-libur*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2 2 4-4" />
            </svg>
            Hari Libur
        </a>

        <hr class="my-2 border-slate-100">

        {{-- Profil Saya --}}
        <a href="{{ route('pembina.profile') }}" 
            class="flex items-center gap-3 {{ Request::is('pembina/profile*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Profil Saya
        </a>
    </nav>

    {{-- Logout --}}
    <div class="p-4 border-t border-slate-100 mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 text-red-500 hover:bg-red-50 px-4 py-3 rounded-xl transition font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Keluar Aplikasi
            </button>
        </form>
    </div>
</aside>