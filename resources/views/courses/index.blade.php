@extends('layouts.app')

@section('content')
<div class="max-w-[1340px] mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Kursus dalam kategori: {{ $category->name }}</h1>
    
    <div class="flex overflow-x-auto overflow-visible gap-4 pb-8 no-scrollbar">
    @foreach($courses as $course)
        {{-- Baris ini yang akan memanggil bintang & popup secara otomatis --}}
        @include('partials.course-card', ['course' => $course])
    @endforeach
</div>
    <!-- Navigasi Halaman -->
    <div class="mt-8">
        {{ $courses->links() }}
    </div>
</div>
@endsection