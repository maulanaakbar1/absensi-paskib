<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | EkskulMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen flex">

    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col hidden md:flex">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-blue-600">AbsensiPro</h1>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Administrator Panel</p>
        </div>
        
        <nav class="flex-1 px-4 space-y-2">
            <a href="#" class="flex items-center gap-3 bg-blue-50 text-blue-600 px-4 py-3 rounded-xl font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>
            <a href="#" class="flex items-center gap-3 text-slate-500 hover:bg-slate-50 px-4 py-3 rounded-xl transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Manajemen User
            </a>
            <a href="#" class="flex items-center gap-3 text-slate-500 hover:bg-slate-50 px-4 py-3 rounded-xl transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 00-2-2m0 0V5a2 2 0 012-2h6.28a2 2 0 011.414.586l.828.828A2 2 0 0014.12 5H19a2 2 0 012 2v2" />
                </svg>
                Data Ekskul
            </a>
        </nav>

        <div class="p-4 border-t border-slate-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 text-red-500 hover:bg-red-50 px-4 py-3 rounded-xl transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <button class="md:hidden text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <h2 class="text-xl font-bold text-slate-800">Ringkasan Statistik</h2>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-blue-500 font-medium">Administrator</p>
                </div>
                <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                    <p class="text-slate-500 text-sm font-medium">Total Siswa</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-1">120</h3>
                    <div class="mt-4 flex items-center text-xs text-green-500 font-bold bg-green-50 w-fit px-2 py-1 rounded-lg">
                        +12% Bulan ini
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                    <p class="text-slate-500 text-sm font-medium">Jumlah Ekskul</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-1">14</h3>
                    <p class="text-xs text-slate-400 mt-4">Aktif Semester Ini</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                    <p class="text-slate-500 text-sm font-medium">Kehadiran Rata-rata</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-1">92%</h3>
                    <p class="text-xs text-slate-400 mt-4">Stabil dari minggu lalu</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-[2rem] p-10 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold italic">Selamat Datang di AbsensiPro!</h2>
                    <p class="mt-2 text-blue-100 max-w-md">Kelola seluruh kegiatan ekstrakurikuler SMKN 1 Talaga dengan mudah dan transparan di sini.</p>
                </div>
                <div class="absolute right-[-20px] bottom-[-20px] opacity-20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-64 w-64" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            </div>
        </div>
    </main>

</body>
</html>