@extends('layouts.app')

@section('content')
<div class="max-w-[1340px] mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Kursus dalam kategori: {{ $category->name }}</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($courses as $course)
            {{-- Memanggil komponen card masing-masing kursus --}}
            @include('partials.course-card', ['course' => $course])
        @endforeach
    </div>

    <div class="mt-12 border-t border-gray-200 pt-6">
        {{ $courses->links() }}
    </div>
</div>
@endsection