<div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group/item snap-start relative">
    <a href="{{ route('course.show', $course->id) }}">
        <img src="https://loremflickr.com/320/180/tech?random={{ $course->id }}" class="w-full h-36 object-cover border border-gray-200 mb-2">
        <h3 class="font-bold text-gray-900 text-sm leading-tight mb-1 group-hover/item:text-purple-700 h-10 overflow-hidden">
            {{ $course->title }}
        </h3>
        <p class="text-xs text-gray-500 mb-1">{{ $course->user->name }}</p>

        <div class="flex items-center gap-1 text-xs mb-1">
            <span class="font-bold text-yellow-700">4,8</span>
            <div class="flex text-yellow-500">
                ★★★★★
            </div>
            <span class="text-gray-500">(1.234)</span>
        </div>
        <p class="font-bold text-gray-900 text-base mb-2">Rp{{ number_format($course->price, 0, ',', '.') }}</p>
    </a>

    <div class="absolute top-0 left-full ml-3 w-[320px] bg-white border border-gray-200 rounded-lg shadow-2xl p-4 opacity-0 invisible group-hover/item:opacity-100 group-hover/item:visible transition-all duration-300 z-[100] pointer-events-none group-hover/item:pointer-events-auto">
        <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
        <p class="text-xs text-green-700 font-bold mb-2">Diperbarui April 2026</p>
        <ul class="text-sm text-gray-600 mb-4 space-y-1">
            <li>✓ Akses selamanya</li>
            <li>✓ Sertifikat penyelesaian</li>
        </ul>
        <form action="{{ route('cart.add', $course->id) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-purple-600 text-white py-2 font-bold hover:bg-purple-700 transition">
                Tambahkan ke keranjang
            </button>
        </form>
    </div>
</div>