@extends('layouts.app')

@section('content')

{{-- 1. STICKY INTERAKTIF NAV MELAYANG (SUDAH DISINKRONKAN RUTENYA) --}}
<div id="sticky-header" class="fixed top-0 left-0 w-full bg-white border-b border-gray-200 shadow-md z-[9999] transform -translate-y-full transition-transform duration-300">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <h1 class="text-2xl font-black text-[#1c1d1f] tracking-tighter">idemy</h1>
            <span class="text-gray-800 font-bold text-sm hidden md:block">Paket Personal</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-xs text-gray-500 hidden lg:block font-semibold">Mulai Rp116.000 per bulan. Batalkan kapan saja tanpa denda.</span>
            {{-- FIX: Mengarah langsung ke rute langganan, bukan register kosong --}}
            <a href="{{ route('subscribe.start') }}" 
                class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2.5 px-5 text-xs rounded-xl uppercase tracking-wider transition block text-center active:scale-95">
                Mulai langganan
            </a>
        </div>
    </div>
</div>

{{-- 2. HERO UTAMA PROMO BENEFIT --}}
<section class="max-w-7xl mx-auto mt-20 px-10">
    <div class="flex flex-col md:flex-row items-center justify-between gap-16">
        
        <div class="md:w-1/2 space-y-6">
            <p class="text-purple-700 font-black text-xs uppercase tracking-widest bg-purple-50 px-3 py-1 rounded inline-block border border-purple-100">Paket Personal Subscription</p>
            <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 leading-none tracking-tight">
                Bawa karier Anda<br>ke level berikutnya
            </h1>
            <p class="text-gray-600 text-lg leading-relaxed font-medium">
                Melangkah maju dalam pekerjaan dan kehidupan dengan akses langganan ke koleksi kursus berperingkat teratas dalam topik teknologi, bisnis, dan lainnya.
            </p>
            {{-- FIX: Mengarah langsung ke rute langganan, bukan register kosong --}}
            <a href="{{ route('subscribe.start') }}" 
                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-4 text-sm rounded-xl transition block text-center uppercase tracking-widest shadow-xl shadow-purple-100 active:scale-95">
                Mulai langganan sekarang
            </a>
            <p class="text-xs text-gray-400 font-bold italic">
                * Mulai Rp116.000 per bulan. Batalkan kapan saja secara fleksibel.
            </p>
        </div>
        
        <div class="md:w-1/2 flex justify-end">
            <img src="{{ asset('berlangganan.jpeg') }}" alt="Berlangganan" class="w-full max-w-[600px] object-contain rounded-2xl shadow-xl border border-gray-100" onerror="this.src='https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80';">
        </div>

    </div>
</section>

{{-- 3. WIDGET METRIK GRAFIK STATISTIK SEEDER --}}
<section class="max-w-7xl mx-auto px-10 mt-24 mb-0">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-center border-t border-b border-gray-200 py-12">
        
        <div>
            <h2 class="text-5xl font-black text-gray-900 tracking-tight">28,000+</h2>
            <p class="text-xs font-bold uppercase text-gray-400 tracking-wider mt-2">kursus atas permintaan</p>
        </div>
        
        <div>
            <h2 class="text-5xl font-black text-gray-900 tracking-tight">20,000+</h2>
            <p class="text-xs font-bold uppercase text-gray-400 tracking-wider mt-2">ujian praktik mandiri</p>
        </div>
        
        <div class="flex flex-col items-center">
            <h2 class="text-5xl font-black text-gray-900 flex justify-center items-center gap-1.5 tracking-tight">
                4.5 
                <svg class="w-8 h-8 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </h2>
            <p class="text-xs font-bold uppercase text-gray-400 tracking-wider mt-2">peringkat kursus rata-rata</p>
        </div>
        
        <div>
            <h2 class="text-5xl font-black text-gray-900 tracking-tight">9,000+</h2>
            <p class="text-xs font-bold uppercase text-gray-400 tracking-wider mt-2">instruktur teratas global</p>
        </div>

    </div>
</section>

