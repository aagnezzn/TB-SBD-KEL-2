@extends('layouts.app')

@section('content')
<!--sub-navbar-->
@auth
<div class="hidden lg:block bg-white border-b border-gray-200 relative">
    <div class="max-w-[1340px] mx-auto px-4">
        <ul class="flex justify-between items-center py-3">
            @foreach($navCategories as $mainCat)
            <li class="group/subnav static">
                <a href="/category/{{ $mainCat->slug }}" class="text-[13px] text-gray-600 hover:text-[#5624d0] whitespace-nowrap font-normal px-2 capitalize">
                    {{ $mainCat->name }}
                </a>
                <div class="absolute hidden group-hover/subnav:flex bg-[#1c1d1f] w-screen left-0 top-full z-[100] py-4 shadow-xl">
                    <div class="max-w-[1340px] mx-auto px-4 flex justify-center space-x-10">
                        @foreach($mainCat->children->take(5) as $subCat)
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
        {{-- === TAMPILAN SETELAH LOGIN (DASHBOARD) === --}}
        
        {{-- Sapaan User --}}
        <section class="max-w-[1340px] mx-auto px-4 py-8 flex items-center space-x-4">
            <div class="w-16 h-16 bg-[#1c1d1f] rounded-full flex items-center justify-center text-white text-2xl font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Jumpa lagi, {{ Auth::user()->name }}</h1>
                <p class="text-sm font-bold text-[#5624d0] cursor-pointer hover:text-[#401b9c]">Tambahkan pekerjaan dan minat</p>
            </div>
        </section>

        {{-- Grid Kursus Rekomendasi --}}
       {{-- Grid Kursus Rekomendasi & Populer --}}
        <section class="max-w-[1340px] mx-auto px-4 pb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Apa yang akan dipelajari berikutnya</h2>
            <p class="text-lg font-bold text-gray-800 mb-6">Direkomendasikan untuk Anda</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2 relative">
                
                {{-- Loop Data dari Database untuk Rekomendasi --}}
                @foreach ($courses as $course)
                <a href="/course/{{ $course->id }}" class="group cursor-pointer flex flex-col h-full">
                    <!-- Thumbnail -->
                    <div class="border border-gray-200 mb-2 relative overflow-hidden">
                        <img src="{{ $course->img }}" alt="{{ $course->title }}" class="w-full h-32 object-cover">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    </div>
                    
                    <!-- Info -->
                    <h3 class="text-[15px] font-bold text-gray-900 leading-tight mb-1 line-clamp-2 group-hover:text-[#5624d0]">
                        {{ $course->title }}
                    </h3>
                    <p class="text-xs text-gray-500 mb-1 truncate">{{ $course->author }}</p>
                    
                    <!-- Rating Pakai SVG -->
                    <div class="flex items-center space-x-1 mb-1">
                        <span class="text-sm font-bold text-[#b4690e]">{{ $course->rating }}</span>
                        <div class="flex text-[#b4690e] space-x-0.5">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M10 14.535l-4.954 3.033 1.182-5.484L2 8.223l5.545-.535L10 2l2.455 5.688 5.545.535-4.228 3.861 1.182 5.484z"/></svg>
                        </div>
                        <span class="text-xs text-gray-500">({{ $course->reviews }})</span>
                    </div>
                    
                    <!-- Harga -->
                    <div class="font-bold text-gray-900 text-base mb-2 mt-auto">
                        Rp{{ number_format($course->price, 0, ',', '.') }}
                    </div>

                    <!-- Badge -->
                    <div class="flex space-x-2">
                        <span class="bg-[#ecebfe] text-[#1e1e1c] text-[10px] font-bold px-1.5 py-0.5 flex items-center rounded-sm">
                            <span class="text-[#5624d0] font-black mr-1 text-xs leading-none">◈</span> Premium
                        </span>
                        <span class="bg-[#acd2cc] text-[#1e1e1c] text-[10px] font-bold px-2 py-0.5 rounded-sm">
                            Terlaris
                        </span>
                    </div>
                </a>
                @endforeach

            </div>

            <p class="text-lg font-bold text-gray-800 mb-6 mt-8">Kursus Populer</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2 relative">
                
                {{-- Loop Data dari Database untuk Populer --}}
                @foreach ($courses as $course)
                <a href="/course/{{ $course->id }}" class="group cursor-pointer flex flex-col h-full">
                    <!-- Thumbnail -->
                    <div class="border border-gray-200 mb-2 relative overflow-hidden">
                        <img src="{{ $course->img }}" alt="{{ $course->title }}" class="w-full h-32 object-cover">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    </div>
                    
                    <!-- Info -->
                    <h3 class="text-[15px] font-bold text-gray-900 leading-tight mb-1 line-clamp-2 group-hover:text-[#5624d0]">
                        {{ $course->title }}
                    </h3>
                    <p class="text-xs text-gray-500 mb-1 truncate">{{ $course->author }}</p>
                    
                    <!-- Rating Pakai SVG -->
                    <div class="flex items-center space-x-1 mb-1">
                        <span class="text-sm font-bold text-[#b4690e]">{{ $course->rating }}</span>
                        <div class="flex text-[#b4690e] space-x-0.5">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M10 14.535l-4.954 3.033 1.182-5.484L2 8.223l5.545-.535L10 2l2.455 5.688 5.545.535-4.228 3.861 1.182 5.484z"/></svg>
                        </div>
                        <span class="text-xs text-gray-500">({{ $course->reviews }})</span>
                    </div>
                    
                    <!-- Harga -->
                    <div class="font-bold text-gray-900 text-base mb-2 mt-auto">
                        Rp{{ number_format($course->price, 0, ',', '.') }}
                    </div>

                    <!-- Badge -->
                    <div class="flex space-x-2">
                        <span class="bg-[#ecebfe] text-[#1e1e1c] text-[10px] font-bold px-1.5 py-0.5 flex items-center rounded-sm">
                            <span class="text-[#5624d0] font-black mr-1 text-xs leading-none">◈</span> Premium
                        </span>
                        <span class="bg-[#acd2cc] text-[#1e1e1c] text-[10px] font-bold px-2 py-0.5 rounded-sm">
                            Terlaris
                        </span>
                    </div>
                </a>
                @endforeach

            </div>
        </section>

