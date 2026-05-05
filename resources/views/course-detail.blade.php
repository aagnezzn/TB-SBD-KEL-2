@extends('layouts.app')

@section('content')
<!-- Hero Section (Bagian Atas Gelap) -->
<div class="bg-[#1c1d1f] text-white py-12">
    <div class="max-w-[1340px] mx-auto px-4 flex flex-col md:flex-row gap-8 relative">
        <!-- Info Utama Kursus -->
        <div class="md:w-2/3 lg:w-3/5">
            <h1 class="text-3xl font-bold mb-4">{{ $course->title }}</h1>
            
            {{-- Mengambil deskripsi singkat atau potongan deskripsi --}}
            <p class="text-lg mb-4">{{ Str::limit($course->description, 150) }}</p>
            
            <div class="flex items-center space-x-2 mb-4 text-sm">
                <span class="text-[#f69c08] font-bold">{{ number_format($course->rating ?? 4.5, 1) }}</span>
                <div class="flex text-[#f69c08] space-x-0.5">
                    ★★★★★
                </div>
                <span class="text-[#c0c4fc] underline">({{ $course->reviews_count ?? 0 }} rating)</span>
                <span>{{ number_format($course->students_count ?? 1250, 0, ',', '.') }} siswa</span>
            </div>
            
            <p class="text-sm">Dibuat oleh <a href="#" class="text-[#c0c4fc] underline">{{ $course->user->name ?? 'Instruktur' }}</a></p>
        </div>
        
<!-- Sidebar Beli (Kotak Mengambang) -->
<div class="md:w-1/3 lg:w-[340px] md:absolute md:top-0 md:right-4 z-10">
    <div class="bg-white text-gray-900 border border-gray-200 shadow-xl">
        
        <!-- Bagian Video di Sidebar -->
<div class="relative w-full h-[210px] bg-black">
    {{-- Kita ambil video dari lesson pertama yang punya course_id ini --}}
    @if($course->lessons->isNotEmpty())
        <iframe 
            class="w-full h-full"
            src="{{ $course->lessons->first()->video_url }}" 
            title="YouTube video player" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            allowfullscreen>
        </iframe>
    @else
        {{-- Jika kursus ini belum punya materi/lesson sama sekali --}}
        <img src="https://via.placeholder.com/340x200" class="w-full h-full object-cover" alt="No Video Available">
    @endif
</div>

        <div class="p-6">
            <div class="text-3xl font-bold mb-4">Rp{{ number_format($course->price, 0, ',', '.') }}</div>
            
            <button class="w-full bg-[#a435f0] text-white font-bold py-3 mb-2 hover:bg-[#8710d8] transition">
                Tambahkan ke Keranjang
            </button>
            <button class="w-full bg-white text-gray-900 border border-gray-900 font-bold py-3 hover:bg-gray-100 transition mb-4">
                Beli Sekarang
            </button>
            
            <p class="text-xs text-center text-gray-500 mb-4">Garansi uang kembali 30 hari</p>
            
            <h4 class="font-bold text-sm mb-2">Kursus ini mencakup:</h4>
            <ul class="text-sm text-gray-600 space-y-2">
                <li>✓ Video on-demand {{ $course->lessons->sum('duration') }} menit</li>
                <li>✓ {{ $course->lessons->count() }} materi pelajaran</li>
                <li>✓ Akses seumur hidup</li>
                <li>✓ Sertifikat penyelesaian</li>
            </ul>
        </div>
    </div>
</div>
    </div>
</div>

<!-- Main Content (Bagian Putih Bawah) -->
<div class="max-w-[1340px] mx-auto px-4 py-8 flex flex-col md:flex-row gap-8">
    <div class="md:w-2/3 lg:w-3/5">
        
        <!-- Apa yang dipelajari -->
        <div class="border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-900">Apa yang akan Anda pelajari</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-gray-700">
                <div class="flex gap-3"><span class="text-gray-900">✓</span> Kurikulum standar industri.</div>
                <div class="flex gap-3"><span class="text-gray-900">✓</span> Pemahaman konsep dari nol.</div>
                <div class="flex gap-3"><span class="text-gray-900">✓</span> Praktek langsung dengan studi kasus.</div>
                <div class="flex gap-3"><span class="text-gray-900">✓</span> Akses materi kapan saja dan di mana saja.</div>
            </div>
        </div>

        <!-- Silabus / Konten Kursus NYAMBUNG KE TABEL LESSONS -->
        <h2 class="text-xl font-bold mb-4 text-gray-900">Konten Kursus</h2>
        <p class="text-sm text-gray-600 mb-2">
            1 bagian • {{ $course->lessons->count() }} kuliah • durasi total {{ $course->lessons->sum('duration') }} mnt
        </p>
        
        <div class="border border-gray-200 mb-8 text-sm">
            <div class="bg-gray-50 p-4 border-b border-gray-200 font-bold flex justify-between">
                <span>Kurikulum Dasar</span>
                <span class="text-gray-600 font-normal">{{ $course->lessons->count() }} kuliah • {{ $course->lessons->sum('duration') }} mnt</span>
            </div>

            {{-- LOOPING DATA LESSONS DARI DATABASE --}}
            @forelse($course->lessons as $lesson)
                <div class="p-4 flex justify-between items-center text-gray-700 border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <span class="text-gray-400">▶</span> 
                        {{ $lesson->title }}
                    </div>
                    <span class="text-gray-500">{{ $lesson->duration }}:00</span>
                </div>
            @empty
                <div class="p-4 text-center text-gray-500">Belum ada materi untuk kursus ini.</div>
            @endforelse
        </div>

        <!-- Persyaratan -->
        <h2 class="text-xl font-bold mb-4 text-gray-900">Persyaratan</h2>
        <ul class="list-disc pl-5 mb-8 text-sm text-gray-700 space-y-1">
            <li>Komputer PC atau Laptop.</li>
            <li>Koneksi internet yang stabil.</li>
            <li>Keinginan belajar yang kuat.</li>
        </ul>

        <!-- Deskripsi NYAMBUNG KE DATABASE -->
        <h2 class="text-xl font-bold mb-4 text-gray-900">Deskripsi</h2>
        <div class="text-sm text-gray-700 space-y-4">
            {!! nl2br(e($course->description)) !!}
        </div>
        
    </div>
</div>
@endsection