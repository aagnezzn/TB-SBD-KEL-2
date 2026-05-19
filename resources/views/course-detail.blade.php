@extends('layouts.app')

@section('content')
{{-- Header --}}
<div class="bg-[#1c1d1f] text-white py-12">
    <div class="max-w-[1340px] mx-auto px-4 flex flex-col md:flex-row gap-8 relative">
        <div class="md:w-2/3 lg:w-3/5">
            <h1 class="text-3xl font-bold mb-4">{{ $course->title }}</h1>
            <p class="text-lg mb-4">{{ Str::limit($course->description, 150) }}</p>
            
            <div class="flex items-center space-x-2 mb-4 text-sm">
                @php 
                    $avgRating = $course->reviews->avg('rating') ?? 0; 
                    $totalReviews = $course->reviews->count();
                @endphp

                <span class="text-[#f69c08] font-bold">{{ number_format($avgRating, 1) }}</span>
                <div class="flex text-[#f69c08] space-x-0.5">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= round($avgRating) ? '★' : '☆' }}
                    @endfor
                </div>
                <span class="text-[#c0c4fc] underline">({{ $totalReviews }} rating)</span>
                <span>{{ number_format($course->enrollments->count(), 0, ',', '.') }} {{ __('detailcourse.siswa') }}</span>
            </div>
            <p class="text-sm">{{ __('detailcourse.dibuat') }}  {{ $course->user->name ?? 'Instruktur' }}</a></p>
        </div>
        
        {{-- Sidebar Kartu Putih --}}
        <div class="md:w-1/3 lg:w-[350px] bg-white text-gray-900 border border-gray-200 shadow-lg p-6 md:absolute md:right-4 md:top-12 z-10 rounded">
            
            {{-- FIX: Menggunakan data image_url dari DB + Pengaman Onerror --}}
            <img src="{{ $course->image_url }}" 
                 alt="{{ $course->title }}" 
                 class="w-full h-44 object-cover mb-4 rounded"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80';">
                 
            <div class="text-3xl font-bold mb-4">Rp {{ number_format($course->price, 0, ',', '.') }}</div>
            
            <form action="{{ route('cart.add', $course->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-[#a435f0] text-white py-3 font-bold hover:bg-[#8710d8] transition mb-3 rounded">
                    {{ __('detailcourse.add_cart') }}
                </button>
            </form>

            <form action="{{ route('wishlist.add', $course->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full border border-black py-3 font-bold hover:bg-gray-100 transition rounded">
                    {{ __('detailcourse.add_wishlist') }}
                </button>
            </form>
            
            <div class="text-xs text-center text-gray-600 mb-6">{{ __('detailcourse.garansi') }}</div>
            
            <div class="text-sm">
                <div class="font-bold mb-2">{{ __('detailcourse.mencakup') }}</div>
                <ul class="space-y-2 text-gray-700">
                    <li>{{ __('detailcourse.1') }}</li>
                    <li>{{ __('detailcourse.2') }}</li>
                    <li>{{ __('detailcourse.3') }}</li>
                    <li>{{ __('detailcourse.4') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Bagian Bawah Konten --}}