{{-- 4. BANNER SPONSOR MITRA INDUSTRI --}}
<section class="bg-gray-50/60 py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <p class="text-center text-slate-500 font-bold text-sm uppercase tracking-widest mb-10">
            Dipercaya oleh lebih dari 17.000 perusahaan dan jutaan pembelajar di seluruh dunia
        </p>

        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-8 items-center justify-center filter grayscale opacity-60">
            <div class="flex justify-center"><img src="{{ asset('vw.png') }}" class="h-12 w-auto object-contain" alt="VW" onerror="this.style.display='none'"></div>
            <div class="flex justify-center"><img src="{{ asset('samsung.png') }}" class="h-10 w-auto object-contain" alt="Samsung" onerror="this.style.display='none'"></div>
            <div class="flex justify-center"><img src="{{ asset('cisco.png') }}" class="h-10 w-auto object-contain" alt="Cisco" onerror="this.style.display='none'"></div>
            <div class="flex justify-center"><img src="{{ asset('vimeo.png') }}" class="h-8 w-auto object-contain" alt="Vimeo" onerror="this.style.display='none'"></div>
            <div class="flex justify-center"><img src="{{ asset('pg.png') }}" class="h-12 w-auto object-contain" alt="P&G" onerror="this.style.display='none'"></div>
            <div class="flex justify-center"><img src="{{ asset('hpe.png') }}" class="h-10 w-auto object-contain" alt="HPE" onerror="this.style.display='none'"></div>
            <div class="flex justify-center"><img src="{{ asset('citi.png') }}" class="h-10 w-auto object-contain" alt="Citi" onerror="this.style.display='none'"></div>
            <div class="flex justify-center"><img src="{{ asset('ericsson.png') }}" class="h-10 w-auto object-contain" alt="Ericsson" onerror="this.style.display='none'"></div>
        </div>
    </div>
</section>

{{-- 5. BLOK DETAIL KEUNGGULAN MATERI AKADEMIS --}}
<section class="max-w-7xl mx-auto px-10 py-24 space-y-28">
    {{-- BARIS KURSUS 1 --}}
    <div class="flex flex-col md:flex-row items-center justify-between gap-16">
        <div class="md:w-1/2">
            <img src="{{ asset('iklan_langganan.jpeg') }}" alt="Skill Modern" class="w-full object-cover rounded-xl shadow-md border" onerror="this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80'">
        </div>
        <div class="md:w-1/2 space-y-4">
            <p class="text-purple-700 font-bold text-xs uppercase tracking-widest">Kurikulum Terkini</p>
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight tracking-tight">
                Skill modern untuk<br>mengasah ketajaman Anda
            </h2>
            <p class="text-gray-600 text-base leading-relaxed font-medium">
                Belajar dengan percaya diri dengan kursus terkini yang membahas topik paling diminati seperti AI untuk peran apa pun, sertifikasi komputasi cloud, pengembangan web, produktivitas, kepemimpinan, desain, pemasaran digital, dan lainnya.
            </p>
        </div>
    </div>

    {{-- BARIS KURSUS 2 --}}
    <div class="flex flex-col md:flex-row-reverse items-center justify-between gap-16">
        <div class="md:w-1/2">
            <img src="{{ asset('iklan2_langganan.jpeg') }}" alt="Kebebasan Bereksplorasi" class="w-full object-cover rounded-xl shadow-md border" onerror="this.src='https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=640&q=80'">
        </div>
        <div class="md:w-1/2 space-y-4">
            <p class="text-purple-700 font-bold text-xs uppercase tracking-widest">Fleksibilitas Belajar</p>
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight tracking-tight">
                Kebebasan untuk<br>bereksplorasi dan<br>mencari tahu
            </h2>
            <p class="text-gray-600 text-base leading-relaxed font-medium">
                Uji coba subjek baru, beralih antar kursus, atau sortir dan pick pelajaran yang paling sesuai dengan kebutuhan Anda. Paket Personal memberi Anda kekuatan untuk mengontrol apa yang Anda pelajari dan cara Anda belajar. Selain itu, gunakan Idemy AI Assistant untuk mendapatkan jawaban instan atas pertanyaan Anda selagi belajar.
            </p>
        </div>
    </div>

    {{-- BARIS KURSUS 3 --}}
    <div class="flex flex-col md:flex-row items-center justify-between gap-16">
        <div class="md:w-1/2">
            <img src="{{ asset('iklan3_langganan.jpeg') }}" alt="Pembelajaran Efektif" class="w-full object-cover rounded-xl shadow-md border" onerror="this.src='https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?w=640&q=80'">
        </div>
        <div class="md:w-1/2 space-y-4">
            <p class="text-purple-700 font-bold text-xs uppercase tracking-widest">Efektif & Bersertifikat</p>
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight tracking-tight">
                Pembelajaran yang<br>didesain untuk<br>membantu Anda mulai melakukan
            </h2>
            <p class="text-gray-600 text-base leading-relaxed font-medium">
                Dapatkan pengetahuan melalui praktik dengan simulasi Role Play AI, lab, latihan coding, dan simulasi tes ujian sertifikasi. Setelah Anda menyelesaikan kursus, tunjukkan skill baru Anda dengan sertifikat penyelesaian dari Idemy atau penerbit resmi seperti AWS, Microsoft, Google, CompTIA, dan PMI.
            </p>
        </div>
    </div>
