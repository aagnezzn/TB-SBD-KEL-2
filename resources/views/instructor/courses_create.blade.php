@extends('instructor.layout_instructor')

@section('title', 'Buat Kursus Baru - Idemy')
@section('page_title', 'Tambah Kursus') 

@section('content')
    <div class="max-w-3xl mx-auto py-8">
        {{-- Progress Bar  --}}
        <div class="w-full bg-purple-100 h-1.5 mb-10 rounded-full overflow-hidden">
            <div class="bg-[#a435f0] h-full w-1/2 transition-all duration-500 shadow-[0_0_8px_rgba(164,53,240,0.5)]"></div>
        </div>

        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight mb-4">Mari buat kursus pertama Anda</h1>
            <p class="text-gray-500 max-w-lg mx-auto">Isi detail dasar di bawah ini. Tenang saja, Anda bisa mengubah semua ini nanti setelah kursus terdaftar.</p>
        </div>

        {{-- Card utama --}}
        <div class="bg-white border border-purple-50 shadow-xl shadow-purple-900/5 rounded-2xl p-10">
            <form action="{{ route('instructor.courses.store') }}" method="POST" class="space-y-8">
                @csrf
                
                {{-- Input Judul --}}
                <div class="space-y-2">
                    <label class="block font-bold text-[11px] uppercase tracking-widest text-gray-400">Judul Kursus</label>
                    <input type="text" name="title" required value="{{ old('title') }}"
                        placeholder="Contoh: Belajar Laravel 12 dari Nol sampai Mahir" 
                        class="w-full p-4 border @error('title') border-red-500 @else border-purple-100 @enderror focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 outline-none transition-all text-lg font-semibold rounded-xl">
                    
                    @error('title')
                        <p class="text-red-500 text-xs mt-2 font-bold italic"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @else
                        <p class="text-[10px] text-gray-400 font-medium">Faktanya, judul yang menarik akan meningkatkan minat klik siswa secara signifikan.</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-8">
                    {{-- Input Kategori --}}
                    <div class="space-y-2">
                        <label class="block font-bold text-[11px] uppercase tracking-widest text-gray-400">Kategori</label>
                        <div class="relative">
                            <select name="category_id" required
                                class="w-full p-4 border @error('category_id') border-red-500 @else border-purple-100 @enderror focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 outline-none appearance-none bg-white rounded-xl transition-all cursor-pointer font-semibold text-gray-700">
                                <option value="">Pilih kategori...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-[#5624d0]">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('category_id')
                            <p class="text-red-500 text-xs mt-2 font-bold italic"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Harga --}}
                    <div class="space-y-2">
                        <label class="block font-bold text-[11px] uppercase tracking-widest text-gray-400">Harga Kursus (IDR)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 font-bold">Rp</span>
                            <input type="number" name="price" required placeholder="150000" value="{{ old('price') }}"
                                class="w-full pl-12 pr-4 py-4 border @error('price') border-red-500 @else border-purple-100 @enderror focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 outline-none rounded-xl transition-all font-semibold text-gray-700">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-xs mt-2 font-bold italic"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Input Deskripsi --}}
                <div class="space-y-2">
                    <label class="block font-bold text-[11px] uppercase tracking-widest text-gray-400">Deskripsi Singkat</label>
                    <textarea name="description" rows="4" required
                        placeholder="Jelaskan secara singkat apa yang akan dipelajari oleh siswa Anda..." 
                        class="w-full p-4 border @error('description') border-red-500 @else border-purple-100 @enderror focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 outline-none rounded-xl transition-all resize-none font-medium text-gray-700 leading-relaxed">{{ old('description') }}</textarea>
                    
                    @error('description')
                        <p class="text-red-500 text-xs mt-2 font-bold italic"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                {{-- Footer Aksi --}}
                <div class="flex justify-between items-center pt-8 border-t border-purple-50">
                    {{-- FIX: Link Kelola diarahkan ke Dashboard Instructor --}}
                    <a href="{{ route('instructor.dashboard') }}" class="font-bold text-gray-400 hover:text-red-500 transition-all uppercase text-[10px] tracking-widest flex items-center gap-2">
                        <i class="fas fa-times"></i> Batalkan
                    </a>
                    
                    <button type="submit" class="bg-[#5624d0] text-white px-12 py-4 font-bold hover:bg-[#4c1da7] transition-all shadow-xl shadow-purple-100 rounded-xl uppercase text-[10px] tracking-widest flex items-center gap-3 active:scale-95">
                        Kirim Kursus <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection