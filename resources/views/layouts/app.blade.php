<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | EkskulMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen flex" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 md:hidden">
    </div>

    @include('partials.' . Auth::user()->role . '.sidebar')

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        @include('partials.' . Auth::user()->role . '.navbar')
        
        <div class="p-8">
            @if(session('warning_data'))
                <div class="mb-6 flex items-center justify-between gap-4 p-4 bg-amber-50 border border-amber-200 rounded-2xl shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-amber-900">Perhatian!</p>
                            <p class="text-xs text-amber-700 opacity-90">{{ session('warning_data') }}</p>
                        </div>
                    </div>
                    {{-- PASTIKAN ROUTE NYA ADALAH 'siswa.profile' --}}
                    <a href="{{ route('siswa.profile') }}" class="px-4 py-2 bg-amber-600 text-white text-xs font-bold rounded-xl hover:bg-amber-700 transition flex-shrink-0">
                        Lengkapi Sekarang
                    </a>
                </div>
            @endif

            @yield('content')
        </div>

        @include('partials.' . Auth::user()->role . '.footer')
    </main>

</body>
</html>