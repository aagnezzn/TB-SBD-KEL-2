@extends('layouts.app')

@section('content')
<!-- Hero Section (Bagian Atas Gelap) -->
<div class="bg-[#1c1d1f] text-white py-12">
    <div class="max-w-[1340px] mx-auto px-4 flex flex-col md:flex-row gap-8 relative">
        <!-- Info Utama Kursus -->
        <div class="md:w-2/3 lg:w-3/5">
            <h1 class="text-3xl font-bold mb-4">{{ $course->title }}</h1>
            <p class="text-lg mb-4">Pelajari materi ini dari nol sampai mahir dengan kurikulum standar industri dan studi kasus dunia nyata.</p>
            
            <div class="flex items-center space-x-2 mb-4 text-sm">
                <span class="text-[#f69c08] font-bold">{{ $course->rating }}</span>
                <div class="flex text-[#f69c08] space-x-0.5">
                    ★★★★★
                </div>
                <span class="text-[#c0c4fc] underline">({{ $course->reviews }} rating)</span>
                <span>10.500 siswa</span>
            </div>
            
            <p class="text-sm">Dibuat oleh <a href="#" class="text-[#c0c4fc] underline">{{ $course->author }}</a></p>
        </div>
        
        <!-- Sidebar Beli (Kotak Mengambang) -->
        <div class="md:w-1/3 lg:w-[340px] md:absolute md:top-0 md:right-4 z-10">
            <div class="bg-white text-gray-900 border border-gray-200 shadow-xl">
                <!-- Kalau di HP gambarnya di atas, kalau di Laptop gambarnya di dalam kotak -->
                <img src="{{ $course->img }}" class="w-full hidden md:block border-b border-gray-200">
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
                        <li>✓ Video on-demand 40 jam</li>
                        <li>✓ 15 artikel bacaan</li>
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
                <div class="flex gap-3"><span class="text-gray-900">✓</span> Membangun aplikasi web full-stack siap kerja.</div>
                <div class="flex gap-3"><span class="text-gray-900">✓</span> Memahami alur database relasional MySQL.</div>
                <div class="flex gap-3"><span class="text-gray-900">✓</span> Membuat UI responsif dengan Tailwind CSS.</div>
                <div class="flex gap-3"><span class="text-gray-900">✓</span> Keamanan data dan sistem login/register.</div>
            </div>
        </div>

        <!-- Silabus / Konten Kursus -->
        <h2 class="text-xl font-bold mb-4 text-gray-900">Konten Kursus</h2>
        <p class="text-sm text-gray-600 mb-2">1 bagian • 2 kuliah • durasi total 45 mnt</p>
        <div class="border border-gray-200 mb-8 text-sm">
            <div class="bg-gray-50 p-4 border-b border-gray-200 font-bold flex justify-between cursor-pointer hover:bg-gray-100">
                <span>Bagian 1: Pengenalan & Persiapan</span>
                <span class="text-gray-600 font-normal">2 kuliah • 45 mnt</span>
            </div>
            <div class="p-4 flex justify-between items-center text-gray-700 border-b border-gray-200">
                <div class="flex items-center gap-3"><span class="text-gray-400">▶</span> Apa itu Framework?</div>
                <span class="text-gray-500">10:00</span>
            </div>
            <div class="p-4 flex justify-between items-center text-gray-700">
                <div class="flex items-center gap-3"><span class="text-gray-400">▶</span> Instalasi VS Code dan XAMPP</div>
                <span class="text-gray-500">35:00</span>
            </div>
        </div>

        <!-- Persyaratan -->
        <h2 class="text-xl font-bold mb-4 text-gray-900">Persyaratan</h2>
        <ul class="list-disc pl-5 mb-8 text-sm text-gray-700 space-y-1">
            <li>Komputer PC atau Laptop (Windows, Mac, atau Linux).</li>
            <li>Koneksi internet yang stabil untuk menonton video.</li>
            <li>Tidak butuh pengalaman coding, akan diajarkan dari nol.</li>
        </ul>

        <!-- Deskripsi -->
        <h2 class="text-xl font-bold mb-4 text-gray-900">Deskripsi</h2>
        <div class="text-sm text-gray-700 space-y-4">
            <p>Selamat datang di kursus paling komprehensif untuk belajar pengembangan web. Di era digital ini, memiliki skill membuat website adalah nilai plus yang sangat dicari oleh banyak perusahaan.</p>
            <p>Kursus ini dirancang khusus untuk pemula hingga menengah. Kita tidak hanya belajar teori, tapi juga langsung praktik membuat sistem e-learning layaknya platform besar.</p>
        </div>
        
    </div>
</div>
@endsection