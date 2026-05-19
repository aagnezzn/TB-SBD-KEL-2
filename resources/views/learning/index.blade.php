@extends('layouts.app')

@section('content')

<div class="bg-[#2d2f31] pt-12 pb-0 mb-10">
    <div class="max-w-7xl mx-auto px-4">
        
        {{-- NOTIFIKASI BERHASIL AUTO-HIDE --}}
        @if(session('success'))
            <div id="success-notification" class="mb-8 animate-fade-in-down">
                <div class="flex items-center justify-between bg-[#acd2cc] border border-[#1e4b44] p-4 shadow-lg">
                    <div class="flex items-center gap-4 text-[#1c1d1f]">
                        <div class="bg-[#1c1d1f] text-white rounded-full w-8 h-8 flex items-center justify-center shrink-0">
                            <i class="fas fa-check text-xs"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm leading-none">{{ __('detailcourse.berhasil') }}</p>
                            <p class="text-sm mt-1 opacity-90">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('success-notification').remove()" class="text-gray-700 hover:text-black transition p-2">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>
        @endif

        <h1 class="text-4xl font-bold text-white mb-10">{{ __('detailcourse.my_learning') }}</h1>
        
        <nav class="flex space-x-8">
            <a href="{{ route('learning.index', ['tab' => 'all']) }}" 
               class="{{ !request('tab') || request('tab') == 'all' ? 'border-white text-white' : 'border-transparent text-gray-400 hover:text-white' }} py-3 px-1 border-b-4 font-bold text-sm transition">
                {{ __('detailcourse.all_courses') }}
            </a>
            <a href="{{ route('learning.index', ['tab' => 'wishlist']) }}" 
               class="{{ request('tab') == 'wishlist' ? 'border-white text-white' : 'border-transparent text-gray-400 hover:text-white' }} py-3 px-1 border-b-4 font-bold text-sm transition">
                {{ __('detailcourse.wishlist') }}
            </a>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 pb-20">
    @if($courses && $courses->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @foreach($courses as $course)
                <div class="bg-white border border-gray-200 rounded-sm overflow-hidden flex flex-col h-full group relative hover:shadow-md transition">
                    
                    {{-- Aksi Singkirkan Item dari Daftar Wishlist --}}
                    @if(request('tab') == 'wishlist')
                        <form action="{{ route('wishlist.remove', $course->id) }}" method="POST" class="absolute top-2 right-2 z-10 opacity-0 group-hover:opacity-100 transition">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-white p-2 rounded-full shadow-md text-gray-600 hover:text-red-600 cursor-pointer">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </form>
                    @endif

                    {{-- FAKTA PERBAIKAN: Seluruh elemen visual kartu dibungkus rute agar fungsional bisa diklik --}}
                    <a href="{{ route('course.show', $course->id) }}" class="block flex flex-col flex-1">
                        <div class="aspect-video w-full bg-gray-100 overflow-hidden">
                            <img src="{{ $course->image_url ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80' }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                 onerror="this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80';">
                        </div>
                        
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="font-bold text-gray-900 text-sm mb-1 h-10 overflow-hidden line-clamp-2 hover:text-purple-700 transition">
                                {{ $course->title }}
                            </h3>
                            <p class="text-[11px] text-gray-500 mb-4">{{ __('detailcourse.dibuat') }} {{ $course->user->name ?? 'Instructor' }}</p>
                    </a> {{-- Penutup Bungkus Anchor Atas --}}
                        
                        <div class="mt-auto pt-2">
                            @if(request('tab') == 'wishlist')
                                <div class="flex flex-col w-full">
                                    <span class="font-black text-gray-900 text-base">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                                    <form action="{{ route('wishlist.move-to-cart', $course->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button class="w-full mt-3 bg-purple-600 py-2.5 text-white text-xs font-bold hover:bg-purple-800 transition cursor-pointer">
                                            {{ __('detailcourse.add_cart') }}
                                        </button>
                                    </form>
                                </div>
                            @else
                                {{-- Progress Pembelajaran Siswa --}}
                                <div class="w-full bg-gray-200 h-1 mb-2 rounded-full">
                                    <div class="bg-purple-600 h-1 rounded-full" style="width: 25%"></div>
                                </div>
                                <span class="text-[10px] text-gray-600 font-bold uppercase tracking-tight">{{ __('detailcourse.25%') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-24 border border-dashed border-gray-200 rounded-lg">
            <p class="text-gray-500 text-lg mb-6">{{ __('detailcourse.learning_kosong') }}</p>
            <a href="/" class="bg-[#a435f0] text-white px-8 py-3 font-bold hover:bg-[#8710d8] transition shadow-md">
                {{ __('detailcourse.cari') }}
            </a>
        </div>
    @endif
</div>

<style>
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down { animation: fade-in-down 0.5s ease-out; }
</style>

<script>
    setTimeout(function() {
        let notif = document.getElementById('success-notification');
        if (notif) {
            notif.style.transition = "opacity 0.5s ease";
            notif.style.opacity = "0";
            setTimeout(() => notif.remove(), 500);
        }
    }, 5000);
</script>
@endsection