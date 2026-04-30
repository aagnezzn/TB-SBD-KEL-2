@extends('layouts.app')
@section('content') 
    <div class="relative bg-[#e5e7eb] overflow-hidden">
        <div class="max-w-[1340px] mx-auto px-6 lg:px-10 flex flex-col md:flex-row items-center min-h-[450px]">
            
            <!-- Sisi Kiri: Teks -->
            <div class="w-full md:w-1/2 py-12 md:py-0 z-10">
                <h1 class="text-[40px] md:text-[52px] font-bold text-[#2d2f31] leading-tight font-serif">
                    Mengajarlah <br> bersama kami
                </h1>
                <p class="mt-4 text-lg text-[#2d2f31] max-w-sm">
                    Jadilah instruktur dan ubah hidup — termasuk hidup Anda sendiri
                </p>
                
                <a href="/register" 
                   class="inline-block mt-8 bg-[#2d2f31] text-white px-10 py-4 font-bold hover:bg-gray-800 transition shadow-sm text-center min-w-[200px]">
                    Memulai
                </a>
            </div>

            <!-- Sisi Kanan: Gambar -->
            <div class="w-full md:w-1/2 relative flex justify-end items-end h-full">
                <img src="{{ asset('mengejar.png') }}" 
                     alt="Instruktur Idemy" 
                     class="w-full h-auto max-h-[500px] object-cover object-top">
            </div>
        </div>
    </div>
    
    <!-- Lanjutkan ke section berikutnya... -->
    
<div class="max-w-[1340px] mx-auto pt-10 pb-12 px-6 lg:px-10">
    <h2 class="text-[28px] md:text-[36px] font-bold text-center text-[#2d2f31] mb-8 font-serif tracking-tight leading-tight">
        Begitu banyak alasan untuk memulai
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 justify-center text-center max-w-[1100px] mx-auto">
        <div class="flex flex-col items-center">
            <div class="h-[80px] flex items-center justify-center mb-4">
                <img src="{{ asset('ajari.webp') }}" class="w-14 h-14 object-contain">
            </div>
            <h3 class="text-[15px] font-bold mb-2 text-[#2d2f31]">Ajari Jalan Anda</h3>
            <p class="text-[#2d2f31] text-[13px] leading-relaxed max-w-[220px] opacity-90">
                Publikasikan kursus yang Anda inginkan, dengan cara yang Anda inginkan, dan selalu kontrol konten Anda sendiri.
            </p>
        </div>

        <div class="flex flex-col items-center">
            <div class="h-[80px] flex items-center justify-center mb-4">
                <img src="{{ asset('inspirasi.webp') }}" class="w-14 h-14 object-contain">
            </div>
            <h3 class="text-[15px] font-bold mb-2 text-[#2d2f31]">Inspirasi orang yang ingin belajar</h3>
            <p class="text-[#2d2f31] text-[13px] leading-relaxed max-w-[220px] opacity-90">
                Ajarkan yang Anda ketahui dan bantu orang yang ingin belajar menjelajahi minat mereka, mendapatkan skill baru.
            </p>
        </div>

        <div class="flex flex-col items-center">
            <div class="h-[80px] flex items-center justify-center mb-4">
                <img src="{{ asset('hadiah.webp') }}" class="w-14 h-14 object-contain">
            </div>
            <h3 class="text-[15px] font-bold mb-2 text-[#2d2f31]">Dapatkan hadiah</h3>
            <p class="text-[#2d2f31] text-[13px] leading-relaxed max-w-[220px] opacity-90">
                Perluas jaringan profesional Anda, bangun keahlian Anda, dan dapatkan uang untuk setiap pendaftaran berbayar.
            </p>
        </div>
    </div>
</div>
@endsection