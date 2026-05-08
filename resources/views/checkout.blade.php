<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<nav class="flex justify-between items-center px-8 py-5 bg-white border-b border-[#d1d7dc] sticky top-0 z-50">

    <a href="/" class="text-3xl font-bold text-[#1c1d1f]">
        idemy
    </a>

    <a href="{{ route('cart.index') }}"
       class="text-[#a435f0] font-bold text-sm hover:text-[#8710d8] transition-colors">
        Batal
    </a>

</nav>

<div class="bg-[#f7f9fa] min-h-screen py-10">
    <div class="max-w-[1100px] mx-auto px-4 font-sans text-[#1c1d1f]">
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="w-full lg:w-[65%]">
                    <h1 class="text-3xl font-bold mb-8">Checkout</h1>
                    
                    <h2 class="text-xl font-bold mb-4">Alamat penagihan</h2>
                    <div class="bg-white border border-[#d1d7dc] p-6 mb-8">
                        <label class="block text-sm font-bold mb-2">Negara</label>
                        <select class="w-full md:w-1/2 border border-[#1c1d1f] p-3 focus:outline-none">
                            <option>Indonesia</option>
                        </select>
                        <p class="text-xs text-[#6a6f73] mt-3">Idemy diwajibkan oleh hukum untuk menagih pajak transaksi yang berlaku.</p>
                    </div>

                    <h2 class="text-xl font-bold mb-4">Metode pembayaran</h2>
                    <div class="border border-[#d1d7dc] rounded-sm overflow-hidden">
                        <label class="flex items-center justify-between p-4 border-b border-[#d1d7dc] bg-white cursor-pointer hover:bg-[#f7f9fa]">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="OVO" checked class="w-4 h-4 accent-[#a435f0]">
                                <span class="font-bold text-sm">OVO</span>
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/eb/eb/Logo_ovo_purple.svg" class="h-4" alt="OVO">
                        </label>

                        <label class="flex items-center justify-between p-4 border-b border-[#d1d7dc] bg-white cursor-pointer hover:bg-[#f7f9fa]">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="Dana" class="w-4 h-4 accent-[#a435f0]">
                                <span class="font-bold text-sm">Dana</span>
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" class="h-5" alt="Dana">
                        </label>

                        <label class="flex items-center justify-between p-4 bg-white cursor-pointer hover:bg-[#f7f9fa]">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="Transfer Bank" class="w-4 h-4 accent-[#a435f0]">
                                <span class="font-bold text-sm">Transfer Bank</span>
                            </div>
                            <i class="fas fa-university text-gray-400"></i>
                        </label>
                    </div>
                </div>

                <div class="w-full lg:w-[35%]">
                        <div class="bg-white border border-[#d1d7dc] p-6 sticky top-24">

    <h3 class="text-lg font-bold mb-4">Ringkasan pesanan</h3>

    @foreach($cartItems as $item)
        <div class="flex gap-3 mb-4 pb-4 border-b border-[#d1d7dc]">

            <img src="{{ $item->course->image_url }}" class="w-20 h-20 object-cover rounded">

            <div class="flex-1">
                <h4 class="font-bold text-sm">
                    {{ $item->course->title }}
                </h4>

                <p class="text-sm text-[#6a6f73] mt-1">
                    Rp{{ number_format($item->course->price, 0, ',', '.') }}
                </p>
            </div>

        </div>
    @endforeach

    <div class="flex justify-between text-sm mb-2 text-[#6a6f73]">
        <span>Harga asli:</span>
        <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
    </div>

    <hr class="my-4 border-[#d1d7dc]">

    <div class="flex justify-between font-bold text-xl mb-6">
        <span>Total:</span>
        <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
    </div>

    <input type="hidden" name="amount" value="{{ $total }}">

    <button type="submit"
        class="w-full bg-[#a435f0] hover:bg-[#8710d8] text-white py-4 font-bold text-lg transition-colors mb-4">
        Selesaikan Pembayaran
    </button>

    <p class="text-[10px] text-center text-[#6a6f73]">
        Jaminan Uang Kembali 30 Hari
    </p>

</div>
                </div>
            </div>
        </form>