<section class="px-10 py-16 bg-gray-100">
    <div class="max-w-[1350px] mx-auto">
    <div class="grid grid-cols-4 gap-8 items-start">
        <div>
            <h2 class="text-3xl font-bold mb-4">
           Pelajari skill penting terkait karier dan kehidupan
            </h2>
            <p class="text-gray-600">
            Udemy membantu Anda membangun skill yang dibutuhkan dengan cepat dan memajukan karier Anda di pasar kerja yang terus berubah.
            </p>
        </div>
        <div class="col-span-3 relative">
            <div class="overflow-hidden">
                <div id="slider" class="flex gap-6 transition-transform duration-500">
                    @foreach([
                        ['ai.jpeg', 'AI Generatif'],
                        ['sertif.jpeg', 'Sertifikasi TI'],
                        ['ilmu_data.jpeg', 'Ilmu Data'],
                        ['gpt.jpeg', 'ChatGPT'],
                        ['rekayasa_prompt.jpeg', 'Rekayasa Prompt'],
                        ['microsoft_excel.jpeg', 'Microsoft Excel'],
                        ['model.jpeg', 'Model Bahasa Besar'],
                        ['pembelajaran_mesin.jpeg', 'Pembelajaran Mesin'],
                        ['agen_ai.jpeg', 'Agen AI'],
                    ] as $item)
                    <div class="min-w-[300px]">
                        <div class="relative rounded-2xl overflow-hidden shadow group">
                            <img src="{{ asset($item[0]) }}" class="w-full h-[300px] object-cover">
                            <div class="absolute bottom-4 left-4 right-4 bg-white p-4 rounded-xl flex justify-between items-center cursor-pointer hover:bg-gray-50 transition">
                                <span class="font-semibold">{{ $item[1] }}</span>
                                <span>→</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <button onclick="prevSlide()" class="absolute left-[-25px] top-1/2 -translate-y-1/2 bg-white border border-gray-200 w-10 h-10 rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition z-10">‹</button>
            <button onclick="nextSlide()" class="absolute right-[-25px] top-1/2 -translate-y-1/2 bg-white border border-gray-200 w-10 h-10 rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition z-10">›</button>
            <div class="flex justify-center mt-6 space-x-2" id="dots"></div>
        </div>
    </div>
</div>
</section>

