<nav class="bg-white border-b border-gray-200 px-6 py-2 flex items-center h-16 w-full relative">
    <div class="flex items-center space-x-4 flex-shrink-0">
        <h1 class="text-2xl font-bold text-black cursor-pointer">idemy</h1>

        <!-- Menu Jelajahi -->
<div class="group inline-block" style="position: static;">
    <button class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-[#5624d0] flex items-center gap-1">
        {{ __('menu.explore') }}
    </button>

    <div class="absolute hidden group-hover:flex left-6 top-[64px] z-[9999] pt-2">
        
        <div class="w-[280px] min-h-[650px] h-fit py-2 border border-gray-200 bg-white shadow-xl flex-shrink-0 relative">
            @foreach($navCategories as $mainCat)
            <div class="group/level2 px-4 py-[10px] hover:bg-gray-50 flex justify-between items-center cursor-pointer">
                <span class="text-[14px] text-gray-700 hover:text-[#5624d0] capitalize font-medium">{{ $mainCat->name }}</span>
                <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>
                
                <div class="absolute hidden group-hover/level2:flex left-[279px] top-[-9px] border border-gray-200 h-full w-[280px] flex-col py-2 z-20 bg-white shadow-xl">
                    @foreach($mainCat->children as $subCat)
                    <div class="group/level3 px-4 py-[10px] hover:bg-gray-50 flex justify-between items-center cursor-pointer">
                        <span class="text-[14px] text-gray-700 hover:text-[#5624d0] capitalize font-normal">{{ $subCat->name }}</span>
                        <i data-feather="chevron-right" class="w-4 h-4 text-gray-400"></i>

                        <div class="absolute hidden group-hover/level3:block left-[279px] top-[-1px] border border-gray-200 h-full w-[300px] p-6 z-30 bg-white shadow-2xl overflow-y-auto">
                            <h4 class="font-bold text-gray-400 mb-4 text-[11px] uppercase tracking-wider font-normal">Topik populer</h4>
                            <div class="flex flex-col space-y-3">
                                @foreach($subCat->children as $topic)
                                   <a class="text-sm text-gray-600 hover:text-[#5624d0] capitalize font-normal no-underline" href="{{ route('category.show', $topic->slug) }}">
                                    {{ $topic->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
        <a href="{{ url('/berlangganan') }}" class="text-sm hover:text-purple-600 whitespace-nowrap">{{ __('menu.subscribe') }}</a>
    </div>

    <!-- Form Cari -->
    <div class="flex-grow mx-6">
        <form action="{{ route('search') }}" method="GET" class="relative w-full">
            <span class="absolute inset-y-0 left-4 flex items-center">
                <i data-feather="search" class="w-4 h-4 text-gray-400"></i>
            </span>
            <input type="text" name="query" value="{{ request('query') }}" placeholder="{{ __('menu.search_placeholder') }}"
                class="w-full border border-gray-300 rounded-full pl-12 pr-4 py-2 text-sm bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500 transition-all">
            <button type="submit" class="hidden"></button>
        </form>
    </div>

    <div class="flex items-center space-x-3 flex-shrink-0">
        <!-- Mengajar -->
        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <a href="{{ route('mengajar') }}" class="text-sm text-gray-800 hover:text-purple-700 hidden lg:block px-2 py-4">
                {{ __('menu.teach_on_idemy') }}
            </a>
            <div x-show="open" x-transition x-cloak class="absolute right-0 top-full w-72 bg-white border border-gray-200 shadow-lg p-4 z-[1000] rounded-sm text-center flex flex-col gap-3">
                <p class="text-gray-800 font-bold text-base leading-snug">{{ __('menu.teach_desc') }}</p>
                <a href="{{ route('mengajar') }}" class="w-full bg-purple-700 text-white font-bold py-3 text-sm hover:bg-purple-800 transition-colors">{{ __('menu.learn_more') }}</a>
            </div>
        </div>
        
       <!-- Keranjang Dinamis -->
<div class="relative group py-4">
    <a href="{{ route('keranjang') }}" class="text-gray-700 hover:text-purple-700 transition flex items-center h-full relative">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        {{-- BADGE ANGKA --}}
        @if($cartCount > 0)
            <span class="absolute -top-1 -right-2 bg-[#a435f0] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border border-white">
                {{ $cartCount }}
            </span>
        @endif
    </a>

    <!-- Dropdown Keranjang Dinamis -->
    <div class="absolute right-0 top-16 w-[320px] bg-white border border-gray-200 shadow-xl hidden group-hover:block z-50 p-4">
        @if($cartItems->isEmpty())
            <div class="text-center py-6">
                <p class="text-gray-600 text-sm mb-4">{{ __('menu.cart_empty') }}</p>
                <a href="/" class="text-[#a435f0] font-bold text-sm hover:underline">{{ __('menu.keep_shopping') }}</a>
            </div>
        @else
            <div class="max-h-[300px] overflow-y-auto mb-4 text-left">
                @foreach($cartItems as $item)
                <div class="flex gap-3 border-b border-gray-100 pb-3 mb-3">
                    <img src="https://loremflickr.com/60/60/tech?random={{ $item->course->id }}" class="w-14 h-14 object-cover">
                    <div class="flex-grow min-w-0">
                        <h4 class="text-[12px] font-bold text-gray-900 line-clamp-2 leading-tight">{{ $item->course->title }}</h4>
                        <p class="text-[10px] text-gray-500 truncate">{{ $item->course->user->name ?? 'Instruktur' }}</p>
                        <p class="text-sm font-bold text-gray-900 mt-1">Rp{{ number_format($item->course->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="border-t pt-4">
                <div class="flex justify-between mb-4">
                    <span class="font-bold text-base text-gray-900">Total:</span>
                    <span class="font-bold text-base text-gray-900">Rp{{ number_format($cartItems->sum(fn($i) => $i->course->price), 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('keranjang') }}" class="block w-full bg-[#1c1d1f] text-white text-center py-3 font-bold hover:bg-gray-800 transition text-sm">
                    {{ __('Buka keranjang') }}
                </a>
            </div>
        @endif
    </div>
</div>

        <!-- Auth / Login Section -->
        <div class="flex items-center space-x-4 z-50">
            @guest
                <a href="/login" class="border border-purple-700 text-purple-700 px-5 py-2 font-bold text-sm rounded-lg hover:bg-purple-50 transition-all duration-200 text-center inline-block">{{ __('menu.login') }}</a>
                <a href="/register" class="bg-purple-700 text-white px-5 py-2 font-bold text-sm rounded-lg border border-purple-700 hover:bg-purple-800 transition-all duration-200">{{ __('menu.register') }}</a>
            @endguest

            @auth
    <div class="relative group cursor-pointer py-4">
        {{-- Inisial Nama dengan Titik Ungu --}}
        <div class="w-11 h-11 bg-black text-white rounded-full flex items-center justify-center font-bold text-lg relative">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            @if($cartCount > 0)
                <span class="absolute top-0 right-0 w-3.5 h-3.5 bg-[#a435f0] rounded-full border-2 border-white"></span>
            @endif
        </div>

        {{-- DROPDOWN PROFIL LENGKAP --}}
        <div class="absolute right-0 top-16 w-[280px] bg-white border border-gray-200 shadow-xl hidden group-hover:block text-[14px] cursor-default z-50">
            {{-- Header: Info User --}}
            <div class="p-4 border-b flex items-center gap-3">
                <div class="w-12 h-12 bg-black text-white rounded-full flex items-center justify-center font-bold text-xl shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <div class="font-bold text-gray-900 truncate">{{ Auth::user()->name }}</div>
                    <div class="text-gray-500 text-xs truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>

            {{-- Menu Bagian 1 --}}
            <div class="py-2 border-b">
                <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700">Pembelajaran saya</a>
                <a href="{{ route('keranjang') }}" class="flex justify-between items-center px-4 py-2 text-gray-700 hover:text-purple-700">
                    <span>Keranjang saya</span>
                    @if($cartCount > 0)
                        <span class="bg-[#a435f0] text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $cartCount }}</span>
                    @endif
                </a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700">Daftar Keinginan</a>
                <a href="{{ route('mengajar') }}" class="block px-4 py-2 text-gray-700 hover:text-purple-700">Mengajar di Idemy</a>
            </div>

            {{-- Menu Bagian 2 --}}
            <div class="py-2 border-b">
                <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700">Pemberitahuan</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700">Pesan</a>
            </div>

            {{-- Menu Bagian 3 --}}
            <div class="py-2 border-b">
                <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700">Pengaturan akun</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700">Metode pembayaran</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700">Langganan</a>
            </div>

            {{-- Logout --}}
            <div class="py-2">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:text-purple-700 transition cursor-pointer">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endauth
        </div>
    </div>
</nav>