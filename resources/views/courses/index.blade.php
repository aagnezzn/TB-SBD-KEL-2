@extends('layouts.app')

@section('content')
<div class="max-w-[1340px] mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Kursus dalam kategori: {{ $category->name }}</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($courses as $course)
        <div class="border border-gray-200 rounded-lg p-4 shadow-sm">
           <img src="{{ $course->image_url }}" class="w-full h-40 object-cover rounded-md mb-4">
            <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
            <p class="text-gray-600 text-sm mb-4">Oleh: {{ $course->author }}</p>
            <div class="flex justify-between items-center">
                <span class="font-bold text-[#5624d0]">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                <a href="/course/{{ $course->id }}" class="text-sm font-bold text-blue-600">Detail</a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigasi Halaman -->
    <div class="mt-8">
        {{ $courses->links() }}
    </div>
</div>
@endsection