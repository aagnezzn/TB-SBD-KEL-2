<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas - Admin Idemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f7f9fa] flex h-screen overflow-hidden font-sans text-[#1c1d1f]">

    {{-- Sidebar --}}
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

    {{-- Main Content --}}
    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-16 bg-white border-b border-[#d1d7dc] flex items-center justify-between px-8 sticky top-0 z-10 shrink-0">
            <h2 class="text-2xl font-bold leading-none">Edit Kelas: {{ Str::limit($course->title, 40) }}</h2>
            <div class="flex items-center gap-6">
                <a href="{{ route('admin.courses') }}" class="text-sm font-bold text-[#a435f0] hover:underline">Batal & Kembali</a>
            </div>
        </header>

        <div class="p-8 flex justify-center">
            <div class="w-full max-w-4xl grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Form Edit --}}
                <div class="lg:col-span-2 bg-white rounded-xl border border-[#d1d7dc] shadow-sm p-8">
                    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label class="block text-sm font-bold text-[#1c1d1f] mb-2">Judul Kelas</label>
                            <input type="text" name="title" value="{{ $course->title }}" required 
                                   class="w-full border border-[#d1d7dc] p-3 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#1c1d1f] mb-2">Deskripsi Singkat</label>
                            <textarea name="description" rows="5" required 
                                      class="w-full border border-[#d1d7dc] p-3 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none">{{ $course->description }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-[#1c1d1f] mb-2">Harga (Rupiah)</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3 text-gray-500 text-sm font-bold">Rp</span>
                                    <input type="number" name="price" value="{{ $course->price }}" required 
                                           class="w-full border border-[#d1d7dc] pl-10 p-3 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1c1d1f] mb-2">URL Gambar Thumbnail</label>
                                <input type="text" id="image_url_input" name="image_url" value="{{ $course->image_url }}" 
                                       class="w-full border border-[#d1d7dc] p-3 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none">
                                <p class="text-[10px] text-gray-500 mt-1 italic">*Gunakan URL Unsplash untuk hasil terbaik.</p>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-[#d1d7dc] flex justify-end gap-3">
                            <button type="submit" class="bg-[#a435f0] hover:bg-[#8710d8] text-white px-8 py-3 rounded-lg font-bold transition-all shadow-md">
                                <i class="fas fa-save mr-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Preview Section (Selaras dengan Sistem Gambar Baru) --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-xl border border-[#d1d7dc] shadow-sm p-6 sticky top-24">
                        <h3 class="text-sm font-bold mb-4 uppercase tracking-wider text-gray-500">Pratinjau Tampilan</h3>
                        
                        <div class="border rounded-lg overflow-hidden bg-gray-50">
                            {{-- Image Preview with JS --}}
                            <img id="course_preview_img" 
                                 src="{{ $course->image_url }}" 
                                 class="w-full h-40 object-cover border-b border-[#d1d7dc]"
                                 onerror="this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80';">
                            
                            <div class="p-4">
                                <p class="text-xs font-bold text-purple-600 mb-1">ID KELAS: #{{ $course->id }}</p>
                                <h4 id="preview_title" class="font-bold text-sm leading-tight mb-2 h-10 overflow-hidden">{{ $course->title }}</h4>
                                <div class="flex items-center justify-between mt-4">
                                    <span class="text-lg font-black">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                                    <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded font-bold">{{ $course->status }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-4 leading-relaxed">
                            <i class="fas fa-info-circle mr-1"></i>Perubahan pada judul, deskripsi, harga, dan gambar akan langsung tercermin di halaman kelas setelah disimpan.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </main>

    {{-- Script Live Preview --}}
    <script>
        const imgInput = document.getElementById('image_url_input');
        const imgPreview = document.getElementById('course_preview_img');
        const titleInput = document.querySelector('input[name="title"]');
        const titlePreview = document.getElementById('preview_title');

        // Update Gambar Live
        imgInput.addEventListener('input', (e) => {
            imgPreview.src = e.target.value || 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80';
        });

        // Update Judul Live
        titleInput.addEventListener('input', (e) => {
            titlePreview.innerText = e.target.value || 'Judul Kelas';
        });
    </script>

</body>
</html>