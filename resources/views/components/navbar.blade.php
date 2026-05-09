<nav class="bg-white border-b border-gray-200 px-6 py-2 flex items-center h-16 w-full relative">
    <div class="flex items-center space-x-4 flex-shrink-0">
        <h1 class="text-2xl font-bold text-black cursor-pointer">idemy</h1>

        <div class="group relative inline-block">
            <button class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-[#5624d0] flex items-center gap-1 transition-all duration-200">
                {{ __('menu.explore') }}
            </button>

            <div class="absolute hidden group-hover:block top-full left-0 z-[9999]">
                <div class="relative">
                    <div class="w-[250px] h-[650px] overflow-y-auto bg-white border border-gray-200 shadow-2xl py-2">
                        @foreach($navCategories as $mainCat)
                        <div class="group/level2">
                            <div class="flex items-center justify-between px-5 py-3 hover:bg-[#f7f9fa] cursor-pointer transition-all duration-150">
                                <span class="text-[15px] text-gray-800 group-hover/level2:text-[#5624d0] font-medium capitalize">
                                    {{ $mainCat->name }}
                                </span>
                                <i data-feather="chevron-right" class="w-4 h-4 text-gray-400 group-hover/level2:text-[#5624d0]"></i>
                            </div>

                            <div class="absolute hidden group-hover/level2:block left-[250px] top-0">
                                <div class="w-[360px] h-[650px] overflow-y-auto bg-white border border-gray-200 shadow-2xl py-2">
                                    @foreach($mainCat->children as $subCat)
                                    <div class="group/level3">
                                        <div class="flex items-center justify-between px-5 py-3 hover:bg-[#f7f9fa] cursor-pointer transition-all duration-150">
                                            <span class="text-[15px] text-gray-700 group-hover/level3:text-[#5624d0]">
                                                {{ $subCat->name }}
                                            </span>
                                            <i data-feather="chevron-right" class="w-4 h-4 text-gray-400 group-hover/level3:text-[#5624d0]"></i>
                                        </div>

                                        <div class="absolute hidden group-hover/level3:block left-[360px] top-0">
                                            <div class="w-[340px] h-[650px] overflow-y-auto bg-white border border-gray-200 shadow-2xl px-7 py-6">
                                                <h4 class="text-[12px] font-bold tracking-widest text-gray-500 uppercase mb-5">
                                                    Topik Populer
                                                </h4>
                                                <div class="flex flex-col gap-4">
                                                    @foreach($subCat->children as $topic)
                                                    <a href="{{ route('category.show', $topic->slug) }}" class="text-[15px] text-gray-700 hover:text-[#5624d0] transition-all duration-150 no-underline">
                                                        {{ $topic->name }}
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ url('/berlangganan') }}" class="text-sm hover:text-purple-600 whitespace-nowrap">{{ __('menu.subscribe') }}</a>
    </div>

    <div class="flex-grow mx-6 flex items-center"> 
        <form action="{{ route('search') }}" method="GET" class="relative w-full mb-0"> 
            <span class="absolute inset-y-0 left-4 flex items-center">
                <i data-feather="search" class="w-4 h-4 text-gray-400"></i>
            </span>
            <input type="text" name="query" value="{{ request('query') }}" placeholder="{{ __('menu.search_placeholder') }}" class="w-full border border-gray-300 rounded-full pl-12 pr-4 py-2 text-sm bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500 transition-all">
            <button type="submit" class="hidden"></button>
        </form>
    </div>

    <div class="flex items-center space-x-4 flex-shrink-0 pr-6">
        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <a href="{{ route('mengajar') }}" class="text-sm text-gray-800 hover:text-purple-700 hidden lg:block px-2 py-4">
                {{ __('menu.teach_on_idemy') }}
            </a>
            <div x-show="open" x-transition x-cloak class="absolute right-0 top-full w-72 bg-white border border-gray-200 shadow-lg p-4 z-[1000] rounded-sm text-center flex flex-col gap-3">
                <p class="text-gray-800 font-bold text-base leading-snug">{{ __('menu.teach_desc') }}</p>
                <a href="{{ route('mengajar') }}" class="w-full bg-purple-700 text-white font-bold py-3 text-sm hover:bg-purple-800 transition-colors">{{ __('menu.learn_more') }}</a>
            </div>
        </div>
        
        <div class="relative group py-4">
            <a href="{{ route('keranjang') }}" class="text-gray-700 hover:text-purple-700 transition flex items-center h-full relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                @if($cartCount > 0)
                    <span class="absolute -top-1 -right-2 bg-[#a435f0] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border border-white">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            <div class="absolute right-0 top-full pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[200]">
                <div class="w-[350px] bg-white border border-gray-100 shadow-[0_10px_30px_rgb(0,0,0,0.1)] rounded-xl overflow-hidden">
                    <div class="p-5 max-h-[400px] overflow-y-auto custom-scrollbar">
                        @forelse($cartItems as $item)
                            <div class="flex gap-4 mb-5 last:mb-0 group/item relative">
                                <a href="{{ route('course.show', $item->course->id) }}" class="shrink-0">
                                    <img src="https://loremflickr.com/120/80/tech?random={{ $item->course->id }}" class="w-20 h-14 object-cover rounded-md shadow-sm group-hover/item:opacity-80 transition">
                                </a>
                                <div class="flex flex-col flex-grow">
                                    <a href="{{ route('course.show', $item->course->id) }}">
                                        <h4 class="text-[14px] font-bold text-gray-900 leading-snug hover:text-purple-700 transition line-clamp-2">
                                            {{ $item->course->title }}
                                        </h4>
                                    </a>
                                    <p class="text-[11px] text-gray-500 mt-1">Oleh {{ $item->course->user->name }}</p>
                                    <p class="text-[14px] font-extrabold text-gray-900 mt-1">Rp{{ number_format($item->course->price, 0, ',', '.') }}</p>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[11px] font-bold text-purple-700 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="py-10 text-center">
                                <p class="text-gray-500 text-sm font-medium">Keranjang Anda kosong</p>
                                <a href="/" class="text-purple-700 font-bold text-sm hover:underline mt-2 inline-block">Mulai belanja</a>
                            </div>
                        @endforelse
                    </div>

                    @if($cartItems->isNotEmpty())
                        <div class="p-5 bg-gray-50 border-t border-gray-100">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-600 font-bold">Total:</span>
                                <span class="text-xl font-black text-gray-900">
                                    Rp{{ number_format($cartItems->sum(fn($i) => $i->course->price), 0, ',', '.') }}
                                </span>
                            </div>
                            <a href="{{ route('keranjang') }}" class="block w-full bg-gray-900 text-white text-center py-3 font-bold rounded-lg hover:bg-gray-800 transition shadow-md">
                                Buka Keranjang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-3">
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
    
