@extends('layouts.app')

@section('content')
<div class="bg-[#f7f9fa] min-h-screen py-10 flex items-center justify-center">
    <div class="max-w-md w-full bg-white shadow-lg rounded-xl border border-[#d1d7dc] p-8 text-center">
        
        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-qrcode text-[#a435f0] text-2xl"></i>
        </div>

        <h1 class="text-2xl font-bold text-[#1c1d1f] mb-2">Selesaikan Pembayaran</h1>
        <p class="text-[#6a6f73] text-sm mb-4">Silakan scan QR Code di bawah untuk seluruh item kursus Anda.</p>
        
        {{-- LOOPING SEMUA KURSUS YANG DI-CHECKOUT --}}
        <div class="mb-6 space-y-2">
            @foreach($payments as $payment)
                <p class="text-sm font-bold text-purple-700 bg-purple-50 py-2 px-4 rounded border border-purple-100 inline-block capitalize w-full">
                    {{ $payment->course->title }} - Rp{{ number_format($payment->amount, 0, ',', '.') }}
                </p>
            @endforeach
        </div>

        <div class="border-2 border-dashed border-[#d1d7dc] rounded-lg p-6 flex flex-col items-center justify-center mb-6 bg-gray-50">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=IDEMY-BATCH-{{ Auth::id() }}" 
                 alt="QRIS" 
                 class="w-48 h-48 mb-4 border p-2 rounded-lg shadow-sm bg-white">
            
            <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Total Tagihan</p>
            <p class="font-bold text-3xl text-[#1c1d1f]">
                Rp{{ number_format($payments->sum('amount'), 0, ',', '.') }}
            </p>
        </div>

        {{-- FORM KONFIRMASI BATCH --}}
        <form action="{{ route('checkout.confirm.all') }}" method="POST" class="w-full">
            @csrf
            <button type="submit" 
                class="block w-full bg-[#a435f0] hover:bg-[#8710d8] text-white py-4 font-bold text-lg rounded shadow-md transition-all text-center">
                Cek Status Pembayaran
            </button>
        </form>

    </div>
</div>
@endsection