@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto py-20 text-center">
    {{-- Mengganti emoji ceklis dengan ikon font awesome --}}
    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 font-bold flex items-center justify-center gap-2">
        <i class="fas fa-check-circle"></i> Kursus Anda berhasil disimpan ke database!
    </div>

    <div class="bg-white border p-8 rounded-xl shadow-md">
        <h3 class="text-xl font-bold mb-4">Satu Langkah Lagi!</h3>
        <p class="text-gray-600 mb-6">Kursus Anda sudah masuk, tapi agar Anda bisa mengelola dan mempublikasikannya, daftarkan email Anda sebagai Instructor resmi.</p>
        
        <form action="{{ route('instructor.upgrade') }}" method="POST">
            @csrf
            <div class="mb-4 text-left">
                <label class="text-sm text-gray-500">Email Anda</label>
                <input type="text" value="{{ auth()->user()->email }}" class="w-full bg-gray-100 p-2 border rounded cursor-not-allowed" readonly>
            </div>
            
            <button type="submit" class="w-full bg-[#1c1d1f] text-white py-3 font-bold hover:bg-black transition">
                Daftarkan Email Saya sebagai Instructor
            </button>
        </form>

        @if(session('success'))
            {{-- Mengganti emoji bintang dengan ikon font awesome --}}
            <div class="mt-8 p-4 bg-purple-100 text-purple-700 rounded-lg font-bold animate-bounce flex items-center justify-center gap-2">
                <i class="fas fa-star"></i> {{ session('success') }}
            </div>
            
            <div class="mt-6">
                <a href="{{ route('instructor.dashboard') }}" 
                   class="inline-block bg-purple-700 text-white px-8 py-3 rounded-lg font-bold hover:bg-purple-800 transition shadow-lg">
                    Masuk ke Dashboard Saya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection