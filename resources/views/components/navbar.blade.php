<nav class="bg-white border-b border-gray-200 px-6 py-2 flex items-center h-16 w-full relative">

    <div class="flex items-center space-x-4 flex-shrink-0">
        <h1 class="text-2xl font-bold text-black cursor-pointer">idemy</h1>

        <div class="relative" x-data="{ showMenu: false, level1: 'ai', level2: '' }">
            <button @click="showMenu = !showMenu" 
                    class="px-3 py-2 text-sm font-medium hover:text-purple-700 transition-colors">
                Jelajahi
            </button>
            
            <div x-show="showMenu" 
                 @click.away="showMenu = false"
                 x-cloak
                 class="absolute left-0 top-[calc(100%+10px)] w-[850px] bg-white border border-gray-200 shadow-2xl z-[999] flex rounded-sm"
                 style="min-height: 450px;">
                
                <div class="w-1/3 border-r border-gray-100 py-4 bg-white">
                    <h4 class="px-6 py-2 text-xs font-bold text-gray-400 uppercase mb-2">Telusuri Target</h4>
                    <ul>
                        <li @click="level1 = 'ai'; level2 = ''" :class="level1 === 'ai' ? 'bg-gray-50 text-purple-700 font-bold' : ''" class="px-6 py-3 flex justify-between cursor-pointer text-sm hover:bg-gray-50">Pelajari AI <span>&rsaquo;</span></li>
                        <li @click="level1 = 'dev'; level2 = ''" :class="level1 === 'dev' ? 'bg-gray-50 text-purple-700 font-bold' : ''" class="px-6 py-3 flex justify-between cursor-pointer text-sm hover:bg-gray-50">Pengembangan <span>&rsaquo;</span></li>
                    </ul>
                </div>

                <div class="w-1/3 border-r border-gray-100 py-4 bg-gray-50/30">
                    <div x-show="level1 === 'ai'">
                        <li @click="level2 = 'dasar'" :class="level2 === 'dasar' ? 'text-purple-700 font-bold' : ''" class="px-6 py-2 text-sm cursor-pointer hover:text-purple-700">Dasar-Dasar AI</li>
                        <li @click="level2 = 'profesional'" :class="level2 === 'profesional' ? 'text-purple-700 font-bold' : ''" class="px-6 py-2 text-sm cursor-pointer hover:text-purple-700">AI Untuk Profesional</li>
                    </div>
                </div>

                <div class="w-1/3 py-4 px-8 bg-white">
                    <h4 class="text-xs font-bold text-gray-400 uppercase mb-4">Topik populer</h4>
                    <div x-show="level2 === 'dasar'" class="flex flex-col gap-3">
                        <a href="#" class="text-sm hover:text-purple-700">ChatGPT</a>
                        <a href="#" class="text-sm hover:text-purple-700">Prompt Engineering</a>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="text-sm hover:text-purple-600 whitespace-nowrap">Berlangganan</a>
    </div>

    <div class="flex-grow mx-6">
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-4 flex items-center">
                <i data-feather="search" class="w-4 h-4 text-gray-400"></i>
            </span>
            <input type="text"
                placeholder="Cari apa saja"
                class="w-full border border-gray-300 rounded-full pl-12 pr-4 py-2 text-sm bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500 transition-all">
        </div>
    </div>

    <div class="flex items-center space-x-3 flex-shrink-0">
    <a href="#" class="text-sm text-gray-800 hover:text-purple-700 hidden xl:block px-2 py-1">Idemy Business</a>
    <a href="#" class="text-sm text-gray-800 hover:text-purple-700 hidden lg:block px-2 py-1">Mengajar di Idemy</a>
    
    <button class="p-2.5 hover:bg-gray-100 rounded-full text-gray-700 hover:text-purple-700">
        <i data-feather="shopping-cart" class="w-5 h-5"></i>
    </button>

    <button class="border border-purple-700 text-purple-700 px-5 py-2 font-bold text-sm rounded-lg hover:bg-purple-50 transition-all duration-200">
        Log in
    </button>

    <button class="bg-purple-700 text-white px-5 py-2 font-bold text-sm rounded-lg border border-purple-700 hover:bg-purple-800 transition-all duration-200">
        Daftar
    </button>
    
    <button class="border p-2.5 rounded-lg border-purple-700 hover:bg-gray-100 text-gray-700 transition-all">
        <i data-feather="globe" class="w-5 h-5"></i>
    </button>
</div>
</nav>