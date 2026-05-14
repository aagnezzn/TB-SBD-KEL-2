@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 mt-10">
    
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>

    @if($cartItems->isEmpty())
        <p class="text-gray-700 mb-16">
            <span class="font-bold italic">Keranjang Anda kosong</span> – mari ubah itu. Saatnya mempelajari beberapa skill baru.
        </p>
    @else
        <div class="flex flex-col lg:flex-row gap-12">
            <div class="lg:w-2/3 flex flex-col space-y-6">
                <p class="font-bold border-b pb-2">{{ $cartItems->count() }} Kursus dalam Keranjang</p>
                @foreach($cartItems as $item)
                <div class="flex gap-6 border-b border-gray-100 pb-8 mb-6 last:mb-0">
                    <a href="{{ route('course.show', $item->course->id) }}" class="shrink-0">
                        {{-- FIX: Menggunakan data image_url dari DB + Pengaman Onerror --}}
                        <img src="{{ $item->course->image_url }}" 
                             alt="{{ $item->course->title }}"
                             class="w-32 h-20 object-cover rounded-md shadow-sm"
                             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=300&q=80';">
                    </a>

                    <div class="flex-grow">
                        <a href="{{ route('course.show', $item->course->id) }}" class="group">
                            <h3 class="font-bold text-gray-900 group-hover:text-purple-700 transition leading-tight">
                                {{ $item->course->title }}
                            </h3>
                        </a>
                        <p class="text-xs text-gray-500 mt-1">Oleh {{ $item->course->user->name }}</p>
                        
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm font-bold text-purple-700 hover:text-purple-900 transition">
                                Hapus
                            </button>
                        </form>
                    </div>

                    <div class="text-right shrink-0">
                        <p class="font-bold text-gray-900 text-lg italic">Rp{{ number_format($item->course->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="lg:w-1/3">
                <div class="p-6 border rounded-lg bg-gray-50">
                    <p class="text-gray-600 font-bold mb-1">Total:</p>
                    <p class="text-3xl font-bold text-gray-900 mb-6">Rp{{ number_format($cartItems->sum(fn($i) => $i->course->price), 0, ',', '.') }}</p>
                    <a href="{{ route('checkout') }}" class="w-full bg-[#a435f0] text-white py-3 font-bold rounded block text-center">
                        Lanjutkan ke Checkout
                    </a>
                </div>
            </div>
        </div>
    @endif

    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Pembelajar melihat</h2>

        <div class="relative group">
            <button onclick="slideLeft()" class="absolute -left-5 top-1/2 -translate-y-1/2 bg-white border shadow-lg rounded-full p-3 z-10 hidden group-hover:block hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>

            <div id="courseSlider" class="flex overflow-x-auto overflow-visible gap-4 pb-8 scroll-smooth no-scrollbar snap-x relative">
                @foreach($courses as $course)
                    @include('partials.course-card', ['course' => $course])
                @endforeach
            </div>

            <button onclick="slideRight()" class="absolute -right-5 top-1/2 -translate-y-1/2 bg-white border shadow-lg rounded-full p-3 z-10 hidden group-hover:block hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>

    <h2 class="text-lg font-bold text-gray-900 mt-30 mb-4">Topik Populer</h2>
    
    <div class="flex overflow-x-auto gap-4 pb-4">
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">AI Generatif</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">Sertifikasi TI</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">Ilmu Data</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">ChatGPT</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">Rekayasa Prompt</button>
    </div>

</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
    const slider = document.getElementById('courseSlider');
    let isMoving = false;

    function slideLeft() {
        if (isMoving) return;
        const cardWidth = 276; 
        
        if (slider.scrollLeft <= 0) {
            slider.style.scrollBehavior = 'auto';
            slider.scrollLeft = slider.scrollWidth / 2;
            slider.style.scrollBehavior = 'smooth';
        }
        
        slider.scrollLeft -= cardWidth * 3; 
    }

    function slideRight() {
        if (isMoving) return;
        const cardWidth = 276;
        const maxScroll = slider.scrollWidth - slider.clientWidth;

        if (slider.scrollLeft >= maxScroll - 10) {
            slider.style.scrollBehavior = 'auto';
            slider.scrollLeft = 0;
            slider.style.scrollBehavior = 'smooth';
        }

        slider.scrollLeft += cardWidth * 3;
    }

    slider.addEventListener('scroll', () => {
        isMoving = true;
        clearTimeout(window.scrollTimeout);
        window.scrollTimeout = setTimeout(() => isMoving = false, 100);
    });
</script>
@endsection