<div class="max-w-[1340px] mx-auto px-4 py-8">
    <div class="md:w-2/3 lg:w-3/5">
        <div class="border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-900">{{ __('detailcourse.yg_dipelajari') }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-gray-700">
                <div>{{ __('detailcourse.dipelajari1') }}</div>
                <div>{{ __('detailcourse.dipelajari2') }}</div>
                <div>{{ __('detailcourse.dipelajari3') }}</div>
                <div>{{ __('detailcourse.dipelajari4') }}</div>
            </div>
        </div>

        <h2 class="text-xl font-bold mb-4 text-gray-900">{{ __('detailcourse.konten') }}</h2>
        <div class="border border-gray-200 mb-8 text-sm">
            <div class="bg-gray-50 p-4 border-b border-gray-200 font-bold flex justify-between text-gray-900">
                <span>{{ __('detailcourse.kurikulum') }}</span>
                <span class="text-gray-600 font-normal">{{ $course->lessons->count() }} {{ __('detailcourse.kuliah') }}</span>
            </div>
            @forelse($course->lessons as $lesson)
                <div class="p-4 flex justify-between items-center text-gray-700 border-b border-gray-200 last:border-b-0">
                    <span>📄 {{ $lesson->title }}</span>
                    <span class="text-[#a435f0] text-xs font-bold cursor-pointer underline">{{ __('detailcourse.pratinjau') }}</span>
                </div>
            @empty
                <div class="p-4 text-gray-500 italic">Belum ada materi untuk kursus ini.</div>
            @endforelse
        </div>

        {{-- Bagian Review --}}
        <div class="mt-12 border-t border-gray-200 pt-10">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                <span class="text-[#f69c08]">★</span> 
                {{ number_format($avgRating, 1) }} {{ __('detailcourse.peringkat_kursus') }}
                <span class="text-gray-400 text-base">• {{ $totalReviews }} {{ __('detailcourse.peringkat') }}</span>   
            </h2>

            <button onclick="toggleReviewForm()" class="mb-6 bg-purple-600 text-white px-4 py-2 font-bold hover:bg-purple-800 transition rounded-sm">
                {{ __('detailcourse.give_rating') }}
            </button>

            <div id="review-form-container" class="hidden mb-10 p-6 border border-gray-200 bg-gray-50 rounded-lg">
                <h3 class="text-lg font-bold mb-4">{{ __('detailcourse.give_review') }}</h3>
                <form action="{{ route('reviews.store', $course->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold mb-1">{{ __('detailcourse.rating') }}</label>
                        <select name="rating" class="w-full border border-gray-300 p-2 rounded" required>
                            <option value="5">{{ __('detailcourse.rating5') }}</option>
                            <option value="4">{{ __('detailcourse.rating4') }}</option>
                            <option value="3">{{ __('detailcourse.rating4') }}</option>
                            <option value="2">{{ __('detailcourse.rating2') }}</option>
                            <option value="1">{{ __('detailcourse.rating1') }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold mb-1">{{ __('detailcourse.review') }}</label>
                        <textarea name="comment" rows="4" class="w-full border border-gray-300 p-2 rounded" placeholder="{{ __('detailcourse.review_placeholder') }}" required></textarea>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-[#a435f0] text-white px-6 py-2 font-bold hover:bg-[#8710d8] transition">
                            {{ __('detailcourse.kirim') }}
                        </button>
                        <button type="button" onclick="toggleReviewForm()" class="border border-black px-6 py-2 font-bold hover:bg-gray-200 transition">
                            {{ __('detailcourse.batal') }}
                        </button>
                    </div>
                </form>
            </div>

            <script>
                function toggleReviewForm() {
                    const form = document.getElementById('review-form-container');
                    if (form.classList.contains('hidden')) {
                        form.classList.remove('hidden');
                    } else {
                        form.classList.add('hidden');
                    }
                }
            </script>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                @forelse($course->reviews as $review)
                    <div class="border-t border-gray-100 pt-6">
                        <div class="flex items-start gap-4 text-sm">
                            <div class="w-11 h-11 rounded-full bg-[#1c1d1f] text-white flex items-center justify-center font-bold flex-shrink-0">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            
                            <div class="flex-1">
                                <div class="mb-1">
                                    <h4 class="font-bold text-gray-900">{{ $review->user->name }}</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <div class="flex text-[#f69c08] text-xs">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $review->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <p class="text-gray-700 leading-relaxed mt-2">
                                    {{ $review->comment }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 py-8 text-center bg-gray-50 rounded-lg">
                        <p class="text-gray-500 italic">Belum ada ulasan untuk kursus ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection