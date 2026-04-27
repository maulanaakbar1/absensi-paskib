<nav class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between sticky top-0 z-30">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="md:hidden text-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="hidden md:block">
            <span class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest">EkskulMate</span>
            <h2 class="text-slate-800 font-extrabold text-lg leading-tight">Panel Pembina</h2>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <div class="flex flex-col text-right hidden sm:block">
            <p class="text-sm font-bold text-slate-800 leading-tight">{{ Auth::user()->name }}</p>
            <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-tighter">Pembina</p>
        </div>
        <div class="h-10 w-10 rounded-xl bg-emerald-100 border border-emerald-200 flex items-center justify-center text-emerald-700 font-bold shadow-sm">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>
</nav>