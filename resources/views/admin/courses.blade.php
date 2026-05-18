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

    @include('admin.sidebar')

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-16 bg-white border-b border-[#d1d7dc] flex items-center justify-between px-8 shrink-0 shadow-sm">
            <h2 class="text-xl font-bold text-black">Kelola Kelas</h2>
            <div class="flex items-center gap-6">
                <span class="text-sm font-semibold text-gray-700">Halo, Admin!</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-400 flex items-center gap-2">
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
                                <td class="px-6 py-4 text-sm font-semibold">#{{ $course->id }}</td>
                                <td class="px-6 py-4 flex items-center gap-4">
                                    @if($course->image_url)
                                        <img src="{{ $course->image_url }}" alt="Thumbnail" class="w-16 h-12 object-cover rounded border">
                                    @else
                                        <div class="w-16 h-12 bg-gray-200 rounded border flex items-center justify-center text-gray-400 text-xs">No Img</div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-[#1c1d1f]">{{ $course->title }}</p>
                                        <p class="text-xs text-[#6a6f73] mt-1">{{ Str::limit($course->description, 60) }}</p>
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
                                            <button type="submit" class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-1.5 rounded text-xs font-bold transition-colors whitespace-nowrap flex items-center">
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

            <div class="mt-6">
                {{ $courses->links() }}
            </div>
        </div>
    </main>
</body>
</html>