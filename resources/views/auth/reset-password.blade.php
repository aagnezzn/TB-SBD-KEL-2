@extends('layouts.app')
@section('content')
<div class="max-w-[400px] mx-auto mt-20 p-6 bg-white border border-gray-200">
    <h2 class="font-bold text-xl mb-4">Reset Password</h2>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" value="{{ request()->email }}" readonly class="w-full border p-3 mb-4 bg-gray-100">
        <input type="password" name="password" placeholder="Password Baru" required class="w-full border p-3 mb-4">
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required class="w-full border p-3 mb-4">
        <button type="submit" class="w-full bg-[#a435f0] text-white py-3 font-bold">Ubah Password</button>
    </form>
</div>
@endsection