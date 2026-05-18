{{-- FAKTA PERBAIKAN 1: Ukuran lebar diubah menjadi responsif (w-full) agar fleksibel masuk ke dalam Grid System --}}
<div class="w-full flex flex-col cursor-pointer group/item snap-start relative bg-white rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
    <a href="{{ route('course.show', $course->id) }}" class="flex flex-col flex-grow">
        
        {{-- Wadah Thumbnail Gambar Kursus --}}
        <div class="aspect-video w-full bg-gray-100 overflow-hidden rounded-t-lg border-b border-gray-200">
            <img src="{{ $course->image_url }}" 
                 alt="{{ $course->title }}"
                 class="w-full h-full object-cover mb-2"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80';">
        </div>
             
        {{-- Konten Informasi Kelas --}}
        <div class="p-3 flex flex-col flex-grow">
            <h3 class="font-bold text-gray-900 text-sm leading-tight mb-1 group-hover/item:text-purple-700 h-10 overflow-hidden line-clamp-2">
                {{ $course->title }}
            </h3>
            <p class="text-[11px] text-gray-500 mb-2">Oleh {{ $course->user->name ?? 'Instruktur' }}</p>

            {{-- FAKTA PERBAIKAN 2: Menggunakan variabel agregat instan hasil optimasi eager loading Controller (Lebih Ringan) --}}
            @php 
                $avgRating = $course->reviews_avg_rating ?? 0; 
                $totalReviews = $course->reviews_count ?? 0;
            @endphp

            {{-- Baris Tampilan Rating Bintang --}}
            <div class="flex items-center gap-1 text-xs mb-2">
                <span class="font-bold text-yellow-700">
                    {{ number_format($avgRating, 1) }}
                </span>
                
                <div class="flex text-yellow-500 tracking-tighter text-xs">
                    {{-- Render Bintang sesuai rata-rata rating --}}
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= round($avgRating) ? '★' : '☆' }}
                    @endfor
                </div>
                
                <span class="text-gray-400 font-medium text-[11px]">({{ number_format($totalReviews, 0, ',', '.') }})</span>
            </div>
            
            {{-- Nominal Harga Komersial Kelas --}}
            <p class="font-black text-gray-900 text-base mt-auto">
                Rp{{ number_format($course->price, 0, ',', '.') }}
            </p>
        </div>
    </a>

    {{-- Pop-up Floating Detail Kanan (Muncul otomatis saat hover kursor mouse) --}}
    <div class="absolute top-0 left-full ml-3 w-[320px] bg-white border border-gray-200 rounded-lg shadow-2xl p-5 opacity-0 invisible group-hover/item:opacity-100 group-hover/item:visible transition-all duration-300 z-[100] pointer-events-none group-hover/item:pointer-events-auto hidden md:block">
        <h3 class="font-bold text-base text-gray-900 leading-tight mb-2">{{ $course->title }}</h3>
        <p class="text-[10px] text-green-700 font-black mb-3 uppercase tracking-wider">Diperbarui Mei 2026</p>
        
        <ul class="text-xs text-gray-600 mb-5 space-y-2 border-b border-gray-100 pb-4">
            <li class="flex items-center gap-2">
                <i class="fas fa-check text-green-600 text-[10px]"></i> Akses selamanya tanpa batas waktu
            </li>
            <li class="flex items-center gap-2">
                <i class="fas fa-check text-green-600 text-[10px]"></i> Sertifikat resmi kelulusan kompetensi
            </li>
            <li class="flex items-center gap-2">
                <i class="fas fa-check text-green-600 text-[10px]"></i> Kurikulum materi berkualitas tinggi
            </li>
        </ul>

        {{-- Form Aksi Instan Masuk ke Keranjang Belanja --}}
        <form action="{{ route('cart.add', $course->id) }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="w-full bg-[#a435f0] text-white py-3 font-bold text-xs uppercase tracking-widest hover:bg-[#8710d8] transition rounded-lg shadow-md active:scale-95 cursor-pointer">
                Tambahkan ke keranjang
            </button>
        </form>
    </div>
</div>