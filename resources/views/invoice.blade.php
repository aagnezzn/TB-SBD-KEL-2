@extends('layouts.app')

@section('content')
<div class="bg-[#f7f9fa] min-h-screen py-10 flex items-center justify-center">
    <div class="max-w-md w-full bg-white shadow-lg rounded-xl border border-[#d1d7dc] p-8 text-center">
        
        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-qrcode text-[#a435f0] text-2xl"></i>
        </div>

        <h1 class="text-2xl font-bold text-[#1c1d1f] mb-2">Selesaikan Pembayaran</h1>
        <p class="text-[#6a6f73] text-sm mb-4">Silakan scan QR Code di bawah ini menggunakan aplikasi M-Banking atau E-Wallet Anda.</p>
        
        {{-- FAKTANYA: Menampilkan judul kursus langsung dari relasi baru pembeli --}}
        <p class="text-sm font-bold text-purple-700 bg-purple-50 py-2 px-4 rounded border border-purple-100 mb-6 inline-block capitalize">
            Kursus: {{ $payment->course->title ?? 'Kursus Tidak Ditemukan' }}
        </p>

        <div class="border-2 border-dashed border-[#d1d7dc] rounded-lg p-6 flex flex-col items-center justify-center mb-6 bg-gray-50">
            {{-- QR Code Generator (Data menggunakan ID Payment unik) --}}
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=IDEMY-PAY-{{ $payment->id }}" 
                 alt="QRIS" 
                 class="w-48 h-48 mb-4 border p-2 rounded-lg shadow-sm bg-white">
            
            <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Total Bayar</p>
            <p class="font-bold text-3xl text-[#1c1d1f]">Rp{{ number_format($payment->amount, 0, ',', '.') }}</p>
            <div class="mt-2 px-3 py-1 bg-purple-100 text-[#a435f0] text-xs font-bold rounded-full inline-block">
                Metode: {{ $payment->payment_method }}
            </div>
        </div>

        <div class="bg-red-50 border border-red-100 rounded p-3 mb-6">
            <p class="text-[11px] text-red-600 font-bold leading-tight uppercase">
                <i class="fas fa-exclamation-triangle mr-1"></i> Ini hanya qr simulasi.
            </p>
        </div>

        <a href="{{ route('transaction.success', ['id' => $payment->id]) }}" 
           class="block w-full bg-[#a435f0] hover:bg-[#8710d8] text-white py-4 font-bold text-lg rounded shadow-md transition-all text-center">
            Cek Status Pembayaran
        </a>

        <p class="mt-6 text-[11px] text-gray-400">ID Transaksi: #IDM-{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</p>

    </div>
</div>
@endsection