@extends('instructor.layout_instructor')

@section('title', 'Kelola Materi - ' . $course->title)
@section('page_title', 'Kurikulum') 

@section('content')
    {{-- Header Navigasi Kembali ke Katalog Utama --}}
    <div class="mb-10 flex items-center gap-5">
        <a href="{{ route('instructor.courses.index') }}" 
           class="w-10 h-10 bg-white border border-purple-100 rounded-xl flex items-center justify-center text-[#5624d0] hover:bg-[#5624d0] hover:text-white transition-all shadow-sm active:scale-95">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>
        <div>
            <p class="text-[10px] text-[#a435f0] font-bold uppercase tracking-widest mb-1">Sedang Mengedit Kurikulum</p>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ $course->title }}</h1>
        </div>
    </div>

    {{-- Layout Utama: Pembagian Grid 1:2 --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        {{-- BLOK KIRI: Formulir Input Penambahan Materi Bab Baru --}}
        <div class="lg:col-span-1">
            <div class="bg-white border border-purple-50 p-8 shadow-xl shadow-purple-900/5 rounded-2xl sticky top-6">
                <h3 class="font-bold text-gray-800 mb-6 border-b border-purple-50 pb-4 uppercase text-[11px] tracking-widest flex items-center gap-2">
                    <i class="fas fa-plus-circle text-[#5624d0]"></i> Input Materi Baru
                </h3>
                
                <form action="{{ route('instructor.lessons.store', $course->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-wider">Judul Bab</label>
                        <input type="text" name="title" 
                               class="w-full border border-purple-100 p-4 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all text-sm font-semibold text-gray-700" 
                               placeholder="Contoh: Pengenalan Database MySQL" required>
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-wider">Deskripsi Ringkas Bab</label>
                        <textarea name="content" 
                                  class="w-full border border-purple-100 p-4 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all text-sm h-32 font-medium text-gray-700 placeholder-gray-300" 
                                  placeholder="Masukkan ringkasan materi pembelajaran..." required></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-wider">Durasi (Dalam Satuan Menit)</label>
                        <input type="number" name="duration" min="1" placeholder="45"
                               class="w-full border border-purple-100 p-4 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all text-sm font-bold text-gray-700" 
                               required>
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#5624d0] text-white py-4 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-[#4c1da7] shadow-lg shadow-purple-100 transition-all active:scale-95 cursor-pointer flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i> Simpan Materi
                    </button>
                </form>
            </div>
        </div>

        {{-- BLOK KANAN: List Menampilkan Seluruh Materi yang Sudah Terdaftar --}}
        <div class="lg:col-span-2">
            <div class="bg-white border border-purple-50 shadow-xl shadow-purple-900/5 rounded-2xl overflow-hidden">
                <div class="bg-[#fcfaff] p-5 border-b border-purple-50 flex items-center justify-between">
                    <span class="font-bold text-xs uppercase tracking-widest text-[#5624d0]">Daftar Urutan Pelajaran</span>
                    <span class="bg-[#5624d0] text-white text-[10px] px-3 py-1 rounded-full font-bold shadow-sm">
                        {{ $course->lessons->count() }} Materi Terdaftar
                    </span>
                </div>

                <div class="divide-y divide-purple-50">
                    @forelse($course->lessons as $lesson)
                    <div class="p-6 flex items-center justify-between hover:bg-[#fcfaff] transition-all group">
                        <div class="flex items-center gap-5">
                            {{-- Indikator Ikon Pemutar Video --}}
                            <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center text-[#5624d0] group-hover:bg-[#5624d0] group-hover:text-white transition-all shadow-sm">
                                <i class="fas fa-play text-xs"></i>
                            </div>
                            <div>
                                <div class="font-bold text-gray-800 text-sm tracking-tight">{{ $lesson->title }}</div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase mt-1 flex items-center gap-2">
                                    <i class="far fa-clock text-[#a435f0]"></i> Durasi: {{ $lesson->duration }} Menit
                                </div>
                            </div>
                        </div>
                        
                        {{-- FAKTA PERBAIKAN: Tombol kosmetik sampah dibuang, diganti status validasi 'Aktif' murni database --}}
                        <div class="text-xs text-green-600 bg-green-50 px-2.5 py-1 rounded border border-green-100 font-bold uppercase tracking-wider scale-90">
                            Aktif
                        </div>
                    </div>
                    @empty
                    {{-- State Tampilan Jika Kursus Baru Belum Memiliki Materi Sama Sekali --}}
                    <div class="p-20 text-center">
                        <div class="flex justify-center text-purple-200 mb-4 text-5xl">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <p class="text-gray-400 text-sm font-medium">Belum ada materi pembelajaran. Silakan tambah data di form sisi kiri.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
@endsection