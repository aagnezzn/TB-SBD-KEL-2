<nav class="bg-white border-b px-6 py-3 flex items-center justify-between">

    <!-- KIRI -->
    <div class="flex items-center space-x-6">

        <h1 class="text-2xl font-bold text-black">idemy</h1>

        <nav class="bg-white border-b px-6 py-3 flex items-center justify-between">

       <div class="relative" x-data="{ 
    showMenu: false, 
    level1: 'ai', 
    level2: '' 
}">
    <button @click="showMenu = !showMenu" 
            class="px-4 py-2 text-sm font-medium hover:text-purple-700 transition-colors">
        Jelajahi
    </button>
    
    <div x-show="showMenu" 
         @click.away="showMenu = false"
         x-cloak
         class="absolute left-0 top-full mt-2 w-[850px] bg-white border border-gray-200 shadow-2xl z-50 flex rounded-sm"
         style="min-height: 400px;">
        
        <div class="w-1/3 border-r border-gray-100 py-4">
            <h4 class="px-6 py-2 text-xs font-bold text-gray-400 uppercase tracking-tighter mb-2">Telusuri berdasarkan Target</h4>
            <ul>
                <li @click="level1 = 'ai'; level2 = ''" 
                    :class="level1 === 'ai' ? 'bg-gray-50 text-purple-700 font-bold' : 'text-gray-700'"
                    class="px-6 py-2.5 flex justify-between items-center cursor-pointer text-[13.5px] hover:bg-gray-50 transition-all">
                    Pelajari AI <span>&rsaquo;</span>
                </li>
                <li @click="level1 = 'dev'; level2 = ''" 
                    :class="level1 === 'dev' ? 'bg-gray-50 text-purple-700 font-bold' : 'text-gray-700'"
                    class="px-6 py-2.5 flex justify-between items-center cursor-pointer text-[13.5px] hover:bg-gray-50">
                    Pengembangan <span>&rsaquo;</span>
                </li>
            </ul>
        </div>

        <div class="w-1/3 border-r border-gray-100 py-4">
            <div x-show="level1 === 'ai'">
                <ul class="space-y-1">
                    <li @click="level2 = 'dasar'" :class="level2 === 'dasar' ? 'text-purple-700 font-bold' : ''" class="px-6 py-2 text-sm text-gray-700 hover:text-purple-700 cursor-pointer flex justify-between items-center">
                        Dasar-Dasar AI <span>&rsaquo;</span>
                    </li>
                    <li @click="level2 = 'profesional'" :class="level2 === 'profesional' ? 'text-purple-700 font-bold' : ''" class="px-6 py-2 text-sm text-gray-700 hover:text-purple-700 cursor-pointer flex justify-between items-center">
                        AI Untuk Profesional <span>&rsaquo;</span>
                    </li>
                </ul>
            </div>
            
            <div x-show="level1 === 'dev'">
                <ul class="px-6 py-2 text-sm text-gray-500 italic">Daftar Kursus IT...</ul>
            </div>
        </div>

        <div class="w-1/3 py-4 px-8 bg-white">
            <h4 class="text-xs font-bold text-gray-400 uppercase mb-4 tracking-tighter">Topik populer</h4>
            
            <div x-show="level2 === 'dasar'" class="flex flex-col gap-3">
                <a href="#" class="text-sm text-gray-700 hover:text-purple-700">ChatGPT</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-700">Prompt Engineering</a>
            </div>

            <div x-show="level2 === 'profesional'" class="flex flex-col gap-3">
                <a href="#" class="text-sm text-gray-700 hover:text-purple-700">AI for Business</a>
                <a href="#" class="text-sm text-gray-700 hover:text-purple-700">Automation Tools</a>
            </div>

            <div x-show="level2 === ''" class="text-xs text-gray-300 italic">
                Klik sub-kategori untuk melihat topik populer
            </div>
        </div>
    </div>
</div>

        <a href="#" class="text-sm hover:text-purple-600">Berlangganan</a>

        <!-- Search -->
        <div class="relative">
            <input type="text"
                placeholder="Cari apa saja"
                class="w-[500px] border rounded-full pl-10 pr-4 py-2 text-sm focus:outline-none">

            <i data-feather="search"
               class="absolute left-3 top-2.5 w-4 h-4 text-gray-500"></i>
        </div>

    </div>

    <!-- KANAN -->
    <div class="flex items-center space-x-4">

        <a href="#" class="text-sm hover:text-purple-600">Idemy Business</a>
        <a href="#" class="text-sm hover:text-purple-600">Mengajar di Idemy</a>

        <i data-feather="shopping-cart" class="w-5 h-5"></i>

        <button class="border px-4 py-1 rounded text-sm hover:bg-gray-100">Log in</button>

        <button class="bg-purple-600 text-white px-4 py-1 rounded text-sm hover:bg-purple-700">
            Daftar
        </button>

        <i data-feather="globe" class="w-5 h-5"></i>

    </div>

</nav>