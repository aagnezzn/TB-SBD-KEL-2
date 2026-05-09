@extends('layouts.app')
<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@section('content')
<!--sub-navbar-->
@auth
{{-- NAVBAR PUTIH: Kita kasih 'relative' di sini sebagai JANGKAR UTAMA --}}
<div class="hidden lg:block bg-white border-b border-gray-200 relative">
    <div class="max-w-[1340px] mx-auto px-4">
        <ul class="flex justify-between items-center">
            @foreach($navCategories as $mainCat)
            {{-- LI harus STATIC agar kotak hitam di bawahnya bisa ambil lebar 100% dari div navbar --}}
            <li class="group/subnav static flex justify-center"> 
                
                {{-- ANCHOR: Kita kasih 'relative' di sini KHUSUS untuk JANGKAR SEGITIGA --}}
                <a href="/category/{{ $mainCat->slug }}" class="relative text-[13px] text-gray-600 hover:text-[#5624d0] whitespace-nowrap font-normal px-4 py-4 capitalize transition-colors flex flex-col items-center">
                    {{ $mainCat->name }}

                    {{-- SEGITIGA: Sekarang dia punya jangkar di anchor, pasti muncul tepat di bawah teks --}}
                    <div class="hidden group-hover/subnav:block absolute -bottom-[1px] w-0 h-0 border-l-[7px] border-l-transparent border-r-[7px] border-r-transparent border-b-[7px] border-b-[#1c1d1f] z-[160]"></div>
                </a>

                {{-- KOTAK HITAM: Karena LI-nya static, 'left-0' dan 'w-full' akan ambil lebar dari DIV NAVBAR (Layar Penuh) --}}
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
        {{-- === TAMPILAN SETELAH LOGIN (DASHBOARD) === --}}
        
        {{-- Sapaan User --}}
        <section class="max-w-[1340px] mx-auto px-4 py-8 flex items-center space-x-4">
            <div class="w-16 h-16 bg-[#1c1d1f] rounded-full flex items-center justify-center text-white text-2xl font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Jumpa lagi, {{ Auth::user()->name }}</h1>
                <p class="text-sm font-bold text-[#5624d0] cursor-pointer hover:text-[#401b9c]">{{__}}</p>
            </div>
        </section>

        {{-- Grid Kursus Rekomendasi --}}
      {{-- Grid Kursus Rekomendasi & Populer --}}