<section class="px-10 py-10">
    <div class="max-w-[1350px] mx-auto">
    <div class="bg-[#232433] rounded-2xl p-12 flex flex-col lg:flex-row items-center gap-10">
        <div class="w-full lg:w-1/2 text-white">
            <h2 class="text-3xl font-bold mb-4">Transformasikan karier Anda di<br>AI era</h2>
            <p class="text-gray-300 mb-8 text-sm leading-relaxed max-w-md">
                Siapkan skill Anda untuk masa depan dengan Paket Personal. Dapatkan akses ke berbagai konten terbaru dari para pakar dunia nyata.
            </p>
            <div class="grid grid-cols-2 gap-y-5 gap-x-4 mb-8">
                <div class="flex items-center gap-3">
                    <div class="bg-purple-900/60 p-1.5 rounded-full text-purple-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="text-sm font-medium">Pelajari AI dan lainnya</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-green-900/60 p-1.5 rounded-full text-green-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-sm font-medium">Persiapkan untuk sertifikasi</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-yellow-900/60 p-1.5 rounded-full text-yellow-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="text-sm font-medium">Latihan dengan bimbingan AI</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-blue-900/60 p-1.5 rounded-full text-blue-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <span class="text-sm font-medium">Majukan karier Anda</span>
                </div>
            </div>
            <button class="bg-white text-gray-900 font-bold px-6 py-3 rounded hover:bg-gray-200 transition">
                Pelajari selengkapnya
            </button>
            <p class="text-xs text-gray-400 mt-4">Mulai Rp104.000/bulan</p>
        </div>
        
        <div class="w-full lg:w-1/2 h-[350px] rounded-2xl overflow-hidden">
            <img src="{{ asset('iklan.jpeg') }}" class="w-full h-full object-cover">
        </div>
    </div>
    </div>
</section>

<section class="px-10 py-12">
    <div class="max-w-[1350px] mx-auto">
    <h2 class="text-3xl font-bold mb-2">Skill yang mengubah karier dan kehidupan Anda</h2>
    <p class="text-gray-600 mb-6">Mulai dari topik dengan skill yang sangat penting hingga teknis, Udemy mendukung pengembangan profesional Anda.</p>

    <div class="flex space-x-6 border-b border-gray-300 mb-6 text-sm font-semibold text-gray-500">
        <button class="pb-2 border-b-2 border-black text-black">Python</button>
        <button class="pb-2 hover:text-black">Pemasaran Digital</button>
        <button class="pb-2 hover:text-black">Ilmu Data</button>
        <button class="pb-2 hover:text-black">Microsoft Excel</button>
        <button class="pb-2 hover:text-black">JavaScript</button>
        <button class="pb-2 hover:text-black">Perencanaan Proyek</button>
    </div>

    <div class="relative">
        <div class="grid grid-cols-4 gap-4">
            
            <div class="border border-gray-200 rounded-lg flex flex-col cursor-pointer group hover:shadow-md transition">
                <img src="{{ asset('python.jpg') }}" class="w-full h-36 object-cover rounded-t-lg border-b border-gray-100">
                <div class="p-4 flex flex-col grow">
                    <h3 class="font-bold text-base leading-snug mb-1 group-hover:text-purple-700 line-clamp-2">100 Days of Code™: The Complete Python Pro Bootcamp</h3>
                    <p class="text-xs text-gray-500 mb-2">Dr. Angela Yu, Developer and Lead Instructor</p>
                    <div class="flex items-center space-x-1 mb-2">
                        <span class="bg-teal-100 text-teal-800 px-1.5 py-0.5 text-[10px] font-bold rounded">Terlaris</span>
                        <span class="text-yellow-700 font-bold text-xs ml-1">4,7</span>
                        <svg class="w-3 h-3 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="text-xs text-gray-500">(421.133)</span>
                    </div>
                    <div class="font-bold text-lg mt-auto">Rp169.000</div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg flex flex-col cursor-pointer group hover:shadow-md transition">
                <img src="https://img-c.udemycdn.com/course/240x135/567828_67d0.jpg" class="w-full h-36 object-cover rounded-t-lg border-b border-gray-100">
                <div class="p-4 flex flex-col grow">
                    <h3 class="font-bold text-base leading-snug mb-1 group-hover:text-purple-700 line-clamp-2">The Complete Python Bootcamp From Zero to Hero in Python</h3>
                    <p class="text-xs text-gray-500 mb-2">Jose Portilla, Pierian Training</p>
                    <div class="flex items-center space-x-1 mb-2">
                        <span class="bg-purple-600 text-white px-1.5 py-0.5 text-[10px] font-bold rounded">Premium</span>
                        <span class="text-yellow-700 font-bold text-xs ml-1">4,6</span>
                        <svg class="w-3 h-3 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="text-xs text-gray-500">(560.310)</span>
                    </div>
                    <div class="font-bold text-lg mt-auto">Rp169.000</div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg flex flex-col cursor-pointer group hover:shadow-md transition">
                <img src="https://img-c.udemycdn.com/course/240x135/394676_ce3d_5.jpg" class="w-full h-36 object-cover rounded-t-lg border-b border-gray-100">
                <div class="p-4 flex flex-col grow">
                    <h3 class="font-bold text-base leading-snug mb-1 group-hover:text-purple-700 line-clamp-2">Python PCEP: Become Certified Entry-Level Python Programmer</h3>
                    <p class="text-xs text-gray-500 mb-2">Adrian Wiech</p>
                    <div class="flex items-center space-x-1 mb-2">
                        <span class="bg-teal-100 text-teal-800 px-1.5 py-0.5 text-[10px] font-bold rounded">Terlaris</span>
                        <span class="text-yellow-700 font-bold text-xs ml-1">4,7</span>
                        <svg class="w-3 h-3 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="text-xs text-gray-500">(12.030)</span>
                    </div>
                    <div class="font-bold text-lg mt-auto">Rp159.000</div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg flex flex-col cursor-pointer group hover:shadow-md transition">
                <img src="https://img-c.udemycdn.com/course/240x135/1565838_e54e_16.jpg" class="w-full h-36 object-cover rounded-t-lg border-b border-gray-100">
                <div class="p-4 flex flex-col grow">
                    <h3 class="font-bold text-base leading-snug mb-1 group-hover:text-purple-700 line-clamp-2">Kelas Python Lengkap 2026: Pemula Sampai Mahir (+Projects)</h3>
                    <p class="text-xs text-gray-500 mb-2">Risdan Kristori, BAYOU DATA</p>
                    <div class="flex items-center space-x-1 mb-2 mt-4">
                        <span class="text-yellow-700 font-bold text-xs ml-1">4,7</span>
                        <svg class="w-3 h-3 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="text-xs text-gray-500">(316)</span>
                    </div>
                    <div class="font-bold text-lg mt-auto">Rp169.000</div>
                </div>
            </div>

        </div>

        <button class="absolute right-20px top-1/2 -translate-y-1/2 bg-white border border-gray-300 w-12 h-12 rounded-full shadow-md flex items-center justify-center hover:bg-gray-50 transition z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>

    <div class="mt-6">
        <a href="#" class="text-purple-700 font-bold hover:text-purple-900 text-sm">
            Tampilkan semua kursus Python &rarr;
        </a>
    </div>
