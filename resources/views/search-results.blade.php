@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 font-sans text-[#1c1d1f] min-h-[65vh]">
    {{-- Header Hasil Pencarian --}}
    <div class="mb-10 border-b border-gray-200 pb-6">
        <h1 class="text-2xl font-black text-gray-900 tracking-tight">
            Hasil Pencarian untuk: <span class="text-[#a435f0]">"{{ $keyword }}"</span>
        </h1>
        <p class="text-gray-500 text-sm mt-1 font-medium">
            Ditemukan {{ $courses->count() }} kursus yang cocok dengan kata kunci Anda.
        </p>
    </div>

    @if($courses->isEmpty())
        {{-- State Tampilan Jika Kata Kunci Tidak Cocok Dengan Judul/Deskripsi di DB --}}
        <div class="text-center py-20 border border-dashed rounded-2xl bg-white p-8 max-w-2xl mx-auto">
            <h2 class="text-xl font-bold text-gray-800">Maaf, kami tidak menemukan hasil untuk "{{ $keyword }}"</h2>
            <p class="text-gray-500 text-sm mt-2 max-w-md mx-auto font-medium">Coba gunakan kata kunci lain yang lebih umum, seperti nama instruktur, atau rumpun teknologi spesifik (misal: Laravel, Tailwind).</p>
            <a href="/" class="mt-6 inline-block bg-[#a435f0] text-white px-8 py-3.5 font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-[#8710d8] transition-all shadow-md active:scale-95">
                Kembali ke Beranda
            </a>
        </div>
    @else
        {{-- List Katalog Hasil Pencarian --}}
        <div class="flex flex-col space-y-6 max-w-5xl">
            @foreach($courses as $course)
                <div class="flex flex-col sm:flex-row bg-white border border-gray-200 rounded-xl p-5 gap-6 group hover:shadow-md transition-all duration-200 relative">
                    
                    {{-- Thumbnail Kelas --}}
                    <div class="w-full sm:w-48 aspect-video bg-gray-100 overflow-hidden rounded-lg shrink-0 border">
                        <img src="{{ $course->image_url }}" alt="{{ $course->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80';">
                    </div>
                    
                    {{-- Detail Deskripsi Informasi Kelas --}}
                    <div class="flex flex-col justify-between grow">
                        {{-- FAKTA PERBAIKAN: Rute diperbaiki menggunakan Named Route agar fungsional bisa dibuka --}}
                        <a href="{{ route('course.show', $course->id) }}" class="block space-y-1 group-hover:text-purple-700">
                            <h3 class="text-lg font-extrabold text-gray-900 group-hover:text-[#5624d0] transition-colors leading-snug">
                                {{ $course->title }}
                            </h3>
                            <p class="text-sm text-gray-500 line-clamp-2 font-medium">
                                {{ $course->description ?? 'Pelajari keahlian baru secara komprehensif bersama instruktur berpengalaman di bidangnya.' }}
                            </p>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-tight pt-1">
                                Oleh: {{ $course->user->name ?? 'Instruktur Idemy' }}
                            </p>
                        </a>

                        {{-- Harga Komersial Kelas --}}
                        <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-50">
                            <span class="text-xl font-black text-gray-900 tracking-tight">
                                Rp{{ number_format($course->price, 0, ',', '.') }}
                            </span>
                            
                            <a href="{{ route('course.show', $course->id) }}" class="text-xs font-bold uppercase tracking-wider text-purple-600 hover:text-purple-900 flex items-center gap-1">
                                Lihat Detail Kelas <i class="fas fa-chevron-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection