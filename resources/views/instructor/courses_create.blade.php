
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kursus Baru - Idemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white font-sans text-[#2d2f31]">

    <nav class="h-16 border-b px-8 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-4">
            <span class="text-2xl font-bold text-purple-700">idemy</span>
            <span class="border-l pl-4 text-sm font-bold text-gray-500 uppercase tracking-widest">Langkah 1 dari 2</span>
        </div>
        <a href="/" class="text-sm font-bold text-purple-700 hover:text-purple-900 transition">Keluar</a>
    </nav>

    <div class="max-w-3xl mx-auto py-16 px-6">
        <div class="w-full bg-gray-200 h-1 mb-12">
            <div class="bg-purple-700 h-1 w-1/2"></div>
        </div>

        <h1 class="text-3xl font-serif font-bold mb-4 text-center">Mari buat kursus pertama Anda</h1>
        <p class="text-gray-600 mb-10 text-center">Isi detail dasar di bawah ini. Tenang saja, Anda bisa mengubah semua ini nanti setelah kursus terdaftar.</p>

        <form action="{{ route('instructor.courses.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <div>
                <label class="block font-bold mb-2 text-lg">Judul Kursus</label>
                <input type="text" name="title" required
                    placeholder="Contoh: Belajar Laravel 11 dari Nol sampai Mahir" 
                    class="w-full p-4 border border-gray-400 focus:border-black outline-none transition text-lg placeholder:text-gray-400 rounded-sm">
                <p class="text-xs text-gray-500 mt-2">Judul yang bagus akan menarik minat lebih banyak siswa.</p>
            </div>

            <div>
                <label class="block font-bold mb-2 text-lg">Kategori</label>
                <div class="relative">
                    <select name="category_id" required
                        class="w-full p-4 border border-gray-400 focus:border-black outline-none appearance-none bg-white rounded-sm transition cursor-pointer">
                        <option value="">Pilih kategori yang paling sesuai...</option>
                        
                        @forelse($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                            <option disabled>Belum ada kategori di database</option>
                        @endforelse

                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div>
                <label class="block font-bold mb-2 text-lg">Harga Kursus (IDR)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 font-bold">Rp</span>
                    <input type="number" name="price" required placeholder="150000 (Tulis tanpa titik)" 
                        class="w-full pl-12 pr-4 py-4 border border-gray-400 focus:border-black outline-none rounded-sm transition">
                </div>
            </div>

            <div>
                <label class="block font-bold mb-2 text-lg">Deskripsi Singkat</label>
                <textarea name="description" rows="5" required
                    placeholder="Jelaskan secara singkat apa yang akan dipelajari oleh siswa Anda..." 
                    class="w-full p-4 border border-gray-400 focus:border-black outline-none rounded-sm transition resize-none"></textarea>
            </div>

            <div class="flex justify-between items-center pt-8 border-t">
                <button type="button" onclick="window.history.back()" class="font-bold text-gray-600 hover:text-black transition">
                    Kembali
                </button>
                <button type="submit" class="bg-[#1c1d1f] text-white px-10 py-4 font-bold hover:bg-black transition shadow-md">
                    Tambahkan Kursus
                </button>
            </div>
        </form>
    </div>

</body>
</html>