</div>
</section>

<section class="bg-gray-50 py-12 md:py-16">
    <div class="bg-gray-100 py-16 px-4">
    <p class="text-center text-slate-700 font-light text-lg mb-8 tracking-wide">
        Dipercaya oleh lebih dari 17.000 perusahaan dan jutaan pembelajar di seluruh dunia
    </p>

    <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-8 max-w-7xl mx-auto">
        
        <div class="flex items-center justify-center">
            <img src="{{ asset('vw.png') }}" class="h-20 w-auto grayscale opacity-70" alt="VW">
        </div>

        <div class="flex items-center justify-center">
            <img src="{{ asset('samsung.png') }}" class="h-20 w-auto grayscale opacity-70" alt="Samsung">
        </div>

        <div class="flex items-center justify-center">
            <img src="{{ asset('cisco.png') }}" class="h-14 w-auto grayscale opacity-70" alt="Cisco">
        </div>

        <div class="flex items-center justify-center">
            <img src="{{ asset('vimeo.png') }}" class="h-10 w-auto grayscale opacity-70" alt="Vimeo">
        </div>

        <div class="flex items-center justify-center">
            <img src="{{ asset('pg.png') }}" class="h-20 w-auto grayscale opacity-70" alt="P&G">
        </div>

        <div class="flex items-center justify-center">
            <img src="{{ asset('hpe.png') }}" class="h-14 w-auto grayscale opacity-70" alt="HPE">
        </div>

        <div class="flex items-center justify-center">
            <img src="{{ asset('citi.png') }}" class="h-14 w-auto grayscale opacity-70" alt="Citi">
        </div>

        <div class="flex items-center justify-center">
            <img src="{{ asset('ericsson.png') }}" class="h-14 w-auto grayscale opacity-70" alt="Ericsson">
        </div>

    </div>
