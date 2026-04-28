<nav class="bg-white border-b border-gray-200 px-6 py-2 flex items-center h-16 w-full relative">

    <div class="flex items-center space-x-4 shrink-0">
        <h1 class="text-2xl font-bold text-black cursor-pointer">idemy</h1>

        <div class="relative flex items-center h-full" 
     x-data="{ showMenu: false, level1: 'ai', level2: '' }" 
     @mouseenter="showMenu = true" 
     @mouseleave="showMenu = false">

    <button class="px-3 py-2 text-sm font-medium hover:text-purple-800 transition-colors">
        Jelajahi
    </button>
    
    <div x-show="showMenu" 
         x-cloak
         class="absolute left-0 top-full w-[850px] bg-white border border-gray-200 shadow-2xl z-999 flex rounded-sm"
         style="min-height: 450px;">
        
        <div class="w-1/3 border-r border-gray-100 py-4 bg-white">
            <h4 class="px-6 py-2 text-xs font-bold text-gray-400 uppercase mb-2">Telusuri Target</h4>
            <ul>
                <li @mouseenter="level1 = 'ai'; level2 = ''" :class="level1 === 'ai' ? 'bg-gray-50 text-purple-800 font-bold' : ''" class="px-6 py-3 flex justify-between cursor-pointer text-sm hover:bg-gray-50">Pelajari AI <span>&rsaquo;</span></li>
                <li @mouseenter="level1 = 'dev'; level2 = ''" :class="level1 === 'dev' ? 'bg-gray-50 text-purple-800 font-bold' : ''" class="px-6 py-3 flex justify-between cursor-pointer text-sm hover:bg-gray-50">Pengembangan <span>&rsaquo;</span></li>
            </ul>
        </div>

        <div class="w-1/3 border-r border-gray-100 py-4 bg-gray-50/30">
            <div x-show="level1 === 'ai'">
                <li @mouseenter="level2 = 'dasar'" :class="level2 === 'dasar' ? 'text-purple-800 font-bold' : ''" class="px-6 py-2 text-sm cursor-pointer hover:text-purple-800">Dasar-Dasar AI</li>
                <li @mouseenter="level2 = 'profesional'" :class="level2 === 'profesional' ? 'text-purple-800 font-bold' : ''" class="px-6 py-2 text-sm cursor-pointer hover:text-purple-800">AI Untuk Profesional</li>
            </div>
        </div>

        <div class="w-1/3 py-4 px-8 bg-white">
            <h4 class="text-xs font-bold text-gray-400 uppercase mb-4">Topik populer</h4>
            <div x-show="level2 === 'dasar'" class="flex flex-col gap-3">
                <a href="#" class="text-sm hover:text-purple-800">ChatGPT</a>
                <a href="#" class="text-sm hover:text-purple-800">Prompt Engineering</a>
            </div>
        </div>
    </div>
</div>

        <a href="#" class="text-sm hover:text-purple-800 whitespace-nowrap">Berlangganan</a>
    </div>

    <div class="grow mx-6">
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-4 flex items-center">
                <i data-feather="search" class="w-4 h-4 text-gray-400"></i>
            </span>
            <input type="text"
                placeholder="Cari apa saja"
                class="w-full border border-gray-300 rounded-full pl-12 pr-4 py-2 text-sm bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500 transition-all">
        </div>
    </div>

    <div class="flex items-center space-x-3 shrink-0">
    <div class="relative" x-data="{ open: false }">
    <a href="#" 
       @mouseenter="open = true" 
       @mouseleave="open = false"
       class="text-sm text-gray-800 hover:text-purple-800 hidden xl:block px-2 py-4">
        Idemy Business
    </a>

    <div x-show="open" 
         @mouseenter="open = true" 
         @mouseleave="open = false"
         x-transition
         x-cloak
         class="absolute left-0 top-full w-56 bg-white border border-gray-200 shadow-lg py-2 z-1000 rounded-sm flex flex-col gap-1">
        
        <a href="#" class="px-4 py-2 text-sm text-gray-800 hover:text-purple-700">
            Bandingkan Paket
        </a>
        <a href="#" class="px-4 py-2 text-sm text-gray-800 hover:text-purple-700">
            Coba Udemy Business
        </a>
        
    </div>
</div>
    <div class="relative" 
     x-data="{ open: false }" 
     @mouseenter="open = true" 
     @mouseleave="open = false">
     
    <a href="#" class="text-sm text-gray-800 hover:text-purple-800 hidden lg:block px-2 py-4">
        Mengajar di Idemy
    </a>

    <div x-show="open" 
         x-transition
         x-cloak
         class="absolute right-0 top-full w-72 bg-white border border-gray-200 shadow-lg p-4 z-1000 rounded-sm text-center flex flex-col gap-3">
        
        <p class="text-gray-800 font-bold text-base leading-snug">
            Jadikan pengetahuan Anda sebagai peluang untuk menjangkau jutaan orang di seluruh dunia.
        </p>
        
        <button class="w-full bg-purple-800 text-white font-bold py-3 text-sm hover:bg-purple-900 transition-colors">
            Pelajari selengkapnya
        </button>
        
    </div>
</div>
    
    <button class="p-2.5 hover:bg-gray-100 rounded-full text-gray-700 hover:text-purple-800">
        <i data-feather="shopping-cart" class="w-5 h-5"></i>
    </button>

    <button class="border border-purple-800 text-purple-800 px-5 py-2 font-bold text-sm rounded-lg hover:bg-purple-50 transition-all duration-200">
        Log in
    </button>

    <button class="bg-purple-700 text-white px-5 py-2 font-bold text-sm rounded-lg border border-purple-800 hover:bg-purple-900 transition-all duration-200">
        Daftar
    </button>
    
    <div x-data="{ openModal: false }">
    
    <button @click="openModal = true" class="border p-2.5 rounded-lg border-gray-800 hover:bg-gray-100 text-gray-700 transition-all">
        <i data-feather="globe" class="w-5 h-5"></i>
    </button>

    <div x-show="openModal"
     x-transition.opacity
     x-cloak
     class="fixed inset-0 z-9999 bg-black/20 backdrop-blur-sm flex items-center justify-center"
     @click.self="openModal = false">
        
        <div x-show="openModal" 
             x-transition.scale.95
             class="bg-white w-[700px] rounded-sm shadow-2xl p-8 relative">
             
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Pilih bahasa</h2>
                <button @click="openModal = false" class="text-gray-600 hover:text-black">
                    <i data-feather="x" class="w-6 h-6"></i>
                </button>
            </div>

            <div class="grid grid-cols-4 gap-y-4 gap-x-2">
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">English</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">Italiano</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">Română</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">中文(繁體)</a>
                
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">العربية</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">日本語</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">Русский</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2"></a>

                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">Deutsch</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">한국어</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2 font-bold">ภาษาไทย</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2"></a>

                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">Español</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">Nederlands</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">Türkçe</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2"></a>

                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2 border border-gray-800 rounded">Bahasa Indonesia</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">Português</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-800 p-2">中文(简体)</a>
            </div>
        </div>
    </div>
</div>
</div>
</nav>