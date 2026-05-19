{{-- FAKTA PERBAIKAN 1: Ukuran lebar diubah menjadi responsif (w-full) agar fleksibel masuk ke dalam Grid System --}}
<div class="w-full flex flex-col cursor-pointer group/item snap-start relative bg-white rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
    <a href="{{ route('course.show', $course->id) }}" class="flex flex-col flex-grow">
        
        {{-- Wadah Thumbnail Gambar Kursus --}}
        <div class="aspect-video w-full bg-gray-100 overflow-hidden rounded-t-lg border-b border-gray-200">
            <img src="{{ $course->image_url }}" 
                alt="{{ $course->title }}" 
                class="w-full h-full object-cover mb-2 rounded-t-lg"
                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80';">
        </div>
             
        {{-- Konten Informasi Kelas --}}
        <div class="p-3 flex flex-col flex-grow">
            <h3 class="font-bold text-gray-900 text-sm leading-tight mb-1 group-hover/item:text-purple-700 h-10 overflow-hidden line-clamp-2">
                {{ $course->title }}
            </h3>
            
            <p class="text-[11px] text-gray-500 mb-1 truncate">{{ $course->user->name ?? 'Instruktur' }}</p>

            {{-- FAKTA PERBAIKAN 2: Menggunakan variabel agregat instan hasil optimasi Eager Loading --}}
            @php 
                $avgRating = $course->reviews_avg_rating ?? 0; 
                $totalReviews = $course->reviews_count ?? 0; 
            @endphp

            <div class="flex items-center gap-1.5 mb-1.5 mt-auto">
                <span class="font-bold text-gray-800 text-sm">{{ number_format($avgRating, 1) }}</span>
                <div class="flex text-[#b4690e] text-[10px]">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($avgRating))
                            <i class="fas fa-star"></i>
                        @elseif ($i == ceil($avgRating) && $avgRating - floor($avgRating) >= 0.5)
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="text-gray-400 font-medium text-[11px]">({{ number_format($totalReviews, 0, ',', '.') }})</span>
            </div>

            <div class="font-bold text-gray-900 text-[15px]">
                Rp{{ number_format($course->price ?? 0, 0, ',', '.') }}
            </div>
        </div>
    </a>

    {{-- Hover Pop-up Informasi Kelas --}}
    <div class="absolute left-full top-0 ml-4 w-80 bg-white border border-gray-200 shadow-2xl rounded-xl p-5 opacity-0 invisible group-hover/item:opacity-100 group-hover/item:visible transition-all duration-300 z-[100] pointer-events-none group-hover/item:pointer-events-auto hidden md:block">
        <h3 class="font-bold text-base text-gray-900 leading-tight mb-2">{{ $course->title }}</h3>
        <p class="text-[10px] text-green-700 font-black mb-3 uppercase tracking-wider">{{ __('welcome.Diperbarui') }}</p>
        
        <ul class="text-xs text-gray-600 mb-5 space-y-2 border-b border-gray-100 pb-4">
            <li class="flex items-center gap-2">
                <i class="fas fa-check text-green-600 text-[10px]"></i> {{ __('welcome.Akses') }}
            </li>
            <li class="flex items-center gap-2">
                <i class="fas fa-check text-green-600 text-[10px]"></i> {{ __('welcome.Sertifikat') }}
            </li>
            <li class="flex items-center gap-2">
                <i class="fas fa-check text-green-600 text-[10px]"></i> {{ __('welcome.Bisa') }}
            </li>
        </ul>

        {{-- Form Aksi Instan Masuk ke Keranjang Belanja --}}
        <form action="{{ route('cart.add', $course->id) }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="w-full bg-[#a435f0] hover:bg-[#8710d8] text-white font-bold py-3 rounded-lg transition-colors active:scale-95 text-sm">
                Masukkan Keranjang
            </button>
        </form>
    </div>
</div>