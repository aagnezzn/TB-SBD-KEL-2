@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-12 mt-10">
    
    <!-- HEADER -->
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>
    <p class="text-gray-700 mb-16">
        <span class="font-bold italic">Keranjang Anda kosong</span> – mari ubah itu. Saatnya mempelajari beberapa skill baru.
    </p>

    <!-- SECTION: PEMBELAJAR MELIHAT -->
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Pembelajar melihat</h2>

    <!-- Pembungkus Scroll Horizontal (Bisa digeser ke samping) -->
    <div class="flex overflow-x-auto gap-4 pb-8 relative snap-x">

        <!-- KARTU KURSUS 1 -->
        <div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group snap-start">
            <img src="{{ asset('python_course.jpg') }}" alt="Python" class="w-full h-36 object-cover border border-gray-200 mb-2 group-hover:opacity-90">
            <h3 class="font-bold text-gray-900 text-base leading-tight mb-1 group-hover:text-purple-700">Pemrograman Python : Pemula sampai Mahir</h3>
            <p class="text-xs text-gray-500 mb-1">Programmer Zaman Now</p>
            <div class="flex items-center gap-1 text-xs mb-1">
                <span class="font-bold text-yellow-700">4,9</span>
                <div class="flex text-yellow-500">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <!-- Anggap aja ini bintangnya berjejer 5 ya -->
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                <span class="text-gray-500">(73)</span>
            </div>
            <p class="font-bold text-gray-900 text-base mb-2">Rp169.000</p>
        </div>

        <!-- KARTU KURSUS 2 -->
        <div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group snap-start">
            <img src="{{ asset('go_course.jpg') }}" alt="Go-Lang" class="w-full h-36 object-cover border border-gray-200 mb-2 group-hover:opacity-90">
            <h3 class="font-bold text-gray-900 text-base leading-tight mb-1 group-hover:text-purple-700">Pemrograman Go-Lang : Pemula sampai Mahir</h3>
            <p class="text-xs text-gray-500 mb-1">Programmer Zaman Now</p>
            <div class="flex items-center gap-1 text-xs mb-1">
                <span class="font-bold text-yellow-700">4,9</span>
                <div class="flex text-yellow-500">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                <span class="text-gray-500">(3.783)</span>
            </div>
            <p class="font-bold text-gray-900 text-base mb-2">Rp169.000</p>
            <div><span class="bg-[#eceb98] text-[#3d3c0a] text-xs font-bold px-2 py-0.5">Terlaris</span></div>
        </div>

        <!-- KARTU KURSUS 3 -->
        <div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group snap-start">
            <img src="{{ asset('js_course.jpg') }}" alt="JavaScript" class="w-full h-36 object-cover border border-gray-200 mb-2 group-hover:opacity-90">
            <h3 class="font-bold text-gray-900 text-base leading-tight mb-1 group-hover:text-purple-700">HTML, CSS dan JavaScript : Pemula sampai Mahir</h3>
            <p class="text-xs text-gray-500 mb-1">Programmer Zaman Now</p>
            <div class="flex items-center gap-1 text-xs mb-1">
                <span class="font-bold text-yellow-700">4,7</span>
                <div class="flex text-yellow-500">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                <span class="text-gray-500">(2.868)</span>
            </div>
            <p class="font-bold text-gray-900 text-base mb-2">Rp169.000</p>
            <div><span class="bg-[#eceb98] text-[#3d3c0a] text-xs font-bold px-2 py-0.5">Terlaris</span></div>
        </div>

        <!-- KARTU KURSUS 4 -->
        <div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group snap-start">
            <img src="{{ asset('excel_course.jpg') }}" alt="Excel" class="w-full h-36 object-cover border border-gray-200 mb-2 group-hover:opacity-90">
            <h3 class="font-bold text-gray-900 text-base leading-tight mb-1 group-hover:text-purple-700">Microsoft Excel dari dasar hingga pakar</h3>
            <p class="text-xs text-gray-500 mb-1">Widhi Muttaqien, S.Kom, MMSI</p>
            <div class="flex items-center gap-1 text-xs mb-1">
                <span class="font-bold text-yellow-700">4,8</span>
                <div class="flex text-yellow-500">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                <span class="text-gray-500">(1.181)</span>
            </div>
            <p class="font-bold text-gray-900 text-base mb-2">Rp169.000</p>
            <div><span class="bg-[#eceb98] text-[#3d3c0a] text-xs font-bold px-2 py-0.5">Terlaris</span></div>
        </div>

        <!-- KARTU KURSUS 5 -->
        <div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group snap-start">
            <img src="{{ asset('data_course.jpg') }}" alt="Data Analyst" class="w-full h-36 object-cover border border-gray-200 mb-2 group-hover:opacity-90">
            <h3 class="font-bold text-gray-900 text-base leading-tight mb-1 group-hover:text-purple-700">Kelas Data Analyst Python 2024 & Project (New Update: + SQL)</h3>
            <p class="text-xs text-gray-500 mb-1">Risfan Kristori, BAYOU DATA</p>
            <div class="flex items-center gap-1 text-xs mb-1">
                <span class="font-bold text-yellow-700">4,8</span>
                <div class="flex text-yellow-500">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                <span class="text-gray-500">(186)</span>
            </div>
            <p class="font-bold text-gray-900 text-base mb-2">Rp169.000</p>
        </div>

    </div>

    <!-- SECTION: TOPIK POPULER -->
    <h2 class="text-lg font-bold text-gray-900 mt-12 mb-4">Topik Populer</h2>
    
    <!-- Pembungkus Tombol Topik -->
    <div class="flex overflow-x-auto gap-4 pb-4">
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">AI Generatif</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">Sertifikasi TI</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">Ilmu Data</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">ChatGPT</button>
        <button class="border border-gray-900 font-bold py-3 px-6 text-sm text-gray-900 hover:bg-gray-100 whitespace-nowrap">Rekayasa Prompt</button>
    </div>

</div>

@endsection