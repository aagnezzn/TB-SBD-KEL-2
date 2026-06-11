@extends('layouts.app')
@section('content')
<div class="max-w-[400px] mx-auto mt-20 p-6 bg-white border border-gray-200">
    <h2 class="font-bold text-xl mb-4">Lupa Password?</h2>
    <p class="text-sm text-gray-600 mb-6">Masukkan email Anda, kami akan kirimkan tautan reset.</p>
    
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required class="w-full border p-3 mb-4">
        <button type="submit" class="w-full bg-[#a435f0] text-white py-3 font-bold">Kirim Link Reset</button>
    </form>
</div>
@endsection