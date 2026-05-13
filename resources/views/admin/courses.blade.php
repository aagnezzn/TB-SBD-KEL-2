<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kelas - Admin Idemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f7f9fa] flex h-screen overflow-hidden font-sans text-[#1c1d1f]">

    <aside class="w-64 bg-white border-r border-[#d1d7dc] flex flex-col">
       <div class="h-16 flex items-center px-6 border-b border-[#d1d7dc] shrink-0">
            <span class="text-3xl font-bold">idemy <span class="text-sm font-normal text-[#a435f0] bg-purple-100 px-2 py-1 rounded">Admin</span></span>
        </div>
        
        <nav class="flex-1 py-6 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-[#1c1d1f] hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-chart-pie w-6 text-[#6a6f73]"></i> Ringkasan
            </a>
            <a href="{{ route('admin.courses') }}" class="flex items-center px-4 py-3 text-[#a435f0] bg-[#f7f9fa] border border-[#d1d7dc] rounded-lg font-bold transition-colors">
                <i class="fas fa-video w-6"></i> Kelola Kelas
            </a>
            <a href="{{ route('admin.transactions') }}" class="flex items-center px-4 py-3 text-[#1c1d1f] hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-receipt w-6 text-[#6a6f73]"></i> Transaksi
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 text-[#1c1d1f] hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-users w-6 text-[#6a6f73]"></i> Pengguna
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-16 bg-white border-b border-[#d1d7dc] flex items-center justify-between px-8 sticky top-0 z-10 shrink-0">
            <h2 class="text-2xl font-bold leading-none">Kelola Kelas</h2>
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

        <div class="p-8">

            <div class="bg-white rounded-xl border border-[#d1d7dc] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#f7f9fa] text-[#6a6f73] text-sm border-b border-[#d1d7dc]">
                                <th class="px-6 py-4 font-bold w-16">ID</th>
                                <th class="px-6 py-4 font-bold">Informasi Kelas</th>
                                <th class="px-6 py-4 font-bold">Harga</th>
                                <th class="px-6 py-4 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($courses as $course)
                            <tr class="border-b border-[#d1d7dc] hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-semibold">{{ $course->id }}</td>
                                <td class="px-6 py-4 flex items-center gap-4">
                                    @if($course->image_url)
                                        <img src="{{ $course->image_url }}" alt="Thumbnail" class="w-16 h-12 object-cover rounded border">
                                    @else
                                        <div class="w-16 h-12 bg-gray-200 rounded border flex items-center justify-center text-gray-400 text-xs">No Img</div>
                                    @endif
                                    
                                    <div>
                                        <p class="font-bold text-[#1c1d1f]">{{ $course->title }}</p>
                                        <p class="text-xs text-[#6a6f73] mt-1">{{ Str::limit($course->description, 50) }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-bold whitespace-nowrap">
                                    Rp {{ number_format($course->price, 0, ',', '.') }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.courses.edit', $course->id) }}" 
                                            class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1.5 rounded text-xs font-bold transition-colors whitespace-nowrap flex items-center">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>

                                    <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST" 
                                        onsubmit="return confirm('Yakin mau hapus kelas {{ $course->title }}?')">
                                        @csrf
                                        @method('DELETE')
                                    <button type="submit" 
                                         class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-1.5 rounded text-xs font-bold transition-colors whitespace-nowrap flex items-center">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-[#6a6f73]">Belum ada kelas yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>