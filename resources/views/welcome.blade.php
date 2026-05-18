@extends('layouts.app')

@section('content')
<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

@auth
{{-- NAVBAR KATEGORI (SINKRONISASI ID: AMAN DARI 404) --}}
<div class="hidden lg:block bg-white border-b border-gray-200 relative">
    <div class="max-w-[1340px] mx-auto px-4">
        <ul class="flex justify-between items-center m-0 p-0 list-none">
            @foreach($navCategories as $mainCat)
            <li class="group/subnav static flex justify-center"> 
                {{-- FIX: Mengubah .slug menjadi .id agar dibaca mulus oleh web.php --}}
                <a href="/category/{{ $mainCat->id }}" class="relative text-[13px] text-gray-600 hover:text-[#5624d0] whitespace-nowrap font-medium px-4 py-4 capitalize transition-colors flex flex-col items-center no-underline">
                    {{ $mainCat->name }}
                    <div class="hidden group-hover/subnav:block absolute -bottom-[1px] w-0 h-0 border-l-[7px] border-l-transparent border-r-[7px] border-r-transparent border-b-[7px] border-b-[#1c1d1f] z-[160]"></div>
                </a>

                <div class="absolute hidden group-hover/subnav:flex bg-[#1c1d1f] w-full left-0 top-full z-[150] py-4 shadow-xl before:content-[''] before:absolute before:-top-4 before:left-0 before:w-full before:h-4">
                    <div class="max-w-[1340px] mx-auto px-4 flex justify-center space-x-10">
                        @foreach($mainCat->children->take(8) as $subCat)
                        {{-- FIX: Sub-kategori juga wajib ditembak menggunakan .id --}}
                        <a href="/category/{{ $subCat->id }}" class="text-[13px] font-normal text-white hover:text-purple-400 whitespace-nowrap transition-colors capitalize no-underline">
                            {{ $subCat->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endauth

<main class="min-h-screen bg-white">
    @auth
        {{-- === TAMPILAN SETELAH LOGIN === --}}
        <section class="max-w-[1340px] mx-auto px-4 py-8 flex items-center space-x-4">
            <div class="w-16 h-16 shrink-0">
                @if(Auth::user()->profile && Auth::user()->profile->photo)
                    <img src="{{ asset('storage/photos/' . Auth::user()->profile->photo) }}" class="w-16 h-16 rounded-full object-cover">
                @else
                    <div class="w-16 h-16 bg-[#1c1d1f] rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{__('welcome.Jumpa') }}  {{ Auth::user()->name }}</h1>
                <p class="text-sm font-bold text-[#5624d0] cursor-pointer hover:text-[#401b9c]">{{__('welcome.Tambahkan') }} </p>
            </div>
        </section>

        <section class="max-w-[1340px] mx-auto px-4 pb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{__('welcome.Apa') }}</h2>
            <p class="text-lg font-bold text-gray-800 mb-6">{{__('welcome.Direkomendasikan')}}</p>
            
            {{-- Grid Kursus Rekomendasi (Gunakan Partial Kebal N+1) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 relative overflow-visible">
                @foreach ($recommendedCourses as $course)
                    @include('partials.course-card', ['course' => $course])
                @endforeach
            </div>

            <p class="text-lg font-bold text-gray-800 mb-6 mt-12">{{__('welcome.Kursus Populer')}}</p>

            {{-- Grid Kursus Populer (Gunakan Partial Kebal N+1) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 relative overflow-visible">
                @foreach ($popularCourses as $course)
                    @include('partials.course-card', ['course' => $course])
                @endforeach
            </div>
        </section>

    @else
        {{-- === TAMPILAN GUEST === --}}
        <section class="px-10 mt-4">
            <div class="max-w-[1350px] mx-auto">
                <div class="h-[350px] relative rounded-lg overflow-hidden">
                    <div class="absolute inset-0 bg-cover bg-right" style="background-image: url('{{ asset('udemy.jpg') }}')"></div>
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="relative h-full flex items-center">
                        <div class="bg-white p-6 rounded shadow w-[450px] ml-10">
                            <h2 class="text-3xl font-bold mb-3">{{ __('welcome.Bangun skill yang diminati') }}</h2>
                            <p class="text-gray-600 mb-4">{{ __('welcome.Dapatkan') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-10 py-16 bg-gray-100">
            <div class="max-w-[1350px] mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
                    <div>
                        <h2 class="text-3xl font-bold mb-4">{{__('welcome.Pelajari skill')}}</h2>
                        <p class="text-gray-600">{{ __('welcome.Udemy') }}</p>
                    </div>
                    <div class="lg:col-span-3 relative">
                        <div class="overflow-hidden">
                            <div id="slider" class="flex gap-6 transition-transform duration-500">
                                @forelse($categories->take(12) as $cat)
                                    @php
                                        $cName = strtolower($cat->name);
                                        $imgName = 'ai.jpeg';

                                        if (str_contains($cName, 'development') || str_contains($cName, 'javascript') || str_contains($cName, 'coding')) { 
                                            $imgName = 'rekayasa_prompt.jpeg'; 
                                        } 
                                        elseif (str_contains($cName, 'python')) { 
                                            $imgName = 'python.jpeg'; 
                                        }
                                        elseif (str_contains($cName, 'business') || str_contains($cName, 'bisnis') || str_contains($cName, 'proyek')) { 
                                            $imgName = 'serti.jpeg'; 
                                        }
                                        elseif (str_contains($cName, 'it & software') || str_contains($cName, 'it') || str_contains($cName, 'sertifikasi')) { 
                                            $imgName = 'serti.jpeg'; 
                                        }
                                        elseif (str_contains($cName, 'office') || str_contains($cName, 'excel') || str_contains($cName, 'productivity')) { 
                                            $imgName = 'microsoft_excel.jpeg'; 
                                        }
                                        elseif (str_contains($cName, 'data science') || str_contains($cName, 'data') || str_contains($cName, 'ilmu data')) { 
                                            $imgName = 'ilmu_data.jpeg'; 
                                        }
                                        elseif (str_contains($cName, 'design') || str_contains($cName, 'desain')) { 
                                            $imgName = 'model.jpeg'; 
                                        }
                                        elseif (str_contains($cName, 'marketing') || str_contains($cName, 'pemasaran')) { 
                                            $imgName = 'gpt.jpeg'; 
                                        }
                                    @endphp
                                    <div class="min-w-[300px]">
                                        <a href="{{ url('/category/' . $cat->slug) }}" class="block relative rounded-2xl overflow-hidden shadow group bg-white no-underline">
                                            <img src="{{ asset($imgName) }}" class="w-full h-[300px] object-cover" alt="{{ $cat->name }}" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640';">
                                            <div class="absolute bottom-4 left-4 right-4 bg-white p-4 rounded-xl flex justify-between items-center group-hover:bg-gray-50 transition">
                                                <span class="font-semibold capitalize text-gray-900">{{ $cat->name }}</span>
                                                <span class="text-purple-700 font-bold">→</span>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <div class="text-gray-500 text-sm py-4">{{__('welcome.Tidak ada')}}</div>
                                @endforelse
                            </div>
                        </div>
                        <button onclick="prevGuestSlide()" class="absolute left-[-25px] top-1/2 -translate-y-1/2 bg-white border border-gray-200 w-10 h-10 rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition z-10 cursor-pointer">‹</button>
                        <button onclick="nextGuestSlide()" class="absolute right-[-25px] top-1/2 -translate-y-1/2 bg-white border border-gray-200 w-10 h-10 rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition z-10 cursor-pointer">›</button>
                    </div>
                </div>
            </div>
        </section>

        {{-- BRAND KORPORAT --}}
        <section class="bg-gray-100 py-12 border-t border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4">
                <p class="text-center text-slate-600 font-medium text-base mb-8 tracking-wide">{{ __('welcome.Dipercaya') }}</p>
                <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-8">
                    <img src="{{ asset('vw.png') }}" class="h-16 w-auto grayscale opacity-60" alt="VW">
                    <img src="{{ asset('samsung.png') }}" class="h-32 w-auto grayscale opacity-60" alt="Samsung">
                    <img src="{{ asset('cisco.png') }}" class="h-12 w-auto grayscale opacity-60" alt="Cisco">
                    <img src="{{ asset('vimeo.png') }}" class="h-12 w-auto grayscale opacity-60" alt="Vimeo">
                    <img src="{{ asset('pg.png') }}" class="h-16 w-auto grayscale opacity-60" alt="P&G">
                    <img src="{{ asset('hpe.png') }}" class="h-16 w-auto grayscale opacity-60" alt="HPE">
                    <img src="{{ asset('citi.png') }}" class="h-16 w-auto grayscale opacity-60" alt="Citi">
                    <img src="{{ asset('ericsson.png') }}" class="h-16 w-auto grayscale opacity-60" alt="Ericsson">
                </div>
            </div>
        </section>

        {{-- ULASAN SISWA GLOBAL --}}
        <section class="px-10 py-16 bg-gray-50">
            <div class="max-w-[1350px] mx-auto">
                <h2 class="text-3xl font-bold mb-8 max-w-2xl text-gray-900">{{ __('welcome.Bergabung') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $globalReviews = \App\Models\Review::with(['user', 'course'])->latest()->take(4)->get();
                    @endphp
                    
                    @forelse($globalReviews as $review)
                        <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col shadow-sm">
                            <svg class="w-8 h-8 mb-4 text-purple-700" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                            <p class="text-gray-700 mb-6 grow text-sm leading-relaxed italic">
                                "{{ $review->comment ?? 'Materi kursus yang luar biasa dan sangat membantu proses belajar.' }}"
                            </p>
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-full bg-purple-900 flex items-center justify-center text-white font-bold text-sm shrink-0">
                                    {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-sm text-gray-900 truncate">{{ $review->user->name ?? 'Siswa Anonim' }}</p>
                                    <p class="text-xs text-gray-500 truncate">Kursus: {{ $review->course->title ?? 'Materi Umum' }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-4 text-center py-12 bg-white border border-dashed border-gray-300 rounded-xl text-gray-500 text-sm">
                            Faktanya, tidak ada ulasan yang ditemukan di database. Pastikan data tabel `reviews` kamu sudah diisi.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    @endif
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliderTamu = document.getElementById('slider');
        const jarakGeserTamu = 324;
        let letakGeserTamu = 0;

        if (sliderTamu) {
            window.nextGuestSlide = function() {
                const batasMaksimalTamu = sliderTamu.scrollWidth - sliderTamu.parentElement.clientWidth;
                if (Math.abs(letakGeserTamu) < batasMaksimalTamu) {
                    letakGeserTamu -= jarakGeserTamu;
                    if (Math.abs(letakGeserTamu) > batasMaksimalTamu) {
                        letakGeserTamu = -batasMaksimalTamu;
                    }
                    sliderTamu.style.transform = `translateX(${letakGeserTamu}px)`;
                }
            };

            window.prevGuestSlide = function() {
                if (letakGeserTamu < 0) {
                    letakGeserTamu += jarakGeserTamu;
                    if (letakGeserTamu > 0) {
                        letakGeserTamu = 0;
                    }
                    sliderTamu.style.transform = `translateX(${letakGeserTamu}px)`;
                }
            };
        }
    });
</script>
@endsection