@extends('instructor.layout_instructor')

@section('title', 'Kelola Materi - ' . $course->title)
@section('page_title', 'Kurikulum') 

@section('content')
    {{-- Header Judul Kursus --}}
    <div class="mb-10 flex items-center gap-5">
        <a href="{{ route('instructor.courses.index') }}" class="w-10 h-10 bg-white border border-purple-100 rounded-xl flex items-center justify-center text-[#5624d0] hover:bg-[#5624d0] hover:text-white transition-all shadow-sm">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>
        <div>
            <p class="text-[10px] text-[#a435f0] font-bold uppercase tracking-widest mb-1">Sedang Mengedit</p>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ $course->title }}</h1>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-10">
        {{-- KIRI: Form Input Materi --}}
        <div class="col-span-1">
            <div class="bg-white border border-purple-50 p-8 shadow-xl shadow-purple-900/5 rounded-2xl">
                <h3 class="font-bold text-gray-800 mb-6 border-b border-purple-50 pb-4 uppercase text-[11px] tracking-widest">Input Materi Baru</h3>
                
                <form action="{{ route('instructor.lessons.store', $course->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Judul Bab</label>
                        <input type="text" name="title" 
                               class="w-full border border-purple-100 p-4 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all text-sm" 
                               placeholder="Contoh: Pengenalan Laravel" required>
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Deskripsi Bab</label>
                        <textarea name="content" 
                                  class="w-full border border-purple-100 p-4 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all text-sm h-32" 
                                  placeholder="Masukkan penjelasan materi..." required></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Durasi (Menit)</label>
                        <input type="number" name="duration" 
                               class="w-full border border-purple-100 p-4 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all text-sm" 
                               required>
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#5624d0] text-white py-4 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-[#4c1da7] shadow-lg shadow-purple-100 transition-all active:scale-95">
                        Simpan Materi
                    </button>
                </form>
            </div>
        </div>

        {{-- KANAN: Daftar Pelajaran --}}
        <div class="col-span-2">
            <div class="bg-white border border-purple-50 shadow-xl shadow-purple-900/5 rounded-2xl overflow-hidden">
                <div class="bg-[#fcfaff] p-5 border-b border-purple-50 flex items-center justify-between">
                    <span class="font-bold text-xs uppercase tracking-widest text-[#5624d0]">Daftar Pelajaran</span>
                    <span class="bg-[#5624d0] text-white text-[10px] px-3 py-1 rounded-full font-bold">{{ $course->lessons->count() }} Materi</span>
                </div>

                <div class="divide-y divide-purple-50">
                    @forelse($course->lessons as $lesson)
                    <div class="p-6 flex items-center justify-between hover:bg-[#fcfaff] transition-all group">
                        <div class="flex items-center gap-5">
                            <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center text-[#5624d0] group-hover:bg-[#5624d0] group-hover:text-white transition-all">
                                <i class="fas fa-play text-xs"></i>
                            </div>
                            <div>
                                <div class="font-bold text-gray-800 text-sm">{{ $lesson->title }}</div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase mt-1 flex items-center gap-2">
                                    <i class="far fa-clock text-[#a435f0]"></i> {{ $lesson->duration }} Menit
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <button class="w-9 h-9 flex items-center justify-center text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="p-20 text-center">
                        <i class="fas fa-book-open text-4xl text-purple-100 mb-4"></i>
                        <p class="text-gray-400 text-sm font-medium">Belum ada materi. Silakan tambah di form kiri.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection