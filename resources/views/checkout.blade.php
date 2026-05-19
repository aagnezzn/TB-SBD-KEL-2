@extends('layouts.app')

@section('content')
{{-- KONTROL NAV MINIMALIS --}}
<nav class="flex justify-between items-center px-8 py-5 bg-white border-b border-[#d1d7dc] sticky top-0 z-[210] shadow-sm">
    <a href="/" class="text-3xl font-bold text-[#1c1d1f] no-underline">
        idemy
    </a>

    <a href="{{ route('cart.index') }}"
       class="text-[#a435f0] font-bold text-sm hover:text-[#8710d8] transition-colors no-underline">
        {{ __('kc.batal') }}
    </a>
</nav>

{{-- PEMBUNGKUS UTAMA --}}
<div class="bg-[#f7f9fa] min-h-screen py-10 relative z-10">
    <div class="max-w-[1100px] mx-auto px-4 font-sans text-[#1c1d1f]">
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            
            <div class="flex flex-col lg:flex-row gap-12 items-start">
                
                {{-- Alamat & Metode Pembayaran --}}
                <div class="w-full lg:w-[65%]">
                    <h1 class="text-3xl font-bold mb-8">{{ __('kc.co') }}</h1>
                    
                    <h2 class="text-xl font-bold mb-4">{{ __('kc.alamat_co') }}</h2>
                    <div class="bg-white border border-[#d1d7dc] p-6 mb-8 rounded-sm shadow-sm">
                        <label class="block text-sm font-bold mb-2">{{ __('kc.negara_co') }}</</label>
                        <select class="w-full md:w-1/2 border border-[#1c1d1f] p-3 focus:outline-none bg-white cursor-pointer">
                            <option>Indonesia</option>
                            <option>Malaysia</option>
                            <option>Singapura</option>
                            <option>Brunei</option>
                        </select>
                        <p class="text-xs text-[#6a6f73] mt-3">{{ __('kc.hukum') }}</p>
                    </div>

                    <h2 class="text-xl font-bold mb-4">{{ __('kc.method') }}</h2>
                    <div class="border border-[#d1d7dc] rounded-sm overflow-hidden shadow-sm bg-white">
                        <label class="flex items-center justify-between p-4 border-b border-[#d1d7dc] bg-white cursor-pointer hover:bg-[#f7f9fa] transition">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="OVO" checked class="w-4 h-4 accent-[#a435f0] cursor-pointer">
                                <span class="font-bold text-sm">OVO</span>
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" class="h-4" alt="OVO">
                        </label>

                        <label class="flex items-center justify-between p-4 border-b border-[#d1d7dc] bg-white cursor-pointer hover:bg-[#f7f9fa] transition">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="Dana" class="w-4 h-4 accent-[#a435f0] cursor-pointer">
                                <span class="font-bold text-sm">Dana</span>
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" class="h-5" alt="Dana">
                        </label>

                        <label class="flex items-center justify-between p-4 bg-white cursor-pointer hover:bg-[#f7f9fa] transition">
                            <div class="flex items-center gap-3">
                            <input type="radio" name="payment_method" value="Transfer Bank" class="w-4 h-4 accent-[#a435f0] cursor-pointer">
                            <span class="font-bold text-sm">{{ __('kc.bank') }}</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5M4.5 21V10.5M2.25 21h19.5M3 10.5h18M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                        </label>
                    </div>
                </div>

                {{-- KOLOM KANAN: Ringkasan Pesanan (Sticky Samping) --}}
                <div class="w-full lg:w-[35%] lg:sticky lg:top-28 z-20">
                    <div class="bg-white border border-[#d1d7dc] p-6 shadow-sm rounded-sm">
                        <h3 class="text-lg font-bold mb-4">{{ __('kc.order_summary') }}</h3>

                        <div class="max-h-[240px] overflow-y-auto pr-1 hide-scrollbar mb-4">
                            @foreach($cartItems as $item)
                                <div class="flex gap-3 mb-4 pb-4 border-b border-[#d1d7dc] last:border-0 last:pb-0">
                                    <img src="{{ $item->course->image_url }}" 
                                         class="w-16 h-16 object-cover rounded border border-gray-100 shrink-0"
                                         alt="{{ $item->course->title }}"
                                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=200&q=80';">

                                    <div class="min-w-0 flex-1">
                                        <h4 class="font-bold text-xs leading-tight line-clamp-2 text-gray-900">
                                            {{ $item->course->title }}
                                        </h4>
                                        <p class="text-sm font-bold text-gray-800 mt-2">
                                            Rp{{ number_format($item->course->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 pt-4 border-t border-[#d1d7dc]">
                            <div class="flex justify-between text-sm mb-2 text-[#6a6f73]">
                                <span>{{ __('kc.harga_asli') }}</span>
                                <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between font-bold text-xl mb-6 text-gray-900">
                                <span>Total:</span>
                                <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <input type="hidden" name="amount" value="{{ $total }}">

                            <button type="submit"
                                class="w-full bg-[#a435f0] hover:bg-[#8710d8] text-white py-4 font-bold text-lg transition-colors mb-4 shadow-md rounded-none cursor-pointer block text-center">
                                {{ __('kc.selesaikan') }}
                            </button>

                            <p class="text-[10px] text-center text-[#6a6f73] m-0">
                                {{ __('kc.anu') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection