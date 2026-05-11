@extends('layouts.app')

@section('content')
{{-- Bagian Atas/Header --}}
<div class="bg-[#1c1d1f] text-white py-12">
    <div class="max-w-[1340px] mx-auto px-4 flex flex-col md:flex-row gap-8 relative">
        <div class="md:w-2/3 lg:w-3/5">
            <h1 class="text-3xl font-bold mb-4">{{ $course->title }}</h1>
            <p class="text-lg mb-4">{{ Str::limit($course->description, 150) }}</p>
            
            <div class="flex items-center space-x-2 mb-4 text-sm">
                <span class="text-[#f69c08] font-bold">{{ number_format($course->rating ?? 4.5, 1) }}</span>
                <div class="flex text-[#f69c08] space-x-0.5">★★★★★</div>
                <span class="text-[#c0c4fc] underline">({{ $course->reviews_count ?? 0 }} rating)</span>
                <span>{{ number_format($course->students_count ?? 1250, 0, ',', '.') }} siswa</span>
            </div>
            <p class="text-sm">Dibuat oleh <a href="#" class="text-[#c0c4fc] underline">{{ $course->user->name ?? 'Instruktur' }}</a></p>
        </div>
        
        {{-- Sidebar Kartu Putih --}}
        <div class="md:w-1/3 lg:w-[340px] md:absolute md:top-0 md:right-4 z-10">
            <div class="bg-white text-gray-900 border border-gray-200 shadow-xl">
                <div class="relative w-full h-[210px] bg-gray-100">
                    <img src="{{ $course->image_url ?? '/assets/images/education.jpg' }}" class="w-full h-full object-cover" alt="{{ $course->title }}">
                </div>
                <div class="p-6">
                    <div class="text-3xl font-bold mb-4">Rp{{ number_format($course->price, 0, ',', '.') }}</div>
                    <a href="{{ route('cart.add', $course->id) }}" class="w-full bg-[#a435f0] text-white font-bold py-3 mb-2 hover:bg-[#8710d8] transition block text-center">Tambahkan ke Keranjang</a>
                    <form action="{{ route('wishlist.add', $course->id) }}" method="POST">
                        @csrf
                            <button type="submit" class="w-full border border-black py-3 font-bold hover:bg-gray-100 transition">
                                Masukkan ke Daftar Keinginan
                            </button>
                    </form>
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

{{-- Bagian Bawah --}}
<div class="max-w-[1340px] mx-auto px-4 py-8">
    <div class="md:w-2/3 lg:w-3/5">
        <div class="border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-900">Apa yang akan Anda pelajari</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-gray-700">
                <div>✓ Kurikulum standar industri.</div>
                <div>✓ Pemahaman konsep dari nol.</div>
                <div>✓ Praktek langsung dengan studi kasus.</div>
                <div>✓ Akses materi kapan saja.</div>
            </div>
        </div>

        <h2 class="text-xl font-bold mb-4 text-gray-900">Konten Kursus</h2>
        <div class="border border-gray-200 mb-8 text-sm">
            <div class="bg-gray-50 p-4 border-b border-gray-200 font-bold flex justify-between">
                <span>Kurikulum Dasar</span>
                <span class="text-gray-600 font-normal">{{ $course->lessons->count() }} kuliah</span>
            </div>
            @forelse($course->lessons as $lesson)
                <div class="p-4 flex justify-between items-center text-gray-700 border-b border-gray-200 last:border-b-0">
                    <span>📄 {{ $lesson->title }}</span>
                    <span class="text-gray-500">{{ $lesson->duration }}:00</span>
                </div>
            @empty
                <div class="p-4 text-center">Belum ada materi.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection