@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto mt-20 px-10">
    <div class="flex flex-col md:flex-row items-center justify-between gap-16">
        
        <div class="md:w-1/2">
            <p class="text-purple-700 font-bold text-base mb-3">Paket Personal</p>
            <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                Bawa karier Anda<br>ke level berikutnya
            </h1>
            <p class="text-gray-700 text-xl mb-8 leading-relaxed">
                Melangkah maju dalam pekerjaan dan kehidupan dengan akses langganan ke koleksi kursus berperingkat teratas dalam topik teknologi, bisnis, dan lainnya.
            </p>
            <a href="{{ route('register') }}" 
                class="mx-auto w-4/5 bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 text-sm rounded transition mt-auto block text-center">
                Mulai langganan
            </a>
            <p class="text-sm text-gray-500 mt-4">
                Mulai Rp116.000 per bulan. Batalkan kapan saja.
            </p>
        </div>
        
        <div class="md:w-1/2 flex justify-end">
            <img src="{{ asset('berlangganan.jpeg') }}" alt="Berlangganan" class="w-full max-w-[600px] object-contain">
        </div>

    </div>
</section>

<section class="max-w-7xl mx-auto px-10 mt-24 mb-0">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center border-t border-b border-gray-200 py-12">
        
        <div>
            <h2 class="text-5xl font-bold text-gray-900">28,000+</h2>
            <p class="text-base text-gray-500 mt-2">kursus atas permintaan</p>
        </div>
        
        <div>
            <h2 class="text-5xl font-bold text-gray-900">20,000+</h2>
            <p class="text-base text-gray-500 mt-2">ujian praktik</p>
        </div>
        
        <div class="flex flex-col items-center">
            <h2 class="text-5xl font-bold text-gray-900 flex justify-center items-center gap-2">
                4.5 
                <svg class="w-8 h-8 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </h2>
            <p class="text-base text-gray-500 mt-2">peringkat kursus rata-rata</p>
        </div>
        
        <div>
            <h2 class="text-5xl font-bold text-gray-900">9,000+</h2>
            <p class="text-base text-gray-500 mt-2">instruktur teratas</p>
        </div>

    </div>
</section>

<section class="bg-gray-50 py-12 md:py-16">
    <div class="bg-gray-100 py-16 px-4">
        <p class="text-center text-slate-700 font-light text-lg mb-8 tracking-wide">
            Dipercaya oleh lebih dari 17.000 perusahaan dan jutaan pembelajar di seluruh dunia
        </p>

        <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-8 max-w-7xl mx-auto">
            
            <div class="flex items-center justify-center">
                <img src="{{ asset('vw.png') }}" class="h-20 w-auto grayscale opacity-70" alt="VW">
            </div>

            <div class="flex items-center justify-center">
                <img src="{{ asset('samsung.png') }}" class="h-20 w-auto grayscale opacity-70" alt="Samsung">
            </div>

            <div class="flex items-center justify-center">
                <img src="{{ asset('cisco.png') }}" class="h-14 w-auto grayscale opacity-70" alt="Cisco">
            </div>

            <div class="flex items-center justify-center">
                <img src="{{ asset('vimeo.png') }}" class="h-10 w-auto grayscale opacity-70" alt="Vimeo">
            </div>

            <div class="flex items-center justify-center">
                <img src="{{ asset('pg.png') }}" class="h-20 w-auto grayscale opacity-70" alt="P&G">
            </div>

            <div class="flex items-center justify-center">
                <img src="{{ asset('hpe.png') }}" class="h-14 w-auto grayscale opacity-70" alt="HPE">
            </div>

            <div class="flex items-center justify-center">
                <img src="{{ asset('citi.png') }}" class="h-14 w-auto grayscale opacity-70" alt="Citi">
            </div>

            <div class="flex items-center justify-center">
                <img src="{{ asset('ericsson.png') }}" class="h-14 w-auto grayscale opacity-70" alt="Ericsson">
            </div>

        </div>
    </div>
</section>

