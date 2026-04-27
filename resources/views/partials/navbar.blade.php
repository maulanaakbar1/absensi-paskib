<header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-10">
    <div class="flex items-center gap-4">
        <button class="md:hidden text-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
        </button>
        <h2 class="text-xl font-bold text-slate-800">@yield('title_page', 'Ringkasan Statistik')</h2>
    </div>
    <div class="flex items-center gap-3">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
            <p class="text-xs text-blue-500 font-medium capitalize">{{ Auth::user()->role }}</p>
        </div>
        <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-200 uppercase">
            {{ substr(Auth::user()->name, 0, 1) }}
        </div>
    </div>
</header>