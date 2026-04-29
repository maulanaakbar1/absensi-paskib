@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Absensi Kehadiran</h2>
        <p class="text-slate-500">Ambil foto terbaik Anda sebagai bukti kehadiran hari ini.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- Kolom Kiri: Kamera & Preview --}}
        <div class="lg:col-span-7">
            <div class="bg-white p-4 rounded-[2.5rem] border border-slate-200 shadow-xl shadow-slate-200/50">
                <div class="relative aspect-video bg-slate-900 rounded-[2rem] overflow-hidden border-4 border-slate-50 shadow-inner">
                    
                    {{-- Layar Video (Live) --}}
                    <video id="webcam" autoplay playsinline class="w-full h-full object-cover -scale-x-100"></video>
                    
                    {{-- Layar Preview (Hasil Foto Statis) --}}
                    <img id="photo-preview" class="hidden w-full h-full object-cover" src="" alt="Preview">
                    
                    <canvas id="canvas" class="hidden"></canvas>
                    
                    {{-- Overlay Status --}}
                    <div id="camera-status" class="absolute top-6 left-6 flex items-center gap-2 bg-black/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/10">
                        <div class="h-2 w-2 bg-red-500 rounded-full animate-pulse"></div>
                        <span class="text-[10px] font-bold text-white uppercase tracking-widest">Live Camera</span>
                    </div>

                    <div id="review-status" class="hidden absolute top-6 left-6 flex items-center gap-2 bg-blue-600 px-4 py-2 rounded-full border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-[10px] font-bold text-white uppercase tracking-widest">Review Mode</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Detail & Controls --}}
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-lg shadow-slate-200/40">
                <div class="space-y-6">
                    {{-- Time & Date --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em]">Waktu Server</p>
                            {{-- Menggunakan format H:i untuk jam 24 jam --}}
                            <h3 id="realtime-clock" class="text-2xl font-bold text-slate-800">
                                {{ now()->format('H:i') }} <span class="text-sm font-medium text-slate-400">WIB</span>
                            </h3>
                        </div>
                        <div class="text-right">
                            {{-- isoFormat('D MMMM YYYY') menghasilkan: 29 April 2026 --}}
                            <p class="text-sm font-bold text-slate-800">{{ now()->isoFormat('D MMMM YYYY') }}</p>
                            {{-- isoFormat('dddd') menghasilkan: Rabu --}}
                            <p class="text-xs text-slate-400 font-semibold">{{ now()->isoFormat('dddd') }}</p>
                        </div>
                    </div>

                    <hr class="border-slate-100">

                    {{-- Location Card --}}
                    <div class="space-y-3">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Koordinat Lokasi</p>
                        <div id="location-box" class="bg-slate-50 rounded-2xl p-4 border border-slate-100 transition-all duration-500">
                            <div class="flex items-start gap-4">
                                <div class="h-10 w-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-blue-600 border border-slate-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 overflow-hidden text-ellipsis">
                                    <p id="location-text" class="text-xs font-mono text-slate-500 leading-relaxed italic">Mencari sinyal GPS...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Form Area --}}
                    @if(!$absenHariIni)
                    <form action="{{ route('siswa.absen.store') }}" method="POST" id="absen-form" class="space-y-6">
                        @csrf
                        {{-- Hidden Input untuk Data --}}
                        <input type="hidden" name="foto" id="image-input">
                        <input type="hidden" name="lokasi" id="location-input">

                        {{-- Input Status & Keterangan (Diletakkan di area kosong) --}}
                        <div class="space-y-4">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Status Kehadiran</label>
                                <select name="status" class="w-full mt-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Catatan / Keterangan</label>
                                <textarea name="keterangan" rows="2" placeholder="Contoh: Hadir tepat waktu di sekolah" 
                                    class="w-full mt-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition-all resize-none text-slate-600"></textarea>
                            </div>
                        </div>

                        {{-- Kontrol Tombol --}}
                        <div id="controls" class="pt-2">
                            {{-- Mode Live: Ambil Gambar --}}
                            <div id="live-buttons">
                                <button type="button" onclick="captureImage()" id="btn-capture" disabled
                                        class="w-full py-5 bg-slate-800 text-white rounded-2xl font-bold text-lg hover:bg-slate-900 hover:-translate-y-1 active:scale-95 disabled:opacity-50 disabled:translate-y-0 transition-all duration-300 shadow-xl shadow-slate-200 flex items-center justify-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Ambil Foto
                                </button>
                            </div>

                            {{-- Mode Review: Ulangi & Kirim --}}
                            <div id="review-buttons" class="hidden grid grid-cols-12 gap-3">
                                <button type="button" onclick="retakeImage()"
                                        class="col-span-4 py-5 bg-slate-100 text-slate-600 rounded-2xl font-bold text-sm hover:bg-slate-200 transition-all duration-300 border border-slate-200">
                                    Ulangi
                                </button>
                                <button type="submit" 
                                        class="col-span-8 py-5 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Kirim Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                    @else
                    {{-- Tampilan Jika Sudah Absen --}}
                    <div class="p-6 bg-emerald-50 rounded-2xl border border-emerald-100 flex flex-col items-center text-center gap-3">
                        <div class="h-12 w-12 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-emerald-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-lg font-black text-emerald-800">Sudah Absensi</p>
                            <p class="text-sm text-emerald-600 font-medium">Jam Masuk: {{ $absenHariIni->jam_masuk }} WIB</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const video = document.getElementById('webcam');
    const photoPreview = document.getElementById('photo-preview');
    const canvas = document.getElementById('canvas');
    const liveButtons = document.getElementById('live-buttons');
    const reviewButtons = document.getElementById('review-buttons');
    const cameraStatus = document.getElementById('camera-status');
    const reviewStatus = document.getElementById('review-status');
    
    const imageInput = document.getElementById('image-input');
    const locationInput = document.getElementById('location-input');
    const locationText = document.getElementById('location-text');
    const btnCapture = document.getElementById('btn-capture');
    const locationBox = document.getElementById('location-box');

    // 1. Akses Kamera
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" }, audio: false })
        .then(stream => { video.srcObject = stream; })
        .catch(err => { alert("Error: Akses kamera ditolak browser!"); });

    // 2. Geolocation Otomatis
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            locationInput.value = `${lat},${lng}`;
            locationText.innerText = `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
            locationText.classList.remove('italic', 'text-slate-500');
            locationText.classList.add('text-blue-600', 'font-bold');
            locationBox.classList.add('border-blue-200', 'bg-blue-50/50');
            btnCapture.disabled = false; // Aktifkan tombol capture jika lokasi ok
        }, err => {
            locationText.innerText = "Gagal mendapatkan lokasi. Aktifkan GPS!";
            locationText.classList.add('text-red-500');
        });
    }

    // 3. Ambil Foto
    function captureImage() {
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        
        // Mirroring fix agar hasil foto sama dengan preview live
        context.translate(canvas.width, 0);
        context.scale(-1, 1);
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        const dataUrl = canvas.toDataURL('image/jpeg');
        imageInput.value = dataUrl;
        
        // UI Switch
        photoPreview.src = dataUrl;
        photoPreview.classList.remove('hidden');
        video.classList.add('hidden');
        liveButtons.classList.add('hidden');
        reviewButtons.classList.remove('hidden');
        cameraStatus.classList.add('hidden');
        reviewStatus.classList.remove('hidden');
    }

    // 4. Reset Foto
    function retakeImage() {
        imageInput.value = "";
        photoPreview.classList.add('hidden');
        video.classList.remove('hidden');
        liveButtons.classList.remove('hidden');
        reviewButtons.classList.add('hidden');
        cameraStatus.classList.remove('hidden');
        reviewStatus.classList.add('hidden');
    }

    function updateClock() {
        const now = new Date();
        const options = { 
            timeZone: 'Asia/Jakarta', 
            hour: '2-digit', 
            minute: '2-digit', 
            hour12: false 
        };
        const timeString = new Intl.DateTimeFormat('id-ID', options).format(now);
        
        const clockElement = document.getElementById('realtime-clock');
        if(clockElement) {
            clockElement.innerHTML = `${timeString} <span class="text-sm font-medium text-slate-400">WIB</span>`;
        }
    }

    setInterval(updateClock, 1000);
    updateClock(); 
</script>
@endsection