<section class="max-w-[1340px] mx-auto px-4 pb-12">
    <h2 class="text-2xl font-bold text-gray-900 mb-2">Apa yang akan dipelajari berikutnya</h2>
    <p class="text-lg font-bold text-gray-800 mb-6">Direkomendasikan untuk Anda</p>
    
    {{-- Tambah 'overflow-visible' di sini agar popup tidak terpotong --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2 relative overflow-visible">
        
        @foreach ($recommendedCourses as $course)
            {{-- Tambah 'group/item' dan 'relative' agar popup tahu harus muncul di mana --}}
            <div class="relative group/item">
                <a href="/course/{{ $course->id }}" class="group cursor-pointer flex flex-col h-full">
                    <div class="border border-gray-200 mb-2 relative overflow-hidden">
                        <img src="https://loremflickr.com/320/180/{{ $course->category->name ?? 'tech' }}?random={{ $course->id }}" 
                        alt="{{ $course->title }}" 
                        class="w-full h-32 object-cover"
                        onerror="this.onerror=null;this.src='https://picsum.photos/seed/{{ $course->id }}/320/180';">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    </div>
                    
                    <h3 class="text-[15px] font-bold text-gray-900 leading-tight mb-1 line-clamp-2 group-hover:text-[#5624d0]">
                        {{ $course->title }}
                    </h3>
                    <p class="text-xs text-gray-500 mb-1 truncate">{{ $course->user->name }}</p>
                    
                    <div class="flex items-center space-x-1 mb-1">
                        <span class="text-sm font-bold text-[#b4690e]">4.8</span>
                        <div class="flex text-[#b4690e] space-x-0.5">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M10 14.535l-4.954 3.033 1.182-5.484L2 8.223l5.545-.535L10 2l2.455 5.688 5.545.535-4.228 3.861 1.182 5.484z"/></svg>
                        </div>
                        <span class="text-xs text-gray-500">(1.234)</span>
                    </div>
                    
                    <div class="font-bold text-gray-900 text-base mb-2 mt-auto">
                        Rp{{ number_format($course->price, 0, ',', '.') }}
                    </div>

                    <div class="flex space-x-2">
                        <span class="bg-[#ecebfe] text-[#1e1e1c] text-[10px] font-bold px-1.5 py-0.5 flex items-center rounded-sm">
                            <span class="text-[#5624d0] font-black mr-1 text-xs leading-none">◈</span> Premium
                        </span>
                        <span class="bg-[#acd2cc] text-[#1e1e1c] text-[10px] font-bold px-2 py-0.5 rounded-sm">
                            Terlaris
                        </span>
                    </div>
                </a>

                {{-- Ganti class div popup detail kamu dengan ini --}}
<div class="absolute hidden group-hover/item:block z-[100] top-0 w-[330px] opacity-0 invisible group-hover/item:opacity-100 group-hover/item:visible transition-all duration-300 pointer-events-none group-hover/item:pointer-events-auto
    {{ $loop->iteration % 5 == 0 ? 'right-full -mr-1 pr-4' : 'left-full -ml-1 pl-4' }}">
    
    <div class="bg-white border border-gray-200 rounded-lg shadow-2xl p-5 relative">
        {{-- Segitiga Penunjuk (Juga harus dibalik kalau muncul di kiri) --}}
        <div class="absolute top-8 w-4 h-4 bg-white border-gray-200 rotate-45
            {{ $loop->iteration % 5 == 0 ? '-right-2 border-r border-t' : '-left-2 border-l border-b' }}">
        </div>
                        
                        <h3 class="font-bold text-lg mb-2 leading-tight">{{ $course->title }}</h3>
                        <p class="text-xs text-green-700 font-bold mb-3">Diperbarui April 2026</p>
                        
                        <ul class="text-sm text-gray-600 mb-5 space-y-2">
                            <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>Akses selamanya ke materi lengkap.</span></li>
                            <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>Sertifikat penyelesaian kursus.</span></li>
                            <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>Bisa diakses dari HP maupun Laptop.</span></li>
                        </ul>

                        <form action="{{ route('cart.add', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-purple-600 text-white py-3 font-bold rounded hover:bg-purple-700 transition">
                                Tambahkan ke keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>


            </div>


            <p class="text-lg font-bold text-gray-800 mb-6 mt-8">Kursus Populer</p>

{{-- Tambah 'overflow-visible' agar popup tidak terpotong ke samping --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2 relative overflow-visible">
    
    {{-- Loop Data dari Database untuk Populer --}}
    @foreach ($popularCourses as $course)
    {{-- Tambah 'group/item' dan 'relative' sebagai jangkar popup --}}
    <div class="relative group/item">
        <a href="/course/{{ $course->id }}" class="group cursor-pointer flex flex-col h-full">
            <div class="border border-gray-200 mb-2 relative overflow-hidden">
                <img src="https://loremflickr.com/320/180/{{ $course->category->name ?? 'tech' }}?random={{ $course->id }}" 
                alt="{{ $course->title }}" 
                class="w-full h-32 object-cover"
                onerror="this.onerror=null;this.src='https://picsum.photos/seed/{{ $course->id }}/320/180';">
                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
            </div>
            
            <h3 class="text-[15px] font-bold text-gray-900 leading-tight mb-1 line-clamp-2 group-hover:text-[#5624d0]">
                {{ $course->title }}
            </h3>
            <p class="text-xs text-gray-500 mb-1 truncate">{{ $course->user->name }}</p>
            
            <div class="flex items-center space-x-1 mb-1">
                <span class="text-sm font-bold text-[#b4690e]">4.8</span>
                <div class="flex text-[#b4690e] space-x-0.5">
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M10 14.535l-4.954 3.033 1.182-5.484L2 8.223l5.545-.535L10 2l2.455 5.688 5.545.535-4.228 3.861 1.182 5.484z"/></svg>
                </div>
                <span class="text-xs text-gray-500">(1.234)</span>
            </div>
            
            <div class="font-bold text-gray-900 text-base mb-2 mt-auto">
                Rp{{ number_format($course->price, 0, ',', '.') }}
            </div>

            <div class="flex space-x-2">
                <span class="bg-[#ecebfe] text-[#1e1e1c] text-[10px] font-bold px-1.5 py-0.5 flex items-center rounded-sm">
                    <span class="text-[#5624d0] font-black mr-1 text-xs leading-none">◈</span> Premium
                </span>
                <span class="bg-[#acd2cc] text-[#1e1e1c] text-[10px] font-bold px-2 py-0.5 rounded-sm">
                    Terlaris
                </span>
            </div>
        </a>

        {{-- Ganti class div popup detail kamu dengan ini --}}
<div class="absolute hidden group-hover/item:block z-[100] top-0 w-[330px] opacity-0 invisible group-hover/item:opacity-100 group-hover/item:visible transition-all duration-300 pointer-events-none group-hover/item:pointer-events-auto
    {{ $loop->iteration % 5 == 0 ? 'right-full -mr-1 pr-4' : 'left-full -ml-1 pl-4' }}">
    
    <div class="bg-white border border-gray-200 rounded-lg shadow-2xl p-5 relative">
        {{-- Segitiga Penunjuk (Juga harus dibalik kalau muncul di kiri) --}}
        <div class="absolute top-8 w-4 h-4 bg-white border-gray-200 rotate-45
            {{ $loop->iteration % 5 == 0 ? '-right-2 border-r border-t' : '-left-2 border-l border-b' }}">
        </div>
                
                <h3 class="font-bold text-lg mb-2 leading-tight">{{ $course->title }}</h3>
                <p class="text-xs text-green-700 font-bold mb-3">Diperbarui April 2026</p>
                
                <ul class="text-sm text-gray-600 mb-5 space-y-2">
                    <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>Materi terpopuler dengan ulasan positif.</span></li>
                    <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>Akses penuh seumur hidup.</span></li>
                    <li class="flex items-start gap-2 text-xs"><span>✓</span> <span>Sertifikat kursus setelah selesai.</span></li>
                </ul>

                <form action="{{ route('cart.add', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-purple-600 text-white py-3 font-bold rounded hover:bg-purple-700 transition">
                        Tambahkan ke keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

</div>
            </div>
        </section>
        @else
        {{-- === TAMPILAN SEBELUM LOGIN (GUEST) === --}}
        <section class="px-10 mt-4">
    <div class="max-w-[1350px] mx-auto">
    <div class="h-[350px] relative rounded-lg overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-right" style="background-image: url('{{ asset('udemy.jpg') }}')"></div>
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative h-full flex items-center">
            <div class="bg-white p-6 rounded shadow w-[450px] ml-10">
                <h2 class="text-3xl font-bold mb-3">{{ __('welcome.Bangun skill yang diminati') }}</h2>
                <p class="text-gray-600 mb-4">{{ __('welcome.Dapatkan') }}</p>
                <div class="flex space-x-3">
                    <button class="bg-purple-800 text-white px-4 py-2 rounded font-bold">{{ __('welcome.Dapatkan paket personal') }}</button>
                    <button class="border border-black font-bold px-4 py-2 rounded">{{ __('welcome.Pelajari AI') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<section class="px-10 py-16 bg-gray-100">
    <div class="max-w-[1350px] mx-auto">
    <div class="grid grid-cols-4 gap-8 items-start">
        <div>
            <h2 class="text-3xl font-bold mb-4">
           {{__('welcome.Pelajari skill')}}
            </h2>
            <p class="text-gray-600">
            {{ __('welcome.Udemy') }}
            </p>
        </div>
        <div class="col-span-3 relative">
            <div class="overflow-hidden">
                <div id="slider" class="flex gap-6 transition-transform duration-500">
    @foreach([
        // Nah, ini perhatikan, sekarang setiap baris sudah ada 3 data: [Gambar, Judul, Slug]
        ['ai.jpeg', 'AI Generatif', 'ai-generatif'],
        ['sertif.jpeg', 'Sertifikasi TI', 'sertifikasi-ti'],
        ['ilmu_data.jpeg', 'Ilmu Data', 'ilmu-data'],
        ['gpt.jpeg', 'ChatGPT', 'chat-gpt'],
        ['rekayasa_prompt.jpeg', 'Rekayasa Prompt', 'rekayasa-prompt'],
        ['microsoft_excel.jpeg', 'Microsoft Excel', 'microsoft-excel'],
        ['model.jpeg', 'Model Bahasa Besar', 'model-bahasa-besar'],
        ['pembelajaran_mesin.jpeg', 'Pembelajaran Mesin', 'pembelajaran-mesin'],
        ['agen_ai.jpeg', 'Agen AI', 'agen-ai'],
    ] as $item)
    
    <div class="min-w-[300px]">
        {{-- Karena di atas semua array sudah punya data ke-3 (index 2), baris ini nggak akan error lagi --}}
        <a href="{{ route('category.show', $item[2]) }}" class="block relative rounded-2xl overflow-hidden shadow group">
            
            <img src="{{ asset($item[0]) }}" class="w-full h-[300px] object-cover">
            
            <div class="absolute bottom-4 left-4 right-4 bg-white p-4 rounded-xl flex justify-between items-center group-hover:bg-gray-50 transition">
                <span class="font-semibold">{{ $item[1] }}</span>
                <span>→</span>
            </div>
            
        </a>
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
            <h2 class="text-3xl font-bold mb-4">{{ __('welcome.Transformasikan') }}<br>{{ __('welcome.AI era') }}</h2>
            <p class="text-gray-300 mb-8 text-sm leading-relaxed max-w-md">
                {{ __('welcome.Siapkan skill') }}
            </p>
            <div class="grid grid-cols-2 gap-y-5 gap-x-4 mb-8">
                <div class="flex items-center gap-3">
                    <div class="bg-purple-900/60 p-1.5 rounded-full text-purple-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="text-sm font-medium">{{ __('welcome.Pelajari AI dan lainnya') }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-green-900/60 p-1.5 rounded-full text-green-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-sm font-medium">{{__('welcome.Persiapkan') }} </span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-yellow-900/60 p-1.5 rounded-full text-yellow-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="text-sm font-medium">{{ __('welcome.Latihan') }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-blue-900/60 p-1.5 rounded-full text-blue-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <span class="text-sm font-medium">{{ __('welcome.Majukan') }}</span>
                </div>
            </div>
            <button class="bg-white text-gray-900 font-bold px-6 py-3 rounded hover:bg-gray-200 transition">
            {{ __('welcome.Pelajari selengkapnya') }}
            </button>
            <p class="text-xs text-gray-400 mt-4">{{ __('welcome.Mulai') }} </p>
        </div>
        
        <div class="w-full lg:w-1/2 h-[350px] rounded-2xl overflow-hidden">
            <img src="{{ asset('iklan.jpeg') }}" class="w-full h-full object-cover">
        </div>
    </div>
    </div>
</section>

<section class="px-10 py-12">
    <div class="max-w-[1350px] mx-auto" 
         x-data="{ 
            kategoriAktif: {{ $categories->first()->id ?? 0 }},
            scrollLeft() { $refs.sliderContent.scrollBy({ left: -300, behavior: 'smooth' }) },
            scrollRight() { $refs.sliderContent.scrollBy({ left: 300, behavior: 'smooth' }) }
         }">
         
        <h2 class="text-3xl font-bold mb-2">{{ __('welcome.Skill yang mengubah') }} </h2>
        <p class="text-gray-600 mb-6">{{ __('welcome.Mulai dari') }} </p>

        <div class="flex space-x-6 border-b border-gray-300 mb-6 text-sm font-semibold text-gray-500 overflow-x-auto hide-scrollbar">
            @foreach($categories as $category)
                <button @click="kategoriAktif = {{ $category->id }}" 
                        :class="kategoriAktif === {{ $category->id }} ? 'border-b-2 border-black text-black' : 'hover:text-black'" 
                        class="pb-2 transition-colors whitespace-nowrap capitalize">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>

        <div class="relative group">

            <button @click="scrollLeft()" class="absolute -left-5 top-1/2 -translate-y-1/2 bg-white border border-gray-300 w-10 h-10 rounded-full shadow-md flex items-center justify-center opacity-0 group-hover:opacity-100 transition z-10 hover:bg-gray-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <div x-ref="sliderContent" class="flex flex-nowrap overflow-x-auto gap-4 pb-4 hide-scrollbar scroll-smooth snap-x snap-mandatory">
                
                @if(!empty($categoriesData))
                    @foreach($categoriesData as $catId => $data)
                        @foreach($data['courses'] as $course)
                            
                            {{-- KARTU KURSUS DENGAN HOVERCARD POPOVER --}}
                            <div x-show="kategoriAktif === {{ $catId }}" 
                                 x-data="{ openDetail: false }"
                                 @mouseenter="openDetail = true"
                                 @mouseleave="openDetail = false"
                                 class="relative shrink-0 snap-start py-2">
                                
                                <div class="border border-gray-200 rounded-lg w-64 h-[280px] shrink-0 flex flex-col cursor-pointer group hover:shadow-md transition bg-white relative">
                                    
                                   <img src="@php $cName = strtolower($data['name']); if(str_contains($cName, 'python')){ echo asset('python.jpg'); }elseif(str_contains($cName, 'pemasaran') || str_contains($cName, 'marketing')){ echo asset('marketing.jpg'); }elseif(str_contains($cName, 'data') || str_contains($cName, 'science')){ echo asset('data.jpg'); }elseif(str_contains($cName, 'excel')){ echo asset('excel.jpg'); }elseif(str_contains($cName, 'javascript') || str_contains($cName, 'js')){ echo asset('javascript.jpg'); }elseif(str_contains($cName, 'proyek') || str_contains($cName, 'project')){ echo asset('project.jpg'); }else{ echo $course->image_url ? asset('storage/' . $course->image_url) : 'https://img-c.udemycdn.com/course/240x135/placeholder.jpg'; } @endphp" class="w-full h-32 object-cover rounded-t-lg border-b border-gray-100" alt="Course Image">
                                    
                                    <div class="p-3 flex flex-col grow justify-between">
                                        <div>
                                            <h3 class="font-bold text-xs leading-snug mb-1 group-hover:text-[#5624d0] line-clamp-2">
                                                {{ $course->title }}
                                            </h3>
                                            
                                            <p class="text-[10px] text-gray-500 mb-1">
                                                {{ optional($course->user)->name ?? 'Instructor' }}
                                            </p>
                                            
                                            <div class="flex items-center space-x-1 mb-1">
                                                @if($course->price < 150000)
                                                    <span class="bg-teal-100 text-teal-800 px-1 py-0.5 text-[9px] font-bold rounded">Terlaris</span>
                                                @endif
                                                <span class="text-yellow-700 font-bold text-[11px] ml-1">4.7</span>
                                                <svg class="w-2.5 h-2.5 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                <span class="text-[10px] text-gray-500">({{ rand(100, 5000) }})</span>
                                            </div>
                                        </div>
                                        
                                        <div class="font-bold text-xs">
                                            Rp{{ number_format($course->price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div x-show="openDetail"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 translate-x-2"
                                     x-transition:enter-end="opacity-100 translate-x-0"
                                     x-transition:leave="transition ease-in duration-100"
                                     class="absolute left-full top-0 ml-3 w-80 bg-white border border-gray-200 rounded-lg shadow-2xl z-50 p-6 text-gray-800"
                                     style="display: none;">
                                    
                                    <h4 class="font-bold text-sm mb-1 text-gray-950">{{ $course->title }}</h4>
                                    <p class="text-[10px] text-green-700 font-semibold mb-2">Terakhir Diperbarui: {{ optional($course->updated_at)->format('M Y') ?? 'Baru-baru ini' }}</p>
                                    
                                    <p class="text-[11px] text-gray-600 mb-4 line-clamp-4">
                                        {{ $course->description ?? 'Tidak ada deskripsi tambahan untuk kursus ini.' }}
                                    </p>

                                    <div class="space-y-2">
                                        <form action="/cart/add/{{ $course->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full bg-[#a435f0] hover:bg-[#8710d8] text-white py-2 rounded text-xs font-bold transition">
                                                Tambah ke Keranjang
                                            </button>
                                        </form>
                                        <a href="/course/{{ $course->id }}" class="block text-center border border-gray-300 hover:bg-gray-50 py-2 rounded text-xs font-bold transition">
                                            Lihat Detail Kursus
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endforeach
                @endif

            </div>

            <button @click="scrollRight()" class="absolute -right-5 top-1/2 -translate-y-1/2 bg-white border border-gray-300 w-10 h-10 rounded-full shadow-md flex items-center justify-center opacity-0 group-hover:opacity-100 transition z-10 hover:bg-gray-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <div class="mt-6">
            @if(!empty($categoriesData))
                @foreach($categoriesData as $catId => $data)
                    <a x-show="kategoriAktif === {{ $catId }}" 
                       href="/category/{{ $data['slug'] }}" 
                       class="text-purple-700 font-bold hover:text-purple-900 text-sm inline-flex items-center space-x-1">
                        <span>{{ __('welcome.Tampilkan') }}  {{ $data['name'] }}</span>
                        <span>&rarr;</span>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</section>

<section class="bg-gray-50 py-12 md:py-16">
    <div class="bg-gray-100 py-16 px-4">
    <p class="text-center text-slate-700 font-light text-lg mb-8 tracking-wide">
        {{ __('welcome.Dipercaya') }}
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


<script>
    let letakGeser = 0;
    const sliderKamu = document.getElementById('slider');
    const jarakGeser = 280; // Jarak geser per klik

    function nextSlide() {
        if(sliderKamu) {
            // Hitung sisa ruang maksimal untuk digeser
            // scrollWidth = panjang total semua kartu jika dibentangkan
            // clientWidth = panjang layar/wadah yang kelihatan saat ini
            const batasMaksimal = sliderKamu.scrollWidth - sliderKamu.parentElement.clientWidth;
            
            // Cek apakah posisi geser saat ini masih belum mencapai batas maksimal
            if (Math.abs(letakGeser) < batasMaksimal) {
                letakGeser -= jarakGeser;
                
                // Mencegah kebablasan: kalau hasil geser ternyata melewati batas,
                // kita paksa posisinya berhenti pas di ujung (batas maksimal)
                if (Math.abs(letakGeser) > batasMaksimal) {
                    letakGeser = -batasMaksimal;
                }
                
                sliderKamu.style.transform = `translateX(${letakGeser}px)`;
            }
        }
    }

    function prevSlide() {
        if(sliderKamu) {
            // Hanya geser balik ke kanan kalau posisinya tidak di titik awal (0)
            if (letakGeser < 0) {
                letakGeser += jarakGeser;
                
                // Mencegah kebablasan: kalau hasil geser bikin posisinya positif (kebablasan ke kiri),
                // kita paksa posisinya diam di titik 0 (paling awal)
                if (letakGeser > 0) {
                    letakGeser = 0;
                }
                
                sliderKamu.style.transform = `translateX(${letakGeser}px)`;
            }
        }
    }

    <div class="relative inline-block text-left z-50">
    <select onchange="location = this.value;" class="bg-white border border-gray-300 rounded-md px-3 py-1.5 text-xs font-medium text-gray-700 focus:outline-none cursor-pointer shadow-sm">
        <option value="{{ route('change.lang', 'id') }}" {{ app()->getLocale() == 'id' ? 'selected' : '' }}>🇮🇩 ID</option>
        <option value="{{ route('change.lang', 'en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇺🇸 EN</option>
        <option value="{{ route('change.lang', 'es') }}" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>🇪🇸 ES</option>
    </select>
</div>
</script>
@endsection