@extends('layouts.app')

@section('content')
{{-- Bagian Atas/Header --}}
<div class="bg-[#1c1d1f] text-white py-12">
    <div class="max-w-[1340px] mx-auto px-4 flex flex-col md:flex-row gap-8 relative">
        <div class="md:w-2/3 lg:w-3/5">
            <h1 class="text-3xl font-bold mb-4">{{ $course->title }}</h1>
            <p class="text-lg mb-4">{{ Str::limit($course->description, 150) }}</p>
            
            <div class="flex items-center space-x-2 mb-4 text-sm">
                {{-- Logika Rating Dinamis --}}
                @php 
                    $avgRating = $course->reviews->avg('rating') ?? 0; 
                    $totalReviews = $course->reviews->count();
                @endphp

                <span class="text-[#f69c08] font-bold">{{ number_format($avgRating, 1) }}</span>
                <div class="flex text-[#f69c08] space-x-0.5">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= round($avgRating) ? '★' : '☆' }}
                    @endfor
                </div>
                <span class="text-[#c0c4fc] underline">({{ $totalReviews }} rating)</span>
                
                {{-- Jumlah Siswa dari Tabel Enrollments --}}
                <span>{{ number_format($course->enrollments->count(), 0, ',', '.') }} siswa</span>
            </div>
            <p class="text-sm">Dibuat oleh <a href="#" class="text-[#c0c4fc] underline">{{ $course->user->name ?? 'Instruktur' }}</a></p>
        </div>
        
        {{-- Sidebar Kartu Putih --}}
        <div class="md:w-1/3 lg:w-[350px] bg-white text-gray-900 border border-gray-200 shadow-lg p-6 md:absolute md:right-4 md:top-12 z-10">
            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-44 object-cover mb-4 rounded">
            <div class="text-3xl font-bold mb-4">Rp {{ number_format($course->price, 0, ',', '.') }}</div>
            
            {{-- Form Tambah ke Keranjang --}}
            <form action="{{ route('cart.add', $course->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-[#a435f0] text-white py-3 font-bold hover:bg-[#8710d8] transition mb-3">
                    Tambahkan ke keranjang
                </button>
            </form>

            <form action="{{ route('wishlist.add', $course->id) }}" method="POST">
                        @csrf
                            <button type="submit" class="w-full border border-black py-3 font-bold hover:bg-gray-100 transition">
                                Masukkan ke Daftar Keinginan
                            </button>
                    </form>
            
            <div class="text-xs text-center text-gray-600 mb-6">Jaminan uang kembali 30 hari</div>
            
            <div class="text-sm">
                <div class="font-bold mb-2">Kursus ini mencakup:</div>
                <ul class="space-y-2 text-gray-700">
                    <li>✓ Video sesuai permintaan</li>
                    <li>✓ Akses seumur hidup penuh</li>
                    <li>✓ Akses di perangkat seluler dan TV</li>
                    <li>✓ Sertifikat penyelesaian</li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Bagian Bawah Konten --}}
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
            <div class="bg-gray-50 p-4 border-b border-gray-200 font-bold flex justify-between text-gray-900">
                <span>Kurikulum Dasar</span>
                <span class="text-gray-600 font-normal">{{ $course->lessons->count() }} kuliah</span>
            </div>
            @forelse($course->lessons as $lesson)
                <div class="p-4 flex justify-between items-center text-gray-700 border-b border-gray-200 last:border-b-0">
                    <span>📄 {{ $lesson->title }}</span>
                    <span class="text-[#a435f0] text-xs font-bold cursor-pointer underline">Pratinjau</span>
                </div>
            @empty
                <div class="p-4 text-gray-500 italic">Belum ada materi untuk kursus ini.</div>
            @endforelse
        </div>

        {{-- Bagian Review/Ulasan --}}
        <div class="mt-12 border-t border-gray-200 pt-10">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                <span class="text-[#f69c08]">★</span> 
                {{ number_format($avgRating, 1) }} Peringkat Kursus 
                <span class="text-gray-400 text-base">• {{ $totalReviews }} Peringkat</span>
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                @forelse($course->reviews as $review)
                    <div class="border-t border-gray-100 pt-6">
                        <div class="flex items-start gap-4 text-sm">
                            <div class="w-11 h-11 rounded-full bg-[#1c1d1f] text-white flex items-center justify-center font-bold flex-shrink-0">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            
                            <div class="flex-1">
                                <div class="mb-1">
                                    <h4 class="font-bold text-gray-900">{{ $review->user->name }}</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <div class="flex text-[#f69c08] text-xs">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $review->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                
                                <p class="text-gray-700 leading-relaxed mt-2">
                                    {{ $review->comment }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 py-8 text-center bg-gray-50 rounded-lg">
                        <p class="text-gray-500 italic">Belum ada ulasan untuk kursus ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection