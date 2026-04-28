<nav class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between sticky top-0 z-30">
    <div class="flex items-center gap-4">
        {{-- Burger Button untuk Mobile --}}
        <button @click="sidebarOpen = true" class="md:hidden text-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        
        <div class="hidden md:block">
            <h2 class="text-slate-800 font-extrabold text-lg leading-tight">Dashboard Pembina</h2>
        </div>
    </div>

    {{-- Bagian kanan dikosongkan agar rapi, atau bisa diisi teks sapaan statis --}}
    <div class="flex items-center gap-4">
        <p class="text-sm font-medium text-slate-400 hidden sm:block">
            Selamat Datang, <span class="font-bold text-slate-700">{{ Auth::user()->name }}</span>
        </p>
    </div>
</nav>