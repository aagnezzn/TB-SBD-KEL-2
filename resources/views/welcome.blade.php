@extends('layouts.app')

<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

@section('content')
@auth
{{-- NAVBAR KATEGORI (Hanya muncul saat User sudah Login) --}}
<div class="hidden lg:block bg-white border-b border-gray-200 relative">
    <div class="max-w-[1340px] mx-auto px-4">
        <ul class="flex justify-between items-center">
            @foreach($navCategories as $mainCat)
            <li class="group/subnav static flex justify-center"> 
                <a href="/category/{{ $mainCat->slug }}" class="relative text-[13px] text-gray-600 hover:text-[#5624d0] whitespace-nowrap font-normal px-4 py-4 capitalize transition-colors flex flex-col items-center">
                    {{ $mainCat->name }}
                    <div class="hidden group-hover/subnav:block absolute -bottom-[1px] w-0 h-0 border-l-[7px] border-l-transparent border-r-[7px] border-r-transparent border-b-[7px] border-b-[#1c1d1f] z-[160]"></div>
                </a>

                <div class="absolute hidden group-hover/subnav:flex bg-[#1c1d1f] w-full left-0 top-full z-[150] py-4 shadow-xl 
                    before:content-[''] before:absolute before:-top-4 before:left-0 before:w-full before:h-4">
                    <div class="max-w-[1340px] mx-auto px-4 flex justify-center space-x-10">
                        @foreach($mainCat->children->take(8) as $subCat)
                        <a href="/category/{{ $subCat->slug }}" class="text-[13px] font-normal text-white hover:text-gray-300 whitespace-nowrap transition-colors capitalize">
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
        {{-- === TAMPILAN SETELAH LOGIN (SUDAH DISINKRONKAN DENGAN FOTO) === --}}
