@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-[#f7f9fa]">
    <div class="w-full max-w-[400px] bg-white p-8 border border-gray-200 shadow-sm">
        
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4 text-[#a435f0]">
                <i class="fas fa-user-shield text-5xl"></i>
            </div>
            <h1 class="font-bold text-2xl text-[#1c1d27]">Portal Admin Idemy</h1>
            <p class="text-sm text-gray-600">Masukkan kredensial khusus administrator</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold mb-1 uppercase text-gray-500">Admin Email</label>
                <input type="email" name="email" required class="w-full border border-gray-800 p-3 text-sm focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold mb-1 uppercase text-gray-500">Password</label>
                <input type="password" name="password" required class="w-full border border-gray-800 p-3 text-sm focus:outline-none">
            </div>
            <button type="submit" class="w-full bg-[#1c1d27] text-white font-bold py-3 hover:bg-black transition-colors">
                Masuk
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="/login" class="text-sm text-[#a435f0] hover:underline">Bukan Admin? Kembali ke Login Siswa</a>
        </div>
    </div>
</div>
@endsection