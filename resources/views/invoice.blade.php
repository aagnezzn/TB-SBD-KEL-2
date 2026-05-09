@extends('layouts.app')

@section('content')
<div class="bg-[#f7f9fa] min-h-screen py-10 flex items-center justify-center">
    <div class="max-w-md w-full bg-white shadow-lg rounded-xl border border-[#d1d7dc] p-8 text-center">
        
        <h1 class="text-2xl font-bold text-[#1c1d1f] mb-2">Selesaikan Pembayaran</h1>
        <p class="text-[#6a6f73] text-sm mb-6">Silakan scan QR Code di bawah ini menggunakan aplikasi M-Banking atau E-Wallet Anda.</p>

        <div class="border-2 border-dashed border-[#d1d7dc] rounded-lg p-6 flex flex-col items-center justify-center mb-6">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=IDEMY-PAYMENT-{{ $payment->id }}" 
                 alt="QRIS" 
                 class="w-48 h-48 mb-4 border p-2 rounded-lg shadow-sm">
            
            <p class="font-bold text-xl text-[#1c1d1f]">Rp{{ number_format($payment->amount, 0, ',', '.') }}</p>
            <p class="text-sm text-[#a435f0] font-semibold mt-1">Metode: {{ $payment->payment_method }}</p>
        </div>

        <p class="text-xs text-red-500 mb-6">*Ini adalah halaman simulasi (mockup).</p>

        <a href="{{ route('transaction.success', ['id' => $payment->id]) }}" 
           class="block w-full bg-[#a435f0] hover:bg-[#8710d8] text-white py-4 font-bold text-lg rounded transition-colors text-center">
            Cek Status Pembayaran
        </a>

    </div>
</div>
@endsection