@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row min-h-screen max-w-7xl mx-auto items-center pt-10 md:pt-0">
    
    <!-- Kolom Kiri: Gambar Ilustrasi -->
    <div class="hidden md:flex w-1/2 justify-center p-10">
        <img src="{{ asset('gambarlogin.png') }}" class="w-full max-w-[450px] object-contain" alt="Ilustrasi Register">
    </div>

    <!-- Kolom Kanan: Form Register -->
    <div class="w-full md:w-1/2 flex justify-center p-6 md:p-12">
        <div class="w-full max-w-[400px]">
            
            <h1 class="text-center font-bold text-[28px] leading-tight mb-8 text-[#1c1d27]">
                Daftar dan mulai belajar
            </h1>

            <!-- Nampilin pesan error kalau validasi gagal -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form mengarah ke route register.post -->
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                
                <!-- Input Nama -->
                <div class="mb-4">
                    <input type="text" name="name" placeholder="Nama Lengkap" required value="{{ old('name') }}"
                        class="w-full border border-black px-4 py-4 font-bold text-[#1c1d27] placeholder-gray-500 focus:outline-none focus:ring-0">
                </div>

                <!-- Input Email -->
                <div class="mb-4">
                    <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}"
                        class="w-full border border-black px-4 py-4 font-bold text-[#1c1d27] placeholder-gray-500 focus:outline-none focus:ring-0">
                </div>

                <!-- Input Password -->
                <div class="mb-6">
                    <input type="password" name="password" placeholder="Password" required
                        class="w-full border border-black px-4 py-4 font-bold text-[#1c1d27] placeholder-gray-500 focus:outline-none focus:ring-0">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="w-full bg-[#a435f0] text-white font-bold py-4 hover:bg-[#8710d8] transition">
                    Daftar
                </button>
            </form>

            <div class="text-center text-[15px] mt-6 border-t border-gray-200">
                <div class="py-5 flex justify-center gap-1">
                    <span class="text-[#1c1d27]">Sudah punya akun?</span>
                    <a href="{{ route('login') }}" class="text-[#a435f0] font-bold hover:text-[#8710d8] underline underline-offset-4">Login</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection