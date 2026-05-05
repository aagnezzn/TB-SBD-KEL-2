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
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($courses as $course)
                <div class="border border-gray-200 hover:shadow-lg transition duration-200 flex flex-col h-full">
                    <a href="/course/{{ $course->id }}" class="flex-grow">
                        <!-- Thumbnail (Ganti dengan asset kamu) -->
                        <img src="https://via.placeholder.com/300x150" alt="{{ $course->title }}" class="w-full h-40 object-cover">
                        
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 leading-snug mb-1 line-clamp-2">
                                {{ $course->title }}
                            </h3>
                            
                            <!-- Menampilkan Nama Instruktur (Relasi User) -->
                            <p class="text-xs text-gray-600 mb-1">
                                {{ $course->user->name ?? 'Instruktur Anonim' }}
                            </p>

                            <!-- Harga -->
                            <div class="flex items-center gap-2 mt-2">
                                <span class="font-bold text-gray-900">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection