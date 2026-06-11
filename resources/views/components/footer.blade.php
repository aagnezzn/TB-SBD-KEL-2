<footer class="text-gray-300 font-sans w-full">
    <div class="bg-[#303246] py-10 px-10">
        <h2 class="text-2xl font-bold text-white mb-10">{{ __('menu.explore_title') }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-x-8 gap-y-12">
            @foreach($navCategories->take(7) as $mainCat) 
            <div>
                <h3 class="text-white font-extrabold text-base mb-4 uppercase tracking-wide text-[14px]">
                    {{ $mainCat->name }}
                </h3>
                
                <div class="space-y-4">
                    {{-- Ambil Sub-Kategori --}}
                    @foreach($mainCat->children->take(2) as $subCat)
                    <div>
                        <span class="text-gray-400 font-semibold text-xs uppercase block mb-1 tracking-wider">
                            → {{ $subCat->name }}
                        </span>

                        <ul class="pl-4 space-y-1.5 border-l border-gray-700">
                            @foreach($subCat->children->take(3) as $topic)
                            <li>
                                <a href="{{ route('category.show', $topic->slug) }}" class="text-sm text-gray-300 hover:text-white hover:underline transition duration-150 block">
                                    {{ $topic->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bg-[#232433] py-8 border-t border-gray-800">
       <div class="max-w-[1340px] mx-auto px-4 md:px-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-x-8 gap-y-8 mb-10 items-start">
                
                {{-- KOLOM 1: IDEMY TEAM & NAMA ANGGOTA KELOMPOK --}}
                <div>
                    <h3 class="text-white font-bold text-base mb-4">Idemy Team</h3>
                    {{-- Daftar nama 4 anggota kelompok --}}
                    <ul class="space-y-2 text-sm leading-snug text-gray-400">
                       <li><a href="#" class="hover:underline hover:text-purple-400 transition">Khairunnisa</a></li>
                       <li><a href="#" class="hover:underline hover:text-purple-400 transition">Nadia Stevany S</a></li>
                       <li><a href="#" class="hover:underline hover:text-purple-400 transition">Agnes Natalia S</a></li>
                       <li><a href="#" class="hover:underline hover:text-purple-400 transition">Limjun Basani S</a></li>
                    </ul>
                </div>

                {{-- KOLOM 2: JELAJAHI IDEMY --}}
                <div>
                    <h3 class="text-white font-bold text-base mb-4">{{ __('menu.explore') }}</h3>
                    <ul class="space-y-2 text-sm leading-snug text-gray-400">
                        <li><a href="{{ route('mengajar') }}" class="hover:underline hover:text-purple-400 transition">{{ __('menu.teach_on_idemy') }}</a></li>
                        <li><a href="#" class="hover:underline hover:text-purple-400 transition">{{ __('menu.Telusuri') }}</a></li>
                    </ul>
                </div>

                {{-- KOLOM 3: LEGALITAS --}}
                <div>
                    <h3 class="text-white font-bold text-base mb-4">{{ __('menu.legal') }}</h3>
                    <ul class="space-y-2 text-sm leading-snug text-gray-400">
                        <li><a href="#" class="hover:underline hover:text-purple-400 transition">{{ __('menu.privacy') }}</a></li>
                        <li><a href="#" class="hover:underline hover:text-purple-400 transition">{{ __('menu.terms') }}</a></li>
                    </ul>
                </div>
                
            </div>
        <div class="border-t border-gray-700 mt-10 py-6 flex flex-col md:flex-row justify-between items-center text-sm">
            <div class="flex items-center space-x-4 mb-6 md:mb-0">
                <span class="text-3xl font-extrabold text-white tracking-tighter">idemy</span>
                <span class="text-xs mt-1">© 2026 Idemy, Inc.</span>
            </div>
            <div>
                <a href="#" class="hover:underline text-gray-400 hover:text-white">{{__('menu.Pengaturan cookie')}}</a>
            </div>
            {{-- Bahasa --}}
            <button 
                @click="languageModal = true" 
                class="flex items-center space-x-2 cursor-pointer text-gray-400 hover:text-white transition bg-transparent border-none outline-none focus:outline-none"
>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                </svg>
                <span class="text-sm font-medium">
                {{ App::getLocale() == 'id' ? 'Bahasa Indonesia' : (App::getLocale() == 'en' ? 'English' : 'Español') }}
                </span>
            </button>
        </div>
    </div>
</footer>