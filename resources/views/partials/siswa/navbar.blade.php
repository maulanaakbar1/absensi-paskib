<header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-40">
    <button @click="sidebarOpen = true" class="p-2 md:hidden text-slate-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div class="hidden md:block">
        <p class="text-sm font-medium text-slate-400">Panel Siswa • SMKN 1 Talaga</p>
    </div>

    <div class="flex items-center gap-4">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-slate-800 leading-none">{{ Auth::user()->name }}</p>
            <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mt-1">Siswa</p>
        </div>
        <div class="h-10 w-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 font-bold border border-slate-200">
            {{ substr(Auth::user()->name, 0, 1) }}
        </div>
    </div>
</header>