</section>

{{-- 6. INTIP KOLEKSI HEADER --}}
<section class="max-w-7xl mx-auto px-10 pt-12 pb-4">
    <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-4">Intip koleksi kursus</h2>
    <p class="text-gray-600 text-base font-medium max-w-4xl leading-relaxed">
        Dengan ribuan kursus berperingkat tertinggi dari instruktur kompeten pilihan di Idemy, Paket Personal adalah gerbang utama yang akan mengantarkan langkah akademis kalian menuju kesuksesan industri nyata.
    </p>
</section>

{{-- 7. TABEL PERBANDINGAN STRUKTUR HARGA PAKET (MURNI SEEDER) --}}
<section class="bg-indigo-50/40 py-16 px-4 border-t border-b border-gray-100 mt-12">
    <h2 class="text-2xl lg:text-3xl font-black text-center text-gray-900 mb-12 tracking-tight">Pilih paket yang sesuai untuk Anda</h2>

    <div class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
        
        {{-- CARD KIRI: SUBSCRIPTION PLAN (PRE-ACTIVATED ROUTE) --}}
        <div class="border-2 border-purple-600 rounded-2xl bg-white flex flex-col shadow-xl relative overflow-hidden">
            <div class="bg-purple-600 text-white text-center py-2 font-bold flex justify-center items-center gap-1.5 text-xs uppercase tracking-wider">
                <i class="fas fa-star text-[10px]"></i> Harga terbaik pilihan mahasiswa
            </div>
            
            <div class="p-6 flex flex-col flex-grow text-center pt-8">
                <h3 class="text-xl font-black text-gray-900 mb-1">Paket Personal</h3>
                <p class="text-xs font-bold text-purple-700 mb-4">Sederhanakan sasaran karier Anda</p>
                <p class="text-gray-900 text-lg font-black mb-1">Mulai Rp116.000 / bulan</p>
                <p class="text-[11px] text-gray-400 font-semibold mb-6">Ditagih bulanan atau tahunan. Batalkan kapan pun.</p>

                <ul class="text-left space-y-3 mb-8 flex-grow">
                    <li class="flex items-start gap-2.5 text-xs font-semibold text-gray-600">
                        <i class="fas fa-check text-purple-600 mt-0.5"></i> <span>Lebih dari 28.000 kursus pengembangan profesional</span>
                    </li>
                    <li class="flex items-start gap-2.5 text-xs font-semibold text-gray-600">
                        <i class="fas fa-check text-purple-600 mt-0.5"></i> <span>Peringkat kepuasan rata-rata tinggi 4.5/5</span>
                    </li>
                    <li class="flex items-start gap-2.5 text-xs font-semibold text-gray-600">
                        <i class="fas fa-check text-purple-600 mt-0.5"></i> <span>Lebih dari 20.000+ materi latihan praktik coding</span>
                    </li>
                    <li class="flex items-start gap-2.5 text-xs font-semibold text-gray-600">
                        <i class="fas fa-check text-purple-600 mt-0.5"></i> <span>Diajar langsung oleh 9.000+ instruktur teratas</span>
                    </li>
                </ul>

                {{-- FIX: Mengarah langsung ke rute langganan, bukan register kosong --}}
                <a href="{{ route('subscribe.start') }}" 
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3.5 rounded-xl text-xs uppercase tracking-widest transition mt-auto block text-center shadow-md active:scale-95">
                    Mulai langganan paket
                </a>
            </div>
        </div>

        {{-- CARD KANAN: SINGLE COURSE PLAN --}}
        <div class="border border-gray-200 rounded-2xl bg-white flex flex-col shadow-sm p-6 justify-between">
            <div class="text-center pt-4">
                <h3 class="text-xl font-black text-gray-900 mb-1">Beli kursus individual</h3>
                <p class="text-xs font-bold text-gray-400 mb-4">Pelajari satu topik spesifik</p>
                <p class="text-gray-900 text-lg font-black mb-1">Rp149.000 - Rp1.799.000</p>
                <p class="text-[11px] text-gray-400 font-semibold mb-6">Bayar satu kali, kuasai selamanya</p>
                
                <ul class="text-left space-y-3 mb-8">
                    <li class="flex items-start gap-2.5 text-xs font-semibold text-gray-600">
                        <i class="fas fa-check text-purple-600 mt-0.5"></i> <span>Akses ke seluruh 250.000+ katalog materi bebas</span>
                    </li>
                    <li class="flex items-start gap-2.5 text-xs font-semibold text-gray-600">
                        <i class="fas fa-check text-purple-600 mt-0.5"></i> <span>Sistem bayar sesuai kursus yang diperlukan saja</span>
                    </li>
                </ul>
            </div>

            <a href="{{ url('/') }}" 
                class="w-full bg-gray-900 hover:bg-gray-800 text-white font-bold py-3.5 rounded-xl text-xs uppercase tracking-widest transition block text-center active:scale-95">
                Jelajahi Toko Kursus
            </a>
        </div>

    </div>
