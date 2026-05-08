@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto py-16 px-6">

    <div class="bg-white shadow-lg rounded-xl p-8 border">

        <div class="flex justify-center mb-4">
    <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-10 h-10 text-green-500"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="3">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M5 13l4 4L19 7" />
        </svg>

    </div>
</div>

            <h1 class="text-3xl font-bold mb-2">
                Pembayaran Berhasil
            </h1>

            <p class="text-gray-600">
                Terima kasih telah membeli course di Idemy
            </p>
        

        <div class="border-t border-b py-6 space-y-4">

            <div class="flex justify-between">
                <span class="text-gray-500">Metode Pembayaran</span>
                <span class="font-semibold">
                    {{ $payment->payment_method }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Tanggal</span>
                <span class="font-semibold">
                    {{ $payment->paid_at }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Total</span>
                <span class="font-bold text-xl">
                    Rp{{ number_format($payment->amount, 0, ',', '.') }}
                </span>
            </div>

        </div>
        </div>

        <div class="mt-8">
            <a href="/"
               class="block text-center bg-[#a435f0] hover:bg-[#8710d8] text-white py-3 rounded-lg font-bold">
                Kembali ke Beranda
            </a>
        </div>

    </div>

</div>

@endsection