<div id="sticky-header" class="fixed top-0 left-0 w-full bg-white border-b border-gray-200 shadow-md z-[9999] transform -translate-y-full transition-transform duration-300">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <h1 class="text-2xl font-bold text-black">idemy</h1>
            <span class="text-gray-800 font-bold text-sm hidden md:block">Paket Personal</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-600 hidden md:block font-medium">Mulai Rp116.000 per bulan. Batalkan kapan saja.</span>
            <a href="{{ route('register') }}" 
                class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2.5 px-4 text-sm rounded transition block text-center">
                Mulai langganan
            </a>
        </div>
    </div>
</div>

<section class="max-w-7xl mx-auto px-10 py-24 mt-10">
    <div class="flex flex-col md:flex-row items-center justify-between gap-16">
        
        <div class="md:w-1/2">
            <img src="{{ asset('iklan_langganan.jpeg') }}" alt="Skill Modern" class="w-full object-cover rounded-sm">
        </div>

        <div class="md:w-1/2">
            <p class="text-gray-900 font-bold text-sm mb-4">Saat ini</p>
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6">
                Skill modern untuk<br>mengasah ketajaman Anda
            </h2>
            <p class="text-gray-700 text-lg leading-relaxed max-w-lg">
                Belajar dengan percaya diri dengan kursus terkini yang membahas topik paling diminati seperti AI untuk peran apa pun, sertifikasi komputasi cloud, pengembangan web, produktivitas, kepemimpinan, desain, pemasaran digital, dan lainnya.
            </p>
        </div>

    </div>
</section>

<section class="max-w-7xl mx-auto px-10 py-16 md:py-24">
    <div class="flex flex-col md:flex-row items-center justify-between gap-16">
        
        <div class="md:w-1/2">
            <p class="text-gray-900 font-bold text-sm mb-4">Fleksibel</p>
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6">
                Kebebasan untuk<br>bereksplorasi dan<br>mencari tahu
            </h2>
            <p class="text-gray-700 text-lg leading-relaxed">
                Uji coba subjek baru, beralih antar kursus, atau sortir dan pilih pelajaran yang paling sesuai dengan kebutuhan Anda. Paket Personal memberi Anda kekuatan untuk mengontrol apa yang Anda pelajari dan cara Anda belajar. Selain itu, gunakan Idemy AI Assistant untuk mendapatkan jawaban instan atas pertanyaan Anda selagi belajar.
            </p>
            </div>

        <div class="md:w-1/2">
            <img src="{{ asset('iklan2_langganan.jpeg') }}" alt="Kebebasan Bereksplorasi" class="w-full object-contain rounded-md border border-gray-100 shadow-sm">
        </div>

    </div>
</section>

<section class="max-w-7xl mx-auto px-10 py-16 md:py-24">
    <div class="flex flex-col md:flex-row items-center justify-between gap-16">
        
        <div class="md:w-1/2">
            <img src="{{ asset('iklan3_langganan.jpeg') }}" alt="Pembelajaran Efektif" class="w-full object-contain rounded-md">
        </div>

        <div class="md:w-1/2">
            <p class="text-gray-900 font-bold text-sm mb-4">Efektif</p>
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6">
                Pembelajaran yang<br>didesain untuk<br>membantu Anda<br>mulai melakukan
            </h2>
            <p class="text-gray-700 text-lg leading-relaxed">
                Dapatkan pengetahuan melalui praktik dengan simulasi Role Play AI, lab, latihan coding, dan simulasi tes ujian sertifikasi. Setelah Anda menyelesaikan kursus, tunjukkan skill baru Anda dengan sertifikat penyelesaian dari Idemy atau penerbit seperti AWS, Microsoft, Google, CompTIA, dan PMI.
            </p>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-10 pt-16 pb-8">
    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
        Intip koleksi
    </h2>
    <p class="text-gray-700 text-lg leading-relaxed max-w-4xl">
        Dengan ribuan kursus berperingkat terbaik dari instruktur teratas di Idemy, Paket Personal adalah langganan yang akan membawa Anda ke kesuksesan. Jelajahi beberapa konten yang tercakup di bawah.
    </p>
</section>


