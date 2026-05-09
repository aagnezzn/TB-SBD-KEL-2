<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas - Admin Idemy</title>
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
            <h2 class="text-2xl font-bold leading-none">Tambah Kelas Baru</h2>
            <div class="flex items-center gap-6">
                <a href="{{ route('admin.courses') }}" class="text-sm font-bold text-[#a435f0] hover:underline">Kembali ke Daftar</a>
            </div>
        </header>

        <div class="p-8 flex justify-center">
            <div class="w-full max-w-2xl bg-white rounded-xl border border-[#d1d7dc] shadow-sm overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-bold text-[#1c1d1f] mb-2">Judul Kelas</label>
                            <input type="text" name="title" required placeholder="Contoh: Belajar Laravel 11 untuk Pemula" 
                                   class="w-full border border-[#d1d7dc] p-3 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#1c1d1f] mb-2">Deskripsi Singkat</label>
                            <textarea name="description" rows="4" required placeholder="Jelaskan apa yang akan dipelajari di kelas ini..." 
                                      class="w-full border border-[#d1d7dc] p-3 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition-all"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-[#1c1d1f] mb-2">Harga (Rupiah)</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3 text-gray-500 text-sm font-bold">Rp</span>
                                    <input type="number" name="price" required placeholder="0" 
                                           class="w-full border border-[#d1d7dc] pl-10 p-3 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1c1d1f] mb-2">URL Gambar Thumbnail</label>
                                <input type="text" name="image_url" placeholder="https://link-gambar.com/foto.jpg" 
                                       class="w-full border border-[#d1d7dc] p-3 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition-all">
                            </div>
                        </div>

                        <div class="pt-4 border-t border-[#d1d7dc] flex justify-end">
                            <button type="submit" class="bg-[#a435f0] hover:bg-[#8710d8] text-white px-8 py-3 rounded-lg font-bold transition-all shadow-md">
                                <i class="fas fa-save mr-2"></i> Simpan Kelas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>
</html>