@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-12 mt-10">
    
    <!-- HEADER -->
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>

    @if($cartItems->isEmpty())
    <p class="text-gray-700 mb-16">
        <span class="font-bold italic">Keranjang Anda kosong</span> – mari ubah itu. Saatnya mempelajari beberapa skill baru.
    </p>
    @else

    <div class="flex flex-col lg:flex-row gap-12">
            <!-- DAFTAR KURSUS (KIRI) -->
            <div class="lg:w-2/3 flex flex-col space-y-6">
                <p class="font-bold border-b pb-2">{{ $cartItems->count() }} Kursus dalam Keranjang</p>
                @foreach($cartItems as $item)
                <div class="flex gap-4 border-b pb-6">
                    <img src="https://loremflickr.com/150/100/tech?random={{ $item->course->id }}" class="w-32 h-20 object-cover">
                    <div class="flex-grow">
                        <h3 class="font-bold text-gray-900">{{ $item->course->title }}</h3>
                        <p class="text-xs text-gray-600">Oleh {{ $item->course->user->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-purple-700 text-lg">Rp{{ number_format($item->course->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- TOTAL & CHECKOUT (KANAN) -->
            <div class="lg:w-1/3">
                <div class="p-6 border rounded-lg bg-gray-50">
                    <p class="text-gray-600 font-bold mb-1">Total:</p>
                    <p class="text-3xl font-bold text-gray-900 mb-6">Rp{{ number_format($cartItems->sum(fn($i) => $i->course->price), 0, ',', '.') }}</p>
                    <button class="w-full bg-purple-600 text-white font-bold py-3 hover:bg-purple-700 transition">Lanjutkan ke Checkout</button>
                </div>
            </div>
        </div>
    @endif

    <!-- SECTION: PEMBELAJAR MELIHAT -->
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Pembelajar melihat</h2>

    <!-- Pembungkus Scroll Horizontal (Bisa digeser ke samping) -->
    <div class="flex overflow-x-auto overflow-visible gap-4 pb-8 relative snap-x">

    @foreach($courses as $course)
    <!-- KARTU KURSUS DINAMIS -->
    <div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group snap-start relative">
        <img src="https://loremflickr.com/320/180/tech?random={{ $course->id }}" 
     alt="{{ $course->title }}" 
     class="w-full h-36 object-cover border border-gray-200 mb-2 group-hover:opacity-90">
        
        <h3 class="font-bold text-gray-900 text-base leading-tight mb-1 group-hover:text-purple-700">{{ $course->title }}</h3>
        
        <p class="text-xs text-gray-500 mb-1">{{ $course->user->name }}</p>
        
        <div class="flex items-center gap-1 text-xs mb-1">
            <span class="font-bold text-yellow-700">4,8</span>
            <div class="flex text-yellow-500">
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
            <span class="text-gray-500">(1.234)</span>
        </div>

        <p class="font-bold text-gray-900 text-base mb-2">Rp{{ number_format($course->price, 0, ',', '.') }}</p>

        <!-- HOVER POPUP -->
        <div class="absolute top-0 left-full ml-3 w-[320px] bg-white border rounded-xl shadow-xl p-4 
            opacity-0 invisible group-hover:opacity-100 group-hover:visible 
            transition duration-300 z-50">

            <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
            <p class="text-sm text-gray-500 mb-2">Update: {{ $course->updated_at->format('M Y') }}</p>

            <ul class="text-sm text-gray-700 mb-3 space-y-1">
                <li>✔ Akses selamanya</li>
                <li>✔ Sertifikat penyelesaian</li>
            </ul>

            <!-- FORM UNTUK TAMBAH KE KERANJANG -->
            <form action="{{ route('cart.add', $course->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">
                    Tambahkan ke keranjang
                </button>
            </form>
        </div>
    </div>
@endforeach
        
    </div>
        </div>

    

    <!-- SECTION: TOPIK POPULER -->
    <h2 class="text-lg font-bold text-gray-900 mt-12 mb-4">Topik Populer</h2>
    
    <!-- Pembungkus Tombol Topik -->
    <div class="flex overflow-x-auto gap-4 pb-4">
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">AI Generatif</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">Sertifikasi TI</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">Ilmu Data</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">ChatGPT</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">Rekayasa Prompt</button>
    </div>

</div>

@endsection