<section class="bg-indigo-50/40 py-12 px-4 mt-10">
    <h2 class="text-2xl lg:text-3xl font-bold text-center text-gray-900 mb-8">
        Pilih paket yang sesuai untuk Anda
    </h2>

    <div class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-5">
        
        <div class="border-2 border-purple-600 rounded-lg bg-white flex flex-col shadow-lg relative mt-4 md:mt-0">
            <div class="bg-purple-600 text-white text-center py-1 font-bold flex justify-center items-center gap-1.5 text-xs absolute w-full top-0 left-0 rounded-t-md">
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Harga terbaik
            </div>
            
            <div class="p-5 pt-10 flex flex-col flex-grow text-center">
                <h3 class="text-lg font-bold text-gray-900 mb-1">Paket Personal</h3>
                <p class="text-xs text-purple-700 mb-2">Sederhanakan sasaran karier Anda</p>
                <p class="text-gray-800 text-sm font-semibold mb-1">Mulai Rp116.000 per bulan.</p>
                <p class="text-[11px] text-gray-500 mb-5">Ditagih setiap bulan atau setiap tahun. Batalkan kapan saja.</p>

                <ul class="text-left space-y-2.5 mb-5 flex-grow">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-purple-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-xs text-gray-600 leading-tight">Lebih dari 28.000 kursus pengembangan profesional</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-purple-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-xs text-gray-600 leading-tight">Peringkat rata-rata 4.5/5</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-purple-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-xs text-gray-600 leading-tight">Lebih dari 20.000+ latihan praktik</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-purple-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-xs text-gray-600 leading-tight">Lebih dari 9.000 instruktur teratas</span>
                    </li>
                </ul>

                <a href="{{ route('register') }}" 
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 text-sm rounded transition mt-auto block text-center">
                        Mulai langganan
                </a>
            </div>
        </div>

        <div class="border border-gray-200 rounded-lg bg-white flex flex-col shadow-sm p-5 mt-6 md:mt-0">
            <div class="text-center mb-5">
                <h3 class="text-lg font-bold text-gray-900 mb-1">Beli kursus individual</h3>
                <p class="text-xs text-purple-700 mb-2">Pelajari topik apa pun</p>
                <p class="text-gray-800 text-sm font-semibold mb-1">Rp149.000-Rp1.799.000</p>
                <p class="text-[11px] text-gray-500 mb-5">Beli satu kali</p>
            </div>

            <ul class="text-left space-y-2.5 mb-5 flex-grow">
                <li class="flex items-start gap-2">
                    <svg class="w-4 h-4 text-purple-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="text-xs text-gray-600 leading-tight">Lebih dari 250.000 kursus pengembangan profesional</span>
                </li>
                <li class="flex items-start gap-2">
                    <svg class="w-4 h-4 text-purple-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="text-xs text-gray-600 leading-tight">Bayar sesuai penggunaan</span>
                </li>
            </ul>
        </div>

    </div>
</section>

<<section class="max-w-4xl mx-auto px-6 py-20 mt-10">
    <div class="md:ml-32">
        <h2 class="text-3xl font-bold text-gray-900 mb-10">
            Pertanyaan yang sering diajukan
        </h2>

        <div class="flex flex-col"> 
            @foreach($faqs as $faq)
                <div class="border-t border-gray-300 w-full" x-data="{ isOpen: false }">
                    <button 
                        @click="isOpen = !isOpen"
                        type="button"
                        class="w-full flex justify-between items-center text-left py-5 focus:outline-none group">
                        <span class="text-lg font-semibold text-gray-800 group-hover:text-purple-700 transition-colors pr-8">
                            {{ $faq->question }}
                        </span>
                        <svg 
                            class="w-6 h-6 text-gray-900 transform transition-transform duration-300 flex-shrink-0" 
                            :class="isOpen ? 'rotate-180' : ''" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div 
                        x-show="isOpen" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-cloak
                        class="pb-8 text-gray-700 leading-relaxed text-base">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
            <div class="border-t border-gray-300"></div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stickyHeader = document.getElementById('sticky-header');
        
        window.addEventListener('scroll', function() {
            // Jika halaman di-scroll lebih dari 400 pixel ke bawah, munculkan menu
            if (window.scrollY > 400) {
                stickyHeader.classList.remove('-translate-y-full');
            } else {
                // Jika kembali ke atas, sembunyikan lagi menunya
                stickyHeader.classList.add('-translate-y-full');
            }
        });
    });
</script>

@endsection