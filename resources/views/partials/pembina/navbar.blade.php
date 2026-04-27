<nav class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between sticky top-0 z-30" x-data="{ open: false }">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="md:hidden text-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="hidden md:block">
            <h2 class="text-slate-800 font-extrabold text-lg leading-tight">Dashboard Pembina</h2>
        </div>
    </div>

    <div class="flex items-center gap-4 relative">
        <div class="flex flex-col text-right hidden sm:block">
            <p class="text-sm font-bold text-slate-800 leading-tight">{{ Auth::user()->name }}</p>
            <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-tighter">Pembina</p>
        </div>
        
        <button @click="open = !open" @click.away="open = false" class="h-10 w-10 rounded-xl bg-emerald-100 border border-emerald-200 flex items-center justify-center text-emerald-700 font-bold shadow-sm hover:bg-emerald-200 transition relative">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </button>

        <div x-show="open" 
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95"
             class="absolute right-0 top-full mt-2 w-48 bg-white border border-slate-200 rounded-2xl shadow-xl py-2 z-50">
            
            <a href="{{ route('pembina.profile') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 transition font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                Profil Saya
            </a>

            <hr class="my-2 border-slate-100">

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition font-bold text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" /></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>