<section class="max-w-[1340px] mx-auto px-4 py-8 flex items-center space-x-4">
    <div class="w-16 h-16 shrink-0">
        @if(Auth::user()->profile && Auth::user()->profile->photo)
            {{-- Menampilkan foto profil jika ada --}}
            <img src="{{ asset('storage/photos/' . Auth::user()->profile->photo) }}" 
                 class="w-16 h-16 rounded-full object-cover">
        @else
            {{-- Fallback ke inisial hitam jika foto tidak ada --}}
            <div class="w-16 h-16 bg-[#1c1d1f] rounded-full flex items-center justify-center text-white text-2xl font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
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
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2 relative overflow-visible">
                @foreach ($recommendedCourses as $course)
                    <div class="relative group/item">
                        <a href="/course/{{ $course->id }}" class="group cursor-pointer flex flex-col h-full">
                            <div class="border border-gray-200 mb-2 relative overflow-hidden">
                                <img src="{{ $course->image_url ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3' }}" 
                                     alt="{{ $course->title }}" 
                                     class="w-full h-32 object-cover"
                                     onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3';">
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                            </div>
                            
                            <h3 class="text-[15px] font-bold text-gray-900 leading-tight mb-1 line-clamp-2 group-hover:text-[#5624d0]">
                                {{ $course->title }}
                            </h3>
                            <p class="text-xs text-gray-500 mb-1 truncate">{{ $course->user->name ?? 'Instruktur Anonim' }}</p>
                            
                            <div class="flex items-center space-x-1 mb-1">
                                <span class="text-sm font-bold text-[#b4690e]">
                                    {{ number_format($course->reviews()->avg('rating') ?? 4.5, 1) }}
                                </span>
                                <div class="flex text-[#b4690e] space-x-0.5">
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M10 14.535l-4.954 3.033 1.182-5.484L2 8.223l5.545-.535L10 2l2.455 5.688 5.545.535-4.228 3.861 1.182 5.484z"/></svg>
                                </div>
                                <span class="text-xs text-gray-500">({{ $course->reviews()->count() }})</span>
                            </div>
                            
                            <div class="font-bold text-gray-900 text-base mb-2 mt-auto">
                                Rp{{ number_format($course->price, 0, ',', '.') }}
                            </div>

                            <div class="flex space-x-2">
                                <span class="bg-[#ecebfe] text-[#1e1e1c] text-[10px] font-bold px-1.5 py-0.5 flex items-center rounded-sm">
                                    <span class="text-[#5624d0] font-black mr-1 text-xs leading-none">◈</span> {{__('welcome.Premium') }}
                                </span>
                                <span class="bg-[#acd2cc] text-[#1e1e1c] text-[10px] font-bold px-2 py-0.5 rounded-sm">
                                    {{ __('welcome.Terlaris') }}
                                </span>
                            </div>
                        </a>

                        {{-- Popup Detail Kursus Rekomendasi --}}
                        <div class="absolute hidden group-hover/item:block z-[100] top-0 w-[330px] transition-all duration-300 pointer-events-none group-hover/item:pointer-events-auto {{ $loop->iteration % 5 == 0 ? 'right-full -mr-1 pr-4' : 'left-full -ml-1 pl-4' }}">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-2xl p-5 relative">
                                <div class="absolute top-8 w-4 h-4 bg-white border-gray-200 rotate-45 {{ $loop->iteration % 5 == 0 ? '-right-2 border-r border-t' : '-left-2 border-l border-b' }}"></div>
                                        
                                <h3 class="font-bold text-lg mb-2 leading-tight">{{ $course->title }}</h3>
                                <p class="text-xs text-green-700 font-bold mb-3">{{__('welcome.Diperbarui')}}</p>
                                
                                <ul class="text-sm text-gray-600 mb-5 space-y-2">
                                    <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>{{__('welcome.Akses')}}</span></li>
                                    <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>{{__('welcome.Sertifikat') }} </span></li>
                                    <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>{{__('welcome.Bisa')}}</span></li>
                                </ul>

                                <form action="{{ route('cart.add', $course->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-purple-600 text-white py-3 font-bold rounded hover:bg-purple-700 transition">
                                        {{__('welcome.Tambahkan ke keranjang')}}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="text-lg font-bold text-gray-800 mb-6 mt-8">{{__('welcome.Kursus Populer')}}</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2 relative overflow-visible">
                @foreach ($popularCourses as $course)
                <div class="relative group/item">
                    <a href="/course/{{ $course->id }}" class="group cursor-pointer flex flex-col h-full">
                        <div class="border border-gray-200 mb-2 relative overflow-hidden">
                            <img src="{{ $course->image_url ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3' }}" 
                                 alt="{{ $course->title }}" 
                                 class="w-full h-32 object-cover"
                                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3';">
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                        </div>
                        
                        <h3 class="text-[15px] font-bold text-gray-900 leading-tight mb-1 line-clamp-2 group-hover:text-[#5624d0]">
                            {{ $course->title }}
                        </h3>
                        <p class="text-xs text-gray-500 mb-1 truncate">{{ $course->user->name ?? 'Instruktur Anonim' }}</p>
                        
                        <div class="flex items-center space-x-1 mb-1">
                            <span class="text-sm font-bold text-[#b4690e]">
                                {{ number_format($course->reviews()->avg('rating') ?? 4.5, 1) }}
                            </span>
                            <div class="flex text-[#b4690e] space-x-0.5">
                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M10 14.535l-4.954 3.033 1.182-5.484L2 8.223l5.545-.535L10 2l2.455 5.688 5.545.535-4.228 3.861 1.182 5.484z"/></svg>
                            </div>
                            <span class="text-xs text-gray-500">({{ $course->reviews()->count() }})</span>
                        </div>
                        
                        <div class="font-bold text-gray-900 text-base mb-2 mt-auto">
                            Rp{{ number_format($course->price, 0, ',', '.') }}
                        </div>

                        <div class="flex space-x-2">
                            <span class="bg-[#ecebfe] text-[#1e1e1c] text-[10px] font-bold px-1.5 py-0.5 flex items-center rounded-sm">
                                <span class="text-[#5624d0] font-black mr-1 text-xs leading-none">◈</span>{{__('welcome.Premium') }}
                            </span>
                            <span class="bg-[#acd2cc] text-[#1e1e1c] text-[10px] font-bold px-2 py-0.5 rounded-sm">
                               {{ __('welcome.Terlaris') }}
                            </span>
                        </div>
                    </a>

                    {{-- Pop-up Detail Kursus Populer --}}
                    <div class="absolute hidden group-hover/item:block z-[100] top-0 w-[330px] transition-all duration-300 pointer-events-none group-hover/item:pointer-events-auto {{ $loop->iteration % 5 == 0 ? 'right-full -mr-1 pr-4' : 'left-full -ml-1 pl-4' }}">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-2xl p-5 relative">
                            <div class="absolute top-8 w-4 h-4 bg-white border-gray-200 rotate-45 {{ $loop->iteration % 5 == 0 ? '-right-2 border-r border-t' : '-left-2 border-l border-b' }}"></div>
                                    
                            <h3 class="font-bold text-lg mb-2 leading-tight">{{ $course->title }}</h3>
                            <p class="text-xs text-green-700 font-bold mb-3">{{__('welcome.Diperbarui')}}</p>
                            
                            <ul class="text-sm text-gray-600 mb-5 space-y-2">
                                <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>{{__('welcome.Materi')}}</span></li>
                                <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>{{__('welcome.Akses')}} </span></li>
                                <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>{{__('welcome.Sertifikat kursus')}} </span></li>
                            </ul>

                            <form action="{{ route('cart.add', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-purple-600 text-white py-3 font-bold rounded hover:bg-purple-700 transition">
                                    {{__('welcome.Tambahkan ke keranjang')}}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        
        {{-- Bagian Brand Korporat --}}
        <section class="bg-gray-100 py-12 md:py-16 border-t border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4">
                <p class="text-center text-slate-600 font-medium text-base mb-8 tracking-wide">
                    {{ __('welcome.Dipercaya') }}
                </p>
                <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-8">
                    <div class="flex items-center justify-center"><img src="{{ asset('vw.png') }}" class="h-16 w-auto grayscale opacity-60 hover:opacity-100 transition" alt="VW"></div>
                    <div class="flex items-center justify-center"><img src="{{ asset('samsung.png') }}" class="h-16 w-auto grayscale opacity-60 hover:opacity-100 transition" alt="Samsung"></div>
                    <div class="flex items-center justify-center"><img src="{{ asset('cisco.png') }}" class="h-12 w-auto grayscale opacity-60 hover:opacity-100 transition" alt="Cisco"></div>
                    <div class="flex items-center justify-center"><img src="{{ asset('vimeo.png') }}" class="h-8 w-auto grayscale opacity-60 hover:opacity-100 transition" alt="Vimeo"></div>
                    <div class="flex items-center justify-center"><img src="{{ asset('pg.png') }}" class="h-16 w-auto grayscale opacity-60 hover:opacity-100 transition" alt="P&G"></div>
                    <div class="flex items-center justify-center"><img src="{{ asset('hpe.png') }}" class="h-12 w-auto grayscale opacity-60 hover:opacity-100 transition" alt="HPE"></div>
                    <div class="flex items-center justify-center"><img src="{{ asset('citi.png') }}" class="h-12 w-auto grayscale opacity-60 hover:opacity-100 transition" alt="Citi"></div>
                    <div class="flex items-center justify-center"><img src="{{ asset('ericsson.png') }}" class="h-12 w-auto grayscale opacity-60 hover:opacity-100 transition" alt="Ericsson"></div>
                </div>
            </div>
        </section>

        {{-- Ulasan Pengguna --}}
        <section class="px-10 py-16 bg-gray-50">
            <div class="max-w-[1350px] mx-auto">
                <h2 class="text-3xl font-bold mb-8 max-w-2xl text-gray-900">
                    {{ __('welcome.Bergabung') }}
                </h2>
                <div class="grid grid-cols-4 gap-6">
                    <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col shadow-sm">
                        <svg class="w-8 h-8 mb-4 text-gray-800" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                        <p class="text-gray-700 mb-6 grow text-sm leading-relaxed">
                            {{ __('welcome.Kursus ini menjelaskan') }}
                        </p>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-bold text-sm">Cris M.</p>
                                <p class="text-xs text-gray-500">{{ __('welcome.Google AI') }} </p>
                            </div>
                        </div>
                        <a href="#" class="text-purple-700 font-bold hover:text-purple-900 text-sm mt-auto border-t border-gray-100 pt-4 block">Lihat kursus AI &rarr;</a>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col shadow-sm">
                        <svg class="w-8 h-8 mb-4 text-gray-800" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                        <p class="text-gray-700 mb-6 grow text-sm leading-relaxed">
                            {{__('welcome.idemy benar-benar')}} <strong>{{__('welcome.pembawa')}} </strong> {{__('welcome.bagi')}}
                        </p>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://randomuser.me/api/portraits/men/45.jpg" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-bold text-sm">Alvin Lim</p>
                                <p class="text-xs text-gray-500">Technical Co-Founder, CTO di Dimensional</p>
                            </div>
                        </div>
                        <a href="#" class="text-purple-700 font-bold hover:text-purple-900 text-sm mt-auto border-t border-gray-100 pt-4 block">Lihat kursus iOS & Swift &rarr;</a>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col shadow-sm">
                        <svg class="w-8 h-8 mb-4 text-gray-800" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                        <p class="text-gray-700 mb-6 grow text-sm leading-relaxed">
                            {{__('welcome.Udemy memberikan')}}<strong>{{__('welcome.mendapatkan')}} </strong>
                        </p>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://randomuser.me/api/portraits/men/22.jpg" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-bold text-sm">William A. Wachlin</p>
                                <p class="text-xs text-gray-500">Partner Account Manager di AWS</p>
                            </div>
                        </div>
                        <a href="#" class="text-purple-700 font-bold hover:text-purple-900 text-sm mt-auto border-t border-gray-100 pt-4 block">Lihat kursus AWS ini &rarr;</a>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col shadow-sm">
                        <svg class="w-8 h-8 mb-4 text-gray-800" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                        <p class="text-gray-700 mb-6 grow text-sm leading-relaxed">
                            {{__('welcome.Saya')}} 
                        </p>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://randomuser.me/api/portraits/men/85.jpg" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-bold text-sm">Ben C.</p>
                                <p class="text-xs text-gray-500">Google AI Professional graduate</p>
                            </div>
                        </div>
                        <a href="#" class="text-purple-700 font-bold hover:text-purple-900 text-sm mt-auto border-t border-gray-100 pt-4 block">Sertifikat Profesional Google AI &rarr;</a>
                    </div>
                </div>
            </div>
        </section>

    @else
        {{-- === TAMPILAN GUEST (DIAMBIL MURNI DARI KODE KEDUA) === --}}
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
                                        <a href="{{ url('/category/' . $cat->slug) }}" class="block relative rounded-2xl overflow-hidden shadow group bg-white">
                                            <img src="{{ asset($imgName) }}" class="w-full h-[300px] object-cover" alt="{{ $cat->name }}"
                                                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640';">
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
                        <button onclick="prevGuestSlide()" class="absolute left-[-25px] top-1/2 -translate-y-1/2 bg-white border border-gray-200 w-10 h-10 rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition z-10">‹</button>
                        <button onclick="nextGuestSlide()" class="absolute right-[-25px] top-1/2 -translate-y-1/2 bg-white border border-gray-200 w-10 h-10 rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition z-10">›</button>
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
                    <img src="{{ asset('samsung.png') }}" class="h-16 w-auto grayscale opacity-60" alt="Samsung">
                    <img src="{{ asset('cisco.png') }}" class="h-12 w-auto grayscale opacity-60" alt="Cisco">
                </div>
            </div>
        </section>

        {{-- ULASAN SISWA GLOBAL BERVARIASI --}}
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