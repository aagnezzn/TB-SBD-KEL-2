<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kursus Baru - IDEMY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Open Sans', sans-serif; }</style>
</head>
<body class="bg-[#f7f9fa] text-[#1c1d1f]">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-[#1c1d1f] text-white flex flex-col shrink-0">
            <div class="p-6 border-b border-gray-800">
                <h1 class="text-2xl font-bold tracking-tighter ">idemy</h1>
                <p class="text-[10px] text-blue-400 font-bold uppercase tracking-widest mt-1">Instructor Portal</p>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('instructor.dashboard') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-th-large w-5"></i><span class="ml-3 text-sm">Dashboard</span>
                </a>
                <a href="{{ route('instructor.courses.index') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-play-circle w-5"></i><span class="ml-3 text-sm">Kursus Saya</span>
                </a>
                <a href="{{ route('instructor.students.index') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-users w-5"></i><span class="ml-3 text-sm">Siswa</span>
                </a>
                <a href="{{ route('instructor.performance') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-chart-bar w-5"></i><span class="ml-3 text-sm">Performa</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-10 shrink-0">
                <div class="font-bold text-gray-400 text-xs uppercase tracking-widest">Langkah 1: Detail Kursus</div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                    <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold uppercase border-2 border-white shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-10">
                <div class="max-w-3xl mx-auto bg-white border border-gray-200 shadow-sm p-10">
                    <h2 class="text-3xl font-bold mb-8">Tuliskan Detail Kursus Anda</h2>
                    
                    <form action="{{ route('instructor.courses.save') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block font-bold mb-2 text-sm uppercase tracking-wider text-gray-500">Judul Kursus</label>
                            <input type="text" name="title" required placeholder="Contoh: Belajar Web Design dari Nol" 
                                class="w-full p-4 border border-gray-300 focus:border-blue-600 outline-none rounded-sm transition font-semibold">
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block font-bold mb-2 text-sm uppercase tracking-wider text-gray-500">Pilih Kategori</label>
                                <select name="category_id" required class="w-full p-4 border border-gray-300 focus:border-blue-600 outline-none rounded-sm bg-white font-semibold">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-bold mb-2 text-sm uppercase tracking-wider text-gray-500">Harga (IDR)</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 font-bold">Rp</span>
                                    <input type="number" name="price" required placeholder="500000" 
                                        class="w-full pl-12 p-4 border border-gray-300 focus:border-blue-600 outline-none rounded-sm font-semibold">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-sm uppercase tracking-wider text-gray-500">Deskripsi Singkat</label>
                            <textarea name="description" rows="5" required placeholder="Apa yang akan dipelajari di kursus ini?" 
                                class="w-full p-4 border border-gray-300 focus:border-blue-600 outline-none rounded-sm resize-none font-medium"></textarea>
                        </div>

                        <div class="flex justify-between items-center pt-8 border-t border-gray-100">
                            <a href="{{ route('instructor.dashboard') }}" class="font-bold text-gray-400 hover:text-red-500 transition uppercase text-xs tracking-widest">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-10 py-4 font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-100 uppercase text-xs tracking-widest">
                                Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>