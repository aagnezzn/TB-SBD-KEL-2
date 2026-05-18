@extends('layouts.app')

@section('content')
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="max-w-7xl mx-auto px-6 py-12 mt-10 text-[#1c1d1f] font-sans">
    
    <h1 class="text-3xl font-black tracking-tight text-gray-900 mb-8">Keranjang Belanja</h1>

    @if($cartItems->isEmpty())
        {{-- Tampilan State Jika Keranjang Belanja Kosong --}}
        <div class="text-center py-16 border border-dashed rounded-2xl bg-white p-8 max-w-2xl mx-auto shadow-sm">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Keranjang Anda kosong</h2>
            <p class="text-gray-500 text-sm max-w-md mx-auto mb-6">Mari ubah itu. Saatnya mempelajari beberapa skill baru untuk membangun masa depan dan karir dunia kerja Anda.</p>
            <a href="/" class="inline-block bg-[#a435f0] text-white px-8 py-3.5 font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-[#8710d8] transition-all shadow-md active:scale-95 no-underline">
                Jelajahi Kursus Sekarang
            </a>
        </div>
    @else
        {{-- Layout Utama Keranjang Belanja --}}
        <div class="flex flex-col lg:flex-row gap-10 items-start">
            
            {{-- SISI KIRI: Daftar Item yang Berhasil Dimasukkan ke Keranjang --}}
            <div class="w-full lg:w-2/3 flex flex-col">
                <p class="font-bold text-sm text-gray-700 border-b border-gray-200 pb-3 mb-6">
                    {{ $cartItems->count() }} Kursus dalam Keranjang
                </p>
                
                <div class="flex flex-col space-y-6">
                    @foreach($cartItems as $item)
                    <div class="flex flex-col sm:flex-row gap-6 border-b border-gray-200 pb-6 last:border-0 last:pb-0">
                        {{-- Thumbnail Gambar Kursus --}}
                        <a href="{{ route('course.show', $item->course->id) }}" class="shrink-0 block w-full sm:w-32 h-20 overflow-hidden rounded-md border border-gray-200 shadow-sm relative group">
                            <img src="{{ $item->course->image_url ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=300&q=80' }}" 
                                 alt="{{ $item->course->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200"
                                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=300&q=80';">
                        </a>

                        {{-- Metadata Detail Informasi Kursus --}}
                        <div class="flex-1 min-w-0 flex flex-col justify-between">
                            <div class="min-w-0">
                                <a href="{{ route('course.show', $item->course->id) }}" class="no-underline block group">
                                    <h3 class="font-bold text-gray-900 text-[15px] leading-tight mb-1 line-clamp-2 group-hover:text-[#5624d0] transition-colors">
                                        {{ $item->course->title }}
                                    </h3>
                                </a>
                                <p class="text-xs text-gray-500 m-0">Oleh {{ $item->course->user->name ?? 'Instruktur Idemy' }}</p>
                            </div>
                            
                            {{-- Tombol Aksi Hapus Item dari Sesi Database --}}
                            <div class="mt-3">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-800 transition-colors bg-transparent border-none p-0 cursor-pointer">
                                        Hapus dari Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Harga Kursus Per Item --}}
                        <div class="text-right shrink-0 mt-2 sm:mt-0">
                            <p class="font-black text-gray-900 text-base m-0">
                                Rp{{ number_format($item->course->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- SISI KANAN: Kotak Invoice Ringkasan Pembayaran Total --}}
            <div class="w-full lg:w-1/3 lg:sticky lg:top-24">
                <div class="p-6 border border-gray-200 rounded-xl bg-gray-50 shadow-sm">
                    <p class="text-gray-500 font-bold text-xs uppercase tracking-wider mb-1">Total Biaya:</p>
                    <p class="text-3xl font-black text-gray-900 mb-6">
                        Rp{{ number_format($cartItems->sum(fn($i) => $i->course->price), 0, ',', '.') }}
                    </p>
                    <a href="{{ route('checkout') }}" class="w-full bg-[#a435f0] text-white py-3.5 font-bold rounded-lg block text-center no-underline hover:bg-[#8710d8] transition-all shadow-md active:scale-95 text-sm tracking-wide">
                        Lanjutkan ke Checkout
                    </a>
                </div>
            </div>
            
        </div>
    @endif

    {{-- 3. SLIDER SEKSI: PEMBELAJAR MELIHAT (REKOMENDASI KURSUS LAIN) --}}
    <div class="mt-20 border-t border-gray-200 pt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Siswa juga melihat kursus ini</h2>

        <div class="relative group">
            {{-- Tombol Geser Kiri Slider --}}
            <button onclick="slideLeft()" class="absolute -left-5 top-1/2 -translate-y-1/2 bg-white border border-gray-200 shadow-xl rounded-full p-3 z-30 hidden group-hover:block hover:bg-gray-100 hover:scale-105 transition-all cursor-pointer">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            {{-- Wadah Jalur Grid Slider (FIX: Membatasi minimal width kartu agar tidak ringsek gepeng) --}}
            <div id="courseSlider" class="flex overflow-x-auto overflow-y-visible gap-6 pb-6 scroll-smooth no-scrollbar snap-x relative items-stretch">
                @foreach($courses as $course)
                    {{-- BUNGKUSAN PROTEKSI: Mengunci lebar minimal kartu di level flex agar layout tidak terkompres --}}
                    <div class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px] flex snap-start">
                        @include('partials.course-card', ['course' => $course])
                    </div>
                @endforeach
            </div>

            {{-- Tombol Geser Kanan Slider --}}
            <button onclick="slideRight()" class="absolute -right-5 top-1/2 -translate-y-1/2 bg-white border border-gray-200 shadow-xl rounded-full p-3 z-30 hidden group-hover:block hover:bg-gray-100 hover:scale-105 transition-all cursor-pointer">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

</div>

<script>
    const slider = document.getElementById('courseSlider');
    let isMoving = false;

    // Perhitungan dinamis jarak geser berdasarkan lebar container item
    function getSlideWidth() {
        if (!slider || !slider.firstElementChild) return 280;
        return slider.firstElementChild.getBoundingClientRect().width + 24; 
    }

    function slideLeft() {
        if (isMoving || !slider) return;
        slider.scrollLeft -= getSlideWidth() * 2; 
    }

    function slideRight() {
        if (isMoving || !slider) return;
        slider.scrollLeft += getSlideWidth() * 2;
    }

    if (slider) {
        slider.addEventListener('scroll', () => {
            isMoving = true;
            clearTimeout(window.scrollTimeout);
            window.scrollTimeout = setTimeout(() => isMoving = false, 50);
        });
    }
</script>
@endsection