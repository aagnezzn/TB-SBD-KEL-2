@extends('layouts.guest') 

@section('content')
<div class="max-w-xl mx-auto px-4">
    <div class="bg-white border border-purple-50 shadow-xl shadow-purple-900/5 rounded-2xl p-10 text-center">
        <!-- Logo Idemy -->
        <h1 class="text-3xl font-bold text-black mb-6">idemy</h1>
        
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Verifikasi Email Anda</h2>
        <p class="text-gray-600 mb-8">
            Kami telah mengirimkan tautan verifikasi ke email Anda. Silakan periksa inbox atau folder spam di Mailtrap Anda.
        </p>

        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-[#5624d0] text-white py-4 font-bold rounded-xl hover:bg-[#4c1da7] transition uppercase text-[10px] tracking-widest">
                Kirim Ulang Email Verifikasi
            </button>
        </form>
    </div>
</div>
@endsection