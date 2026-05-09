<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - Admin Idemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f7f9fa] flex h-screen overflow-hidden font-sans text-[#1c1d1f]">

    <aside class="w-64 bg-white border-r border-[#d1d7dc] flex flex-col shrink-0">
        <div class="h-16 flex items-center px-6 border-b border-[#d1d7dc] shrink-0">
            <span class="text-3xl font-bold">idemy <span class="text-sm font-normal text-[#a435f0] bg-purple-100 px-2 py-1 rounded">Admin</span></span>
        </div>
        
        <nav class="flex-1 py-6 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-[#1c1d1f] hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-chart-pie w-6 text-[#6a6f73]"></i> Ringkasan
            </a>
            <a href="{{ route('admin.courses') }}" class="flex items-center px-4 py-3 text-[#1c1d1f] hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-video w-6 text-[#6a6f73]"></i> Kelola Kelas
            </a>
            <a href="{{ route('admin.transactions') }}" class="flex items-center px-4 py-3 text-[#1c1d1f] hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-receipt w-6 text-[#6a6f73]"></i> Transaksi
            </a>
            <a href="{{ route('admin.transactions') }}" class="flex items-center px-4 py-3 text-[#a435f0] bg-[#f7f9fa] border border-[#d1d7dc] rounded-lg font-bold transition-colors">
                <i class="fas fa-receipt w-6"></i> Pengguna
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <header class="h-16 bg-white border-b border-[#d1d7dc] flex items-center justify-between px-8 shrink-0">
            <h1 class="text-xl font-bold">Kelola Pengguna</h1>
            <div class="flex items-center gap-6">
                <span class="text-sm font-semibold text-[#6a6f73]">Halo, Admin!</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-700 flex items-center gap-2">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-6xl mx-auto">
                <div class="bg-white border border-[#d1d7dc] rounded-sm shadow-sm overflow-hidden">
                  <div class="max-w-6xl mx-auto mb-6">
    <form action="{{ route('admin.users') }}" method="GET" class="flex gap-2">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Cari nama atau email pengguna..." 
                class="w-full pl-10 pr-4 py-2 border border-[#d1d7dc] focus:border-[#1c1d1f] outline-none rounded-sm text-sm">
        </div>
        <button type="submit" class="bg-[#a435f0] text-white px-6 py-2 font-bold text-sm hover:bg-black transition-all">
            Cari
        </button>
        @if(request('search'))
            <a href="{{ route('admin.users') }}" class="bg-gray-200 text-gray-700 px-4 py-2 text-sm flex items-center">
                Reset
            </a>
        @endif
    </form>
</div>
                    <table class="w-full text-left">
                        <thead class="bg-[#f7f9fa] border-b border-[#d1d7dc]">
                            <tr>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-[#6a6f73]">Pengguna</th>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-[#6a6f73]">Email</th>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-[#6a6f73]">Role</th> <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-[#6a6f73]">Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#d1d7dc]">
                            @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-purple-600 rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span class="font-bold text-sm text-[#1c1d1f]">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#1c1d1f]">{{ $user->email }}</td>
                                
                                <td class="px-6 py-4">
                                    @if($user->role === 'admin')
                                        <span class="inline-block px-2 py-1 rounded text-[10px] font-black bg-purple-600 text-white uppercase">ADMIN</span>
                                    @elseif($user->role === 'instructor')
                                        <span class="inline-block px-2 py-1 rounded text-[10px] font-black bg-blue-600 text-white uppercase">INSTRUCTOR</span>
                                    @else
                                        <span class="inline-block px-2 py-1 rounded text-[10px] font-black bg-gray-200 text-gray-700 uppercase">STUDENT</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm text-[#6a6f73]">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-[#6a6f73]">Belum ada pengguna terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </main>

</body>
</html>