<div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group/item snap-start relative bg-white rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
    <a href="{{ route('course.show', $course->id) }}">
        {{-- FIX: Menggunakan data image_url dari DB + Pengaman Onerror --}}
        <img src="{{ $course->image_url }}" 
             alt="{{ $course->title }}"
             class="w-full h-36 object-cover rounded-t-lg border-b border-gray-200 mb-2"
             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80';">
             
        <div class="p-2">
            <h3 class="font-bold text-gray-900 text-sm leading-tight mb-1 group-hover/item:text-purple-700 h-10 overflow-hidden">
                {{ $course->title }}
            </h3>
            <p class="text-xs text-gray-500 mb-1">Oleh {{ $course->user->name ?? 'Instruktur' }}</p>

            <div class="flex items-center gap-1 text-xs mb-1">
                <span class="font-bold text-yellow-700">4,8</span>
                <div class="flex text-yellow-500">
                    ★★★★★
                </div>
                <span class="text-gray-500">({{ rand(500, 2000) }})</span>
            </div>
            <p class="font-bold text-gray-900 text-base mb-2">Rp{{ number_format($course->price, 0, ',', '.') }}</p>
        </div>
    </a>

    {{-- Pop-up Floating Detail --}}
    <div class="absolute top-0 left-full ml-3 w-[320px] bg-white border border-gray-200 rounded-lg shadow-2xl p-4 opacity-0 invisible group-hover/item:opacity-100 group-hover/item:visible transition-all duration-300 z-[100] pointer-events-none group-hover/item:pointer-events-auto">
        <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
        <p class="text-xs text-green-700 font-bold mb-2 uppercase">Diperbarui Mei 2026</p>
        <ul class="text-sm text-gray-600 mb-4 space-y-1">
            <li>✓ Akses selamanya</li>
            <li>✓ Sertifikat penyelesaian</li>
            <li>✓ Materi berkualitas tinggi</li>
        </ul>
        <form action="{{ route('cart.add', $course->id) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-[#a435f0] text-white py-2 font-bold hover:bg-[#8710d8] transition rounded-sm shadow-sm">
                Tambahkan ke keranjang
            </button>
        </form>
    </div>
</div>