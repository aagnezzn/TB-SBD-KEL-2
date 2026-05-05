<nav class="bg-white border-b border-gray-200 px-6 py-2 flex items-center h-16 w-full relative">

    <div class="flex items-center space-x-4 flex-shrink-0">
        <h1 class="text-2xl font-bold text-black cursor-pointer">idemy</h1>

        <!-- Jelajahi -->
        <div class="relative group inline-block">
            <button class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-[#5624d0]">
                {{ __('menu.explore') }}
            </button>

            <ul class="absolute hidden group-hover:block bg-white border border-gray-200 shadow-xl w-[280px] left-0 top-full z-[100] py-2">
                @foreach($navCategories as $mainCat)
                <li class="group/level2 px-4 py-[10px] hover:bg-gray-50 flex justify-between items-center cursor-pointer">
                    <span class="text-[14px] text-gray-700 group-hover/level2:text-[#5624d0] capitalize">{{ $mainCat->name }}</span>
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>

                    <ul class="absolute hidden group-hover/level2:block bg-white border border-gray-200 shadow-xl w-[280px] left-full top-0 z-[110] min-h-full py-2">
                        @foreach($mainCat->children as $subCat)
                        <li class="group/level3 px-4 py-[10px] hover:bg-gray-50 flex justify-between items-center cursor-pointer">
                            <span class="text-[14px] text-gray-700 group-hover/level3:text-[#5624d0] capitalize">{{ $subCat->name }}</span>
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>

                            <div class="absolute hidden group-hover/level3:block bg-white border border-gray-200 shadow-xl w-[300px] left-full top-0 z-[120] min-h-[550px] p-6">
                                <h4 class="font-bold text-gray-500 mb-4 text-[15px]">Topik populer</h4>
                                <div class="flex flex-col space-y-4">
                                    <div class="flex flex-col space-y-4">
                                        {{-- Mengambil topik populer berdasarkan anak dari sub-kategori (Level 3)[cite: 6] --}}
                                    @foreach($subCat->children as $topic)
                                       <a class="text-sm text-gray-600 hover:text-[#5624d0] capitalize" href="{{ route('category.show', $topic->slug) }}">
                                        {{ $topic->name }}
                                        </a>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>

        <a href="{{ url('/berlangganan') }}" class="text-sm hover:text-purple-600 whitespace-nowrap">{{ __('menu.subscribe') }}</a>
    </div>

    <div class="flex-grow mx-6">
    <!-- Tambahkan FORM dengan method GET dan action ke route search -->
    <form action="{{ route('search') }}" method="GET" class="relative w-full">
        <span class="absolute inset-y-0 left-4 flex items-center">
            <i data-feather="search" class="w-4 h-4 text-gray-400"></i>
        </span>
        <input type="text"
            name="query" {{-- INI WAJIB ADA: Nama variabel untuk dibaca Controller --}}
            value="{{ request('query') }}" {{-- Biar tulisan yg dicari nggak hilang pas di-refresh --}}
            placeholder="{{ __('menu.search_placeholder') }}"
            class="w-full border border-gray-300 rounded-full pl-12 pr-4 py-2 text-sm bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500 transition-all">
        
        {{-- Tombol submit tersembunyi agar bisa enter --}}
        <button type="submit" class="hidden"></button>
    </form>
</div>

    <div class="flex items-center space-x-3 flex-shrink-0">
        <!-- Mengajar di Idemy -->
        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <a href="{{ route('mengajar') }}" class="text-sm text-gray-800 hover:text-purple-700 hidden lg:block px-2 py-4">
                {{ __('menu.teach_on_idemy') }}
            </a>

            <div x-show="open" x-transition x-cloak class="absolute right-0 top-full w-72 bg-white border border-gray-200 shadow-lg p-4 z-[1000] rounded-sm text-center flex flex-col gap-3">
                <p class="text-gray-800 font-bold text-base leading-snug">{{ __('menu.teach_desc') }}</p>
                <a href="{{ route('mengajar') }}" class="w-full bg-purple-700 text-white font-bold py-3 text-sm hover:bg-purple-800 transition-colors">{{ __('menu.learn_more') }}</a>
            </div>
        </div>
        
        <!-- Keranjang -->
        <div class="relative group py-4">
            <a href="{{ route('keranjang') }}" class="text-gray-700 hover:text-purple-700 transition flex items-center h-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </a>
            <div class="absolute right-0 top-16 w-[300px] bg-white border border-gray-200 shadow-xl hidden group-hover:block text-center p-6 cursor-default z-50">
                <p class="text-gray-600 text-base mb-4">{{ __('menu.cart_empty') }}</p>
                <a href="#" class="text-[#a435f0] font-bold text-sm hover:text-[#8710d8]">{{ __('menu.keep_shopping') }}</a>
            </div>
        </div>

        <div class="flex items-center space-x-4 z-50">
            @guest
                <a href="/login" class="border border-purple-700 text-purple-700 px-5 py-2 font-bold text-sm rounded-lg hover:bg-purple-50 transition-all duration-200 text-center inline-block">{{ __('menu.login') }}</a>
                <a href="/register" class="bg-purple-700 text-white px-5 py-2 font-bold text-sm rounded-lg border border-purple-700 hover:bg-purple-800 transition-all duration-200">{{ __('menu.register') }}</a>

                <!-- Tombol Bahasa -->
                <div x-data="{ openModal: false }">
                    <button @click="openModal = true" class="border p-2.5 rounded-lg border-gray-800 hover:bg-gray-100 text-gray-700 transition-all">
                        <i data-feather="globe" class="w-5 h-5"></i>
                    </button>
                    <!-- Modal Code Start -->
                    <div x-show="openModal" x-transition.opacity x-cloak class="fixed inset-0 z-[9999] bg-black/20 backdrop-blur-sm flex items-center justify-center" @click.self="openModal = false">
                        <div x-show="openModal" x-transition.scale.95 class="bg-white w-[700px] rounded-sm shadow-2xl p-8 relative cursor-default">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-bold text-gray-800">{{ __('menu.select_lang') }}</h2>
                                <button @click="openModal = false" class="text-gray-600 hover:text-black"><i data-feather="x" class="w-6 h-6"></i></button>
                            </div>
                            <div class="grid grid-cols-4 gap-y-4 gap-x-2">
                                <a href="{{ url('lang/en') }}" class="text-sm p-2 rounded {{ app()->getLocale() == 'en' ? 'border border-gray-800 text-gray-900 font-bold' : 'text-gray-700 hover:text-purple-700' }}">English</a>
                                <a href="{{ url('lang/es') }}" class="text-sm p-2 rounded {{ app()->getLocale() == 'es' ? 'border border-gray-800 text-gray-900 font-bold' : 'text-gray-700 hover:text-purple-700' }}">Spanish</a>
                                <a href="{{ url('lang/id') }}" class="text-sm p-2 rounded {{ app()->getLocale() == 'id' ? 'border border-gray-800 text-gray-900 font-bold' : 'text-gray-700 hover:text-purple-700' }}">Bahasa Indonesia</a>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Code End -->
                </div>
            @endguest

            @auth
                <!-- Bagian Pembelajaran Saya & Profile (Pastikan ditaruh di sini agar rapi) -->
                <div class="relative group py-4 hidden md:block">
                    <a href="#" class="text-sm font-normal text-gray-700 group-hover:text-purple-700 transition">{{ __('menu.my_learning') }}</a>
                    <div class="absolute right-0 top-16 w-[300px] bg-white border border-gray-200 shadow-xl hidden group-hover:block text-center p-6 cursor-default z-50">
                        <p class="text-gray-600 text-base mb-4 text-[#1c1d27]">{{ __('menu.Start') }}</p>
                        <a href="#" class="text-[#a435f0] font-bold text-sm hover:text-[#8710d8]">{{ __('menu.Telusuri') }}</a>
                    </div>
                </div>

                <div class="relative group cursor-pointer py-4">
                    <div class="w-12 h-12 bg-black text-white rounded-full flex items-center justify-center font-bold text-xl">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="absolute right-0 top-16 w-[280px] bg-white border border-gray-200 shadow-xl hidden group-hover:block text-[15px] cursor-default z-50">
                        <div class="p-4 border-b">
                            <div class="font-bold truncate">{{ Auth::user()->name }}</div>
                            <div class="text-gray-500 text-xs truncate">{{ Auth::user()->email }}</div>
                        </div>
                        <!-- 2. Belajar -->
                <div class="py-2">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">{{ __('menu.my_learning') }}</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Keranjang saya</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Daftar Keinginan</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Mengajar di Idemy</a>
                </div>
                <hr class="border-gray-200">

                <!-- 3. Notifikasi -->
                <div class="py-2">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Pemberitahuan</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Pesan</a>
                </div>
                <hr class="border-gray-200">

                <!-- 4. Pengaturan -->
                <div class="py-2">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Pengaturan akun</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Metode pembayaran</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Langganan</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Kredit Idemy</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Riwayat pembelian</a>
                </div>
                <hr class="border-gray-200">

                <!-- 5. Bahasa -->
                <div class="py-2">
                    <a href="#" class="flex justify-between items-center px-4 py-2 text-gray-700 hover:text-purple-700 transition">
                        <span>Bahasa</span>
                        <div class="flex items-center gap-1">
                            <span>Bahasa Indonesia</span>
                            <i data-feather="globe" class="w-4 h-4"></i>
                        </div>
                    </a>
                </div>
                <hr class="border-gray-200">

                <!-- 6. Profil Publik -->
                <div class="py-2">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Profil publik</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Edit profil</a>
                </div>
                <hr class="border-gray-200">

                <!-- 7. Bantuan & Logout -->
                <div class="py-2">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:text-purple-700 transition">Bantuan dan Dukungan</a>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:text-purple-700 transition cursor-pointer">Logout</button>
                    </form>
                </div>

            </div>
        </div>
    @endauth

</div>
</div>
</div>
</div>
</div>
</nav>