</section>

{{-- 8. AKORDEON FAQ COLLAPSIBLE UTAL (FIXED TAG OPENING ERROR) --}}
{{-- FAKTA PERBAIKAN: Memperbaiki tag ganda '<<section' bawaan lamamu menjadi '<section' yang valid --}}
<section class="max-w-4xl mx-auto px-6 py-20">
    <div class="md:pl-20">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-10 tracking-tight">
            Pertanyaan yang sering diajukan mengenai layanan
        </h2>

        <div class="flex flex-col divide-y divide-gray-200 border-b border-gray-200"> 
            @foreach($faqs ?? [] as $faq)
                <div class="w-full" x-data grandfather x-data="{ isOpen: false }">
                    <button 
                        @click="isOpen = !isOpen"
                        type="button"
                        class="w-full flex justify-between items-center text-left py-5 focus:outline-none group cursor-pointer">
                        <span class="text-base font-bold text-gray-800 group-hover:text-purple-700 transition-colors pr-8 leading-snug">
                            {{ $faq->question }}
                        </span>
                        <svg 
                            class="w-4 h-4 text-gray-500 transform transition-transform duration-300 flex-shrink-0 group-hover:text-purple-600" 
                            :class="isOpen ? 'rotate-180' : ''" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div 
                        x-show="isOpen" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-cloak
                        class="pb-6 text-gray-600 leading-relaxed text-sm font-medium pl-1">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 9. SCROLL TRACKER SCRIPT CONTROL --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stickyHeader = document.getElementById('sticky-header');
        if (stickyHeader) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 400) {
                    stickyHeader.classList.remove('-translate-y-full');
                } else {
                    stickyHeader.classList.add('-translate-y-full');
                }
            });
        }
    });
</script>

@endsection