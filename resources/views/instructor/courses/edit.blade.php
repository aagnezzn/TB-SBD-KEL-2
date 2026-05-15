@extends('instructor.layout_instructor')

@section('title', 'Edit Kursus - ' . $course->title)
@section('page_title', 'Edit Mode') {{-- Muncul di header ungu atas --}}

@section('content')
    <form action="{{ route('instructor.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- Header Konten --}}
        <div class="flex justify-between items-center mb-10">
            <div>
                <p class="text-[10px] text-[#a435f0] font-bold uppercase tracking-widest mb-1">Manajemen Kursus</p>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Edit Kursus</h1>
            </div>
            {{-- Tombol Simpan: Ganti ke Ungu #5624d0 --}}
            <button type="submit" 
                    class="bg-[#5624d0] text-white px-8 py-4 rounded-xl font-bold text-sm hover:bg-[#4c1da7] shadow-xl shadow-purple-100 transition-all active:scale-95 flex items-center gap-2">
                <i class="fas fa-save"></i>
                Simpan Perubahan
            </button>
        </div>

        <div class="grid grid-cols-1 gap-8">
            {{-- Card Informasi Dasar --}}
            <div class="bg-white border border-purple-50 p-10 shadow-xl shadow-purple-900/5 rounded-2xl">
                <h3 class="font-bold text-gray-800 mb-8 border-b border-purple-50 pb-4 uppercase text-[11px] tracking-widest">Informasi Dasar</h3>
                
                <div class="grid grid-cols-2 gap-8">
                    {{-- Input Judul --}}
                    <div class="col-span-1">
                        <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Judul Kursus</label>
                        <input type="text" name="title" value="{{ $course->title }}" required 
                               class="w-full border border-purple-100 p-4 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all font-bold text-gray-700">
                    </div>

                    {{-- Input Kategori --}}
                    <div class="col-span-1">
                        <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Kategori</label>
                        <select name="category_id" required 
                                class="w-full border border-purple-100 p-4 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all font-bold text-gray-700 bg-white">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Input Deskripsi --}}
                    <div class="col-span-2">
                        <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Deskripsi</label>
                        <textarea name="description" rows="5" required 
                                  class="w-full border border-purple-100 p-4 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all font-bold text-gray-700">{{ $course->description }}</textarea>
                    </div>

                    {{-- Input Harga --}}
                    <div class="col-span-2">
                        <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Harga (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-gray-400">Rp</span>
                            <input type="number" name="price" value="{{ $course->price }}" required 
                                   class="w-full border border-purple-100 p-4 pl-12 rounded-xl outline-none focus:border-[#5624d0] focus:ring-4 focus:ring-purple-50 transition-all font-bold text-gray-700">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection