<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kursus - IDEMY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Open Sans', sans-serif; }</style>
</head>
<body class="bg-[#f7f9fa] text-[#1c1d1f]">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-[#1c1d1f] text-white flex flex-col shrink-0">
            <div class="p-6 border-b border-gray-800">
                <h1 class="text-2xl font-bold tracking-tighter">idemy</h1>
                <p class="text-[10px] text-blue-400 font-bold uppercase tracking-widest mt-1">Instructor Portal</p>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('instructor.dashboard') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-th-large w-5"></i><span class="ml-3 text-sm">Dashboard</span>
                </a>
                <a href="{{ route('instructor.courses.index') }}" class="flex items-center p-3 bg-blue-600 text-white rounded-md transition font-bold">
                    <i class="fas fa-play-circle w-5"></i><span class="ml-3 text-sm">Kursus Saya</span>
                </a>
                <a href="{{ route('instructor.students.index') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-users w-5"></i><span class="ml-3 text-sm">Siswa</span>
                </a>
                <a href="{{ route('instructor.performance') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-chart-bar w-5"></i><span class="ml-3 text-sm">Performa</span>
                </a>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <form action="{{ route('logout') }}" method="POST">@csrf
                    <button type="submit" class="flex items-center w-full p-3 text-gray-500 hover:text-red-400 font-bold text-sm"><i class="fas fa-sign-out-alt w-5"></i><span class="ml-3">Keluar</span></button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-10 shrink-0">
                <div class="font-bold text-gray-400 text-xs uppercase tracking-widest">Edit Mode</div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                    <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold uppercase border-2 border-white shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-10">
                <form action="{{ route('instructor.courses.update', $course->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-3xl font-bold">Edit Kursus</h1>
                        <button type="submit" class="bg-blue-600 text-white px-8 py-3 font-bold text-sm hover:bg-blue-700 shadow-lg shadow-blue-100">Simpan Perubahan</button>
                    </div>

                    <div class="grid grid-cols-1 gap-8">
                        <div class="bg-white border border-gray-200 p-8 shadow-sm">
                            <h3 class="font-bold text-gray-800 mb-6 border-b pb-2 uppercase text-xs tracking-widest">Informasi Dasar</h3>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="col-span-1">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Judul Kursus</label>
                                    <input type="text" name="title" value="{{ $course->title }}" required class="w-full border border-gray-200 p-3 rounded-sm outline-none focus:border-blue-600 font-bold text-gray-700 bg-white">
                                </div>
                                <div class="col-span-1">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Kategori</label>
                                    <select name="category_id" required class="w-full border border-gray-200 p-3 rounded-sm outline-none focus:border-blue-600 font-bold text-gray-700 bg-white">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Deskripsi</label>
                                    <textarea name="description" rows="3" required class="w-full border border-gray-200 p-3 rounded-sm outline-none focus:border-blue-600 font-bold text-gray-700 bg-white">{{ $course->description }}</textarea>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Harga (Rp)</label>
                                    <input type="number" name="price" value="{{ $course->price }}" required class="w-full border border-gray-200 p-3 rounded-sm outline-none focus:border-blue-600 font-bold text-gray-700 bg-white">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>