{{-- Dropdown Pilihan Bahasa --}}
<div x-data="{ languageModal: false }">
    <button 
        @click="languageModal = true" 
        class="flex items-center justify-center w-10 h-10 border border-black rounded-none hover:bg-gray-50 transition focus:outline-none bg-white cursor-pointer"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700 hover:text-blue-600 transition-colors">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
        </svg>
    </button>

    <div 
        x-show="languageModal" 
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[10000] flex items-center justify-center p-4 bg-[#2d2f31]/80"
    >
        <div 
            @click.away="languageModal = false"
            class="bg-white w-full max-w-[600px] rounded-lg shadow-2xl relative p-6 md:p-8"
        >
            <button @click="languageModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-black transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <h2 class="text-[19px] font-bold text-[#2d2f31] mb-6">Pilih bahasa</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                @php
                    $availableLangs = [
                        'en' => 'English',
                        'es' => 'Español',
                        'id' => 'Bahasa Indonesia'
                    ];
                @endphp

                @foreach($availableLangs as $code => $name)
                    <div class="flex">
                        <a href="/lang/{{ $code }}" 
                           class="inline-block text-[14px] px-3 py-1.5 transition-all duration-150 
                           {{ App::getLocale() == $code 
                                ? 'border border-[#2d2f31] font-bold text-[#2d2f31]' 
                                : 'text-[#2d2f31] hover:text-[#5624d0]' }}">
                            {{ $name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
    </nav>