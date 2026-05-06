@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Header Hasil Pencarian -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">
            Hasil Pencarian untuk: <span class="text-[#a435f0]">"{{ $keyword }}"</span>
        </h1>
        <p class="text-gray-600">
            Ditemukan {{ $courses->count() }} kursus yang cocok.
        </p>
    </div>

    <!-- Cek apakah ada data atau kosong -->
    @if($courses->isEmpty())
        <div class="text-center py-20">
            <img src="{{ asset('no-results.png') }}" alt="Tidak ditemukan" class="mx-auto w-48 mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Maaf, kami tidak menemukan hasil untuk "{{ $keyword }}"</h2>
            <p class="text-gray-600 mt-2">Coba kata kunci lain, seperti nama instruktur atau judul materi yang lebih umum.</p>
            <a href="/" class="mt-6 inline-block bg-[#a435f0] text-white px-6 py-3 font-bold hover:bg-[#8710d8]">
                Kembali ke Beranda
            </a>
        </div>
    @else
        <!-- Grid Daftar Kursus -->
<!-- Daftar Hasil Pencarian (Layout List ala Udemy) -->
<div class="flex flex-col space-y-6">
    @foreach($courses as $course)
        <div class="flex flex-col md:flex-row border-b border-gray-200 pb-6 gap-6 group">
            <!-- Thumbnail Otomatis: Biar Dummy tapi Berisi -->
            <div class="w-full md:w-64 h-36 shrink-0 bg-gray-100 overflow-hidden border border-gray-200">
                <!-- Thumbnail Dinamis: Mengikuti kategori kursus agar gambarnya nyambung -->
                <!-- Thumbnail Dinamis dengan Anti-Gagal (Fallback) -->
                <img src="https://loremflickr.com/320/180/{{ $course->category->name ?? 'education' }}?random={{ $course->id }}" 
                alt="{{ $course->title }}" 
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                onerror="this.onerror=null;this.src='https://picsum.photos/seed/{{ $course->id }}/320/180';">
            </div>
            
            <div class="flex flex-col justify-between grow">
                <a href="/course/{{ $course->id }}">
                    <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-[#5624d0]">
                        {{ $course->title }}
                    </h3>
                    <p class="text-sm text-gray-600 line-clamp-2 mb-2">
                        {{ $course->description ?? 'Pelajari keahlian baru dengan kursus komprehensif ini.' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $course->user->name ?? 'Instruktur Anonim' }}
                    </p>
                </a>

                <div class="flex items-center justify-between mt-4">
                    <span class="text-xl font-bold text-gray-900">
                        Rp{{ number_format($course->price, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach
</div>
    @endif
</div>
@endsection