</div>
</section>

<section class="px-10 py-16 bg-gray-50">
    <div class="max-w-[1350px] mx-auto">
    <h2 class="text-3xl font-bold mb-8 max-w-2xl text-gray-900">
        Bergabung dengan orang lain untuk mengubah hidup mereka melalui pembelajaran
    </h2>
    <div class="grid grid-cols-4 gap-6">
        
        <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col shadow-sm">
            <svg class="w-8 h-8 mb-4 text-gray-800" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            <p class="text-gray-700 mb-6 grow text-sm leading-relaxed">
                Kursus ini menjelaskan AI dengan sangat baik, dari tahap pengembangan hingga penerapan. Beragam perspektif yang diberikan membantu saya memahami cara menggunakan AI secara bertanggung jawab sebagai alat kerja, bukan sekadar tren.
            </p>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="font-bold text-sm">Cris M.</p>
                    <p class="text-xs text-gray-500">Google AI Essentials graduate</p>
                </div>
            </div>
            <a href="#" class="text-purple-700 font-bold hover:text-purple-900 text-sm mt-auto border-t border-gray-100 pt-4 block">
                Lihat kursus AI &rarr;
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col shadow-sm">
            <svg class="w-8 h-8 mb-4 text-gray-800" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            <p class="text-gray-700 mb-6 grow text-sm leading-relaxed">
                Udemy benar-benar <strong>pembawa perubahan dan pemandu hebat</strong> bagi saya saat Dimensional diluncurkan.
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
            <a href="#" class="text-purple-700 font-bold hover:text-purple-900 text-sm mt-auto border-t border-gray-100 pt-4 block">
                Lihat kursus iOS & Swift &rarr;
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col shadow-sm">
            <svg class="w-8 h-8 mb-4 text-gray-800" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            <p class="text-gray-700 mb-6 grow text-sm leading-relaxed">
                Udemy memberikan Anda kegigihan. Saya mempelajari hal yang benar-benar saya perlukan di dunia nyata. Ini membantu saya <strong>mendapatkan pekerjaan baru.</strong>
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
            <a href="#" class="text-purple-700 font-bold hover:text-purple-900 text-sm mt-auto border-t border-gray-100 pt-4 block">
                Lihat kursus AWS ini &rarr;
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col shadow-sm">
            <svg class="w-8 h-8 mb-4 text-gray-800" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            <p class="text-gray-700 mb-6 grow text-sm leading-relaxed">
                Saya sangat menyukai kursus tentang AI Studio. Awalnya saya belum mengenal alat ini, tetapi setelah mengikuti kursus, saya langsung menerapkannya untuk firma hukum saya.
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
            <a href="#" class="text-purple-700 font-bold hover:text-purple-900 text-sm mt-auto border-t border-gray-100 pt-4 block">
                Sertifikat Profesional Google AI &rarr;
            </a>
        </div>

    </div>
    </div>

<section class="px-14 py-12">
    <div class="bg-[#232433] rounded-xl p-20 flex flex-col lg:flex-row items-center justify-between gap-10 overflow-hidden">
        
        <div class="w-full lg:w-[30%]">
            <h2 class="text-3xl font-bold text-white mb-4 leading-tight">
                Dapatkan sertifikasi dan<br>maju dalam karier Anda
            </h2>
            <p class="text-gray-300 mb-8 text-sm leading-relaxed pr-4">
                Persiapkan diri untuk sertifikasi dengan kursus yang komprehensif, simulasi ujian, dan penawaran khusus voucher ujian.
            </p>
            <a href="#" class="text-white font-bold hover:underline flex items-center text-sm transition">
                Jelajahi sertifikasi dan voucer 
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <div class="w-full lg:w-[60%] grid grid-cols-1 md:grid-cols-3 gap-4">
            
            <a href="#" class="bg-[#303246] rounded-lg p-4 flex flex-col hover:bg-[#3b3d4f] transition">
                <img src="{{ asset('comptia.png') }}" alt="CompTIA" class="w-full h-auto rounded-md mb-4 object-cover">
                <h3 class="text-white font-bold text-lg mb-1">CompTIA</h3>
                <p class="text-gray-400 text-xs">Cloud, Jejaring, Keamanan Siber</p>
            </a>

            <a href="#" class="bg-[#303246] rounded-lg p-4 flex flex-col hover:bg-[#3b3d4f] transition">
                <img src="{{ asset('aws.png') }}" alt="AWS" class="w-full h-auto rounded-md mb-4 object-cover">
                <h3 class="text-white font-bold text-lg mb-1">AWS</h3>
                <p class="text-gray-400 text-xs">Cloud, AI, Coding, Jejaring</p>
            </a>

            <a href="#" class="bg-[#303246] rounded-lg p-4 flex flex-col hover:bg-[#3b3d4f] transition">
                <img src="{{ asset('pmi.png') }}" alt="PMI" class="w-full h-auto rounded-md mb-4 object-cover">
                <h3 class="text-white font-bold text-lg mb-1">PMI</h3>
                <p class="text-gray-400 text-xs">Manajemen Proyek & Program</p>
            </a>

        </div>
    </div>
