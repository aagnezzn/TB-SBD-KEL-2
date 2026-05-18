@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 font-sans text-[#1c1d1f] min-h-[65vh]">
    
    {{-- 1. HEADER INFORMASI NAMA KATEGORI --}}
    <div class="mb-10 border-b border-gray-200 pb-6">
        <p class="text-[11px] font-black uppercase text-purple-600 tracking-widest mb-1">Kategori Kursus Idemy</p>
        <h1 class="text-3xl font-black text-gray-900 tracking-tight capitalize">
            Topik Pembelajaran: <span class="text-purple-700">"{{ $category->name }}"</span>
        </h1>
        <p class="text-gray-500 text-sm mt-1 font-medium">
            Menampilkan data kursus hasil seleksi filter kategori.
        </p>
    </div>

    {{-- 2. LOGIKA KONDISIONAL CHECK KURSUS (AMANKAN DARI EROR BLADE) --}}
    @if($courses->isEmpty())
        {{-- Tampilan Jika Data Hasil Seeder CSV Kategori Ini Kosong --}}
        <div class="text-center py-20 border border-dashed rounded-2xl bg-white p-8 max-w-2xl mx-auto">
            <h2 class="text-xl font-bold text-gray-800">Belum ada kursus untuk kategori "{{ $category->name }}"</h2>
            <p class="text-gray-500 text-sm mt-2 max-w-md mx-auto font-medium">Saat ini para instruktur kami sedang menyusun kurikulum baru untuk topik ini. Silakan jelajahi kategori populer lainnya di halaman depan.</p>
            <a href="/" class="mt-6 inline-block bg-[#a435f0] text-white px-8 py-3.5 font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-[#8710d8] transition-all shadow-md active:scale-95">
                Kembali ke Beranda
            </a>
        </div>
    @else
        {{-- 3. TAMPILAN GRID KURSUS KATALOG (SINKRON DENGAN SEEDER CSV) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach($courses as $course)
                @include('partials.course-card', ['course' => $course])
            @endforeach
        </div>

        {{-- 4. NAVIGASI LINKS LINKS PAGINATION HALAMAN --}}
        <div class="mt-12 flex justify-center">
            {{ $courses->links() }}
        </div>
    @endif

</div>
@endsection