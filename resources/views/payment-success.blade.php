@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-16 px-6">
    <div class="bg-white shadow-lg rounded-xl p-8 border text-center">

        <div class="flex justify-center mb-6">
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

        <h1 class="text-3xl font-bold mb-2 text-[#1c1d1f]">
            Pembayaran Berhasil!
        </h1>

        <p class="text-gray-600 mb-8">
            Transaksi kamu telah kami proses. Selamat bergabung di komunitas belajar Idemy!
        </p>

        <div class="border-t border-b py-6 space-y-4 text-left">
            <div class="flex justify-between items-center">
                <span class="text-gray-500 text-sm">Metode Pembayaran</span>
                <span class="font-bold text-[#1c1d1f]">{{ $payment->payment_method }}</span>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-gray-500 text-sm">Tanggal Pembayaran</span>
                <span class="font-bold text-[#1c1d1f]">
                    {{-- FIX: Format tanggal agar lebih rapi --}}
                    {{ \Carbon\Carbon::parse($payment->paid_at)->translatedFormat('d F Y, H:i') }} WIB
                </span>
            </div>

            <div class="flex justify-between items-center pt-2">
                <span class="text-gray-500 text-sm font-bold uppercase tracking-widest">Total Bayar</span>
                <span class="font-black text-2xl text-[#1c1d1f]">
                    Rp{{ number_format($payment->amount, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="mt-10 space-y-3">
            {{-- TOMBOL BARU: Agar user bisa langsung belajar --}}
            <a href="{{ route('learning.index') }}"
               class="block text-center bg-[#a435f0] hover:bg-[#8710d8] text-white py-4 rounded font-bold transition-all shadow-md">
                Mulai Belajar Sekarang
            </a>

            <a href="/"
               class="block text-center border border-gray-900 text-gray-900 py-3 rounded font-bold hover:bg-gray-50 transition-all">
                Kembali ke Beranda
            </a>
        </div>
        
        <p class="mt-6 text-[10px] text-gray-400 italic">
            ID Transaksi: #IDM-{{ str_pad($payment->id, 7, '0', STR_PAD_LEFT) }}
        </p>
    </div>
</div>
@endsection