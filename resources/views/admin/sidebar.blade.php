<aside class="w-64 bg-[#8a05db] flex flex-col h-screen text-white">
    
    <div class="h-16 flex items-center px-6 border-b border-white/10">
        <span class="text-3xl font-black">
            idemy
        </span>
    </div>

    <nav class="flex-1 p-4 space-y-2">

        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('admin.dashboard') ? 'bg-[#a91df0]' : 'hover:bg-[#9f16eb]' }}">
            <i class="fas fa-chart-pie"></i>
            <span>Ringkasan</span>
        </a>

        <a href="{{ route('admin.courses') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('admin.courses') ? 'bg-[#a91df0]' : 'hover:bg-[#9f16eb]' }}">
            <i class="fas fa-video"></i>
            <span>Kelola Kelas</span>
        </a>

        <a href="{{ route('admin.transactions') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('admin.transactions') ? 'bg-[#a91df0]' : 'hover:bg-[#9f16eb]' }}">
            <i class="fas fa-receipt"></i>
            <span>Transaksi</span>
        </a>

        <a href="{{ route('admin.users') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('admin.users') ? 'bg-[#a91df0]' : 'hover:bg-[#9f16eb]' }}">
            <i class="fas fa-users"></i>
            <span>Pengguna</span>
        </a>

    </nav>

</aside>