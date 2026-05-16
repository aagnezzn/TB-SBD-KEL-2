@extends('instructor.layout_instructor')

@section('title', 'Buat Kursus Baru - IDEMY')
@section('page_title', 'Langkah 1: Detail Kursus')

@section('content')
    <div class="max-w-3xl mx-auto">
        {{-- Card Utama --}}
        <div class="bg-white border border-purple-50 shadow-xl shadow-purple-900/5 rounded-2xl p-12">
            <div class="mb-10">
                <p class="text-[10px] text-[#a435f0] font-bold uppercase tracking-widest mb-1">Pembuatan Kursus</p>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Tuliskan Detail Kursus Anda</h2>
            </div>
            
            <form action="{{ route('instructor.courses.save') }}" method="POST" class="space-y-8">
                @csrf
                
                {{-- Input Judul --}}
                <div>
                    <label class="block font-bold mb-2 text-[11px] uppercase tracking-widest text-gray-400">Judul Kursus</label>
                    <input type="text" name="title" required placeholder="Contoh: Belajar Web Design dari Nol" 
                           class="w-full p-4 border border-purple-100 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all font-semibold text-gray-700">
                </div>

                <div class="grid grid-cols-2 gap-8">
                    {{-- Input Kategori --}}
                    <div>
                        <label class="block font-bold mb-2 text-[11px] uppercase tracking-widest text-gray-400">Pilih Kategori</label>
                        <select name="category_id" required 
                                class="w-full p-4 border border-purple-100 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all bg-white font-semibold text-gray-700">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Input Harga --}}
                    <div>
                        <label class="block font-bold mb-2 text-[11px] uppercase tracking-widest text-gray-400">Harga (IDR)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 font-bold">Rp</span>
                            <input type="number" name="price" required placeholder="500000" 
                                   class="w-full pl-12 p-4 border border-purple-100 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all font-semibold text-gray-700">
                        </div>
                    </div>
                </div>

                {{-- Input Deskripsi --}}
                <div>
                    <label class="block font-bold mb-2 text-[11px] uppercase tracking-widest text-gray-400">Deskripsi Singkat</label>
                    <textarea name="description" rows="5" required placeholder="Apa yang akan dipelajari di kursus ini?" 
                              class="w-full p-4 border border-purple-100 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all resize-none font-medium text-gray-700"></textarea>
                </div>

                {{-- Footer Form / Aksi --}}
                <div class="flex justify-between items-center pt-10 border-t border-purple-50">
                    <a href="{{ route('instructor.dashboard') }}" 
                       class="font-bold text-gray-400 hover:text-red-500 transition-all uppercase text-[10px] tracking-widest flex items-center gap-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    
                    <button type="submit" 
                            class="bg-[#5624d0] text-white px-10 py-4 rounded-xl font-bold hover:bg-[#4c1da7] shadow-xl shadow-purple-100 transition-all active:scale-95 uppercase text-[10px] tracking-widest flex items-center gap-3">
                        Lanjutkan <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection