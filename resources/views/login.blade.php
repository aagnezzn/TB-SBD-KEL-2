@extends('layouts.app')

@section('content')

<div class="flex flex-col md:flex-row min-h-screen max-w-7xl mx-auto items-center pt-10 md:pt-0">
    
    <div class="hidden md:flex w-1/2 justify-center p-10">
        <img src="{{ asset('gambarlogin.png') }}" class="w-full max-w-[450px] object-contain" alt="Ilustrasi Login">
    </div>

    <div class="w-full md:w-1/2 flex justify-center p-6 md:p-12">
        <div class="w-full max-w-[400px]">
            
            <h1 class="text-center font-bold text-[28px] leading-tight mb-8 text-[#1c1d27]">
                Login untuk melanjutkan perjalanan belajar Anda
            </h1>

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6 flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-sm"></i>
                    <p class="text-sm font-bold">{{ session('error') }}</p>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <input type="email" name="email" placeholder="Email" required
                        class="w-full border-2 border-[#1c1d27] p-4 font-bold text-[16px] focus:outline-none">
                </div>

                <div class="relative">
                    <input type="password" name="password" placeholder="Kata Sandi" required
                        class="w-full border-2 border-[#1c1d27] p-4 font-bold text-[16px] focus:outline-none">
                </div>

                <button type="submit" 
                    class="w-full bg-[#a435f0] text-white font-bold py-4 text-[18px] hover:bg-[#8710d8] transition-colors">
                    Login
                </button>
            </form>

            <div class="mt-6 text-center text-sm border-t pt-4">
                <p class="text-black">Punya akses khusus? 
                    <a href="/admin/login" class="text-[#a435f0] font-semibold hover:underline">Admin</a> 
                    <span class="mx-1 text-gray-300">|</span>
                    <a href="/instructor/login" class="text-[#a435f0] font-semibold hover:underline">Instructor</a>
                </p>
            </div>

            <div class="mt-8 text-center text-[15px] border-t border-gray-200 pt-5">
                <span class="text-[#1c1d27]">Tidak punya akun?</span>
                <a href="/register" class="text-[#a435f0] font-bold hover:text-[#8710d8] underline underline-offset-4 ml-1">Daftar</a>
            </div>

        </div>
    </div>
</div>

@endsection