</section>


<section class="w-screen bg-gray-100 pt-16 pb-0 m-0 left-1/2 ml-[-50vw] relative">
    <div class="max-w-full mx-auto px-10">
    <h2 class="text-3xl font-bold text-gray-900 mb-4">Skill Populer</h2>
    <hr class="border-gray-300 mb-10">

    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        
        <div class="flex flex-col">
            <h3 class="text-2xl font-bold text-gray-900 mb-4 leading-tight">ChatGPT adalah skill teratas</h3>
            <a href="#" class="text-[#5624d0] font-bold text-base flex items-center hover:underline group w-max">
                Lihat ChatGPT kursus
                <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <p class="text-sm text-gray-500 mt-1 mb-8">5.576.646 pembelajar</p>
            
            <a href="#" class="border border-[#5624d0] text-[#5624d0] font-bold px-4 py-2.5 rounded hover:bg-[#5624d0]/5 transition w-max flex items-center text-sm">
                Tampilkan semua skill yang sedang tren
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H7M17 7V17"></path></svg>
            </a>
        </div>

        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-6">Pengembangan</h3>
            <div class="space-y-6">
                <div>
                    <a href="#" class="text-[#5624d0] font-bold text-base flex items-center hover:underline group w-max">
                        Python 
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <p class="text-sm text-gray-500 mt-1">50.467.049 pembelajar</p>
                </div>
                <div>
                    <a href="#" class="text-[#5624d0] font-bold text-base flex items-center hover:underline group w-max">
                        Pengembangan Web 
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <p class="text-sm text-gray-500 mt-1">14.538.258 pembelajar</p>
                </div>
                <div>
                    <a href="#" class="text-[#5624d0] font-bold text-base flex items-center hover:underline group w-max">
                        Ilmu Data 
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <p class="text-sm text-gray-500 mt-1">8.406.501 pembelajar</p>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-6">Desain</h3>
            <div class="space-y-6">
                <div>
                    <a href="#" class="text-[#5624d0] font-bold text-base flex items-center hover:underline group w-max">
                        Blender 
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <p class="text-sm text-gray-500 mt-1">3.135.853 pembelajar</p>
                </div>
                <div>
                    <a href="#" class="text-[#5624d0] font-bold text-base flex items-center hover:underline group w-max">
                        AutoCAD 
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <p class="text-sm text-gray-500 mt-1">2.156.576 pembelajar</p>
                </div>
                <div>
                    <a href="#" class="text-[#5624d0] font-bold text-base flex items-center hover:underline group w-max">
                        Desain Grafis 
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <p class="text-sm text-gray-500 mt-1">4.710.142 pembelajar</p>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-6">Bisnis</h3>
            <div class="space-y-6">
                <div>
                    <a href="#" class="text-[#5624d0] font-bold text-base flex items-start hover:underline group">
                        <span>PMI Project Management Professional (PMP)</span> 
                        <svg class="w-4 h-4 ml-1 mt-1 shrink-0 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <p class="text-sm text-gray-500 mt-1">2.930.472 pembelajar</p>
                </div>
                <div>
                    <a href="#" class="text-[#5624d0] font-bold text-base flex items-center hover:underline group w-max">
                        Microsoft Power BI 
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <p class="text-sm text-gray-500 mt-1">5.213.210 pembelajar</p>
                </div>
                <div>
                    <a href="#" class="text-[#5624d0] font-bold text-base flex items-start hover:underline group">
                        <span>PMI Certified Associate in Project Management (CAPM)</span> 
                        <svg class="w-4 h-4 ml-1 mt-1 shrink-0 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <p class="text-sm text-gray-500 mt-1">500.957 pembelajar</p>
                </div>
            </div>
        </div>

    </div>
</section>
    @endauth
</main>



@endsection