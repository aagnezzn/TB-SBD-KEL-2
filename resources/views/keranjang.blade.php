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
    <div class="flex overflow-x-auto overflow-visible gap-4 pb-8 relative snap-x">

        <!-- KARTU KURSUS 1 -->
        <div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group snap-start relative">
            <img src="{{ asset('python.png') }}" alt="Python" class="w-full h-36 object-cover border border-gray-200 mb-2 group-hover:opacity-90">
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
             <div class="absolute top-0 left-full ml-3 w-[320px] bg-white border rounded-xl shadow-xl p-4 
                opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                transition duration-300 z-50">

        <h3 class="font-bold text-lg mb-2">
            Pemrograman Python : Pemula sampai Mahir
        </h3>

        <p class="text-sm text-gray-500 mb-2">
        10,5 jam • Tingkat Pemula
        </p>

        <ul class="text-sm text-gray-700 mb-3 space-y-1">
            <li>Belajar Python dari dasar</li>
            <li>✔ 100 project dalam 100 hari</li>
            <li>✔ Belajar automation & web</li>
            <li>✔ Siap jadi programmer</li>
        </ul>

        <button class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">
            Tambahkan ke keranjang
        </button>
    </div>
        </div>
        

        <!-- KARTU KURSUS 2 -->
        <div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group snap-start relative">
            <img src="{{ asset('golang.png') }}" alt="Go-Lang" class="w-full h-36 object-cover border border-gray-200 mb-2 group-hover:opacity-90">
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
            <div class="absolute top-0 left-full ml-3 w-[320px] bg-white border rounded-xl shadow-xl p-4 
                opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                transition duration-300 z-50">

        <h3 class="font-bold text-lg mb-2">
            Pemrograman Go-Lang : Pemula sampai Mahir
        </h3>

        <p class="text-sm text-gray-500 mb-2">
        43 jam • Semua Tingkat 
        </p>

        <ul class="text-sm text-gray-700 mb-3 space-y-1">
            <li>Belajar Go-Lang dari pemula sampai mahir disertai studi kasus. Materi akan selalu di-update secara berkala</li>
            <li>✔ Go-Lang Dasar</li>
            <li>✔ Go-Lang Database</li>
            <li>✔ Go-Lang MySQL</li>
        </ul>

        <button class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">
            Tambahkan ke keranjang
        </button>
    </div>
        </div>

        <!-- KARTU KURSUS 3 -->
        <div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group snap-start relative">
            <img src="{{ asset('agnes.png') }}" alt="JavaScript" class="w-full h-36 object-cover border border-gray-200 mb-2 group-hover:opacity-90">
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
            <div class="absolute top-0 left-full ml-3 w-[320px] bg-white border rounded-xl shadow-xl p-4 
                opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                transition duration-300 z-50">

        <h3 class="font-bold text-lg mb-2">
            HTML, CSS dan JavaScript : Pemula sampai Mahir
        </h3>

        <p class="text-sm text-gray-500 mb-2">
        33,5 jam • Semua Tingkat
        </p>

        <ul class="text-sm text-gray-700 mb-3 space-y-1">
            <li>Belajar pemrograman HTML, CSS dan JavaScript dari pemula sampai mahir disertai studi kasus.</li>
            <li>✔ HTML Dasar</li>
            <li>✔ CSS Dasar</li>
            <li>✔ JavaScript Dasar</li>
        </ul>

        <button class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">
            Tambahkan ke keranjang
        </button>
    </div>
        </div>

        <!-- KARTU KURSUS 4 -->
        <div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group snap-start relative">
            <img src="{{ asset('icak.png') }}" alt="Excel" class="w-full h-36 object-cover border border-gray-200 mb-2 group-hover:opacity-90">
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
           <div class="absolute top-0 right-full mr-3 w-[320px] bg-white border rounded-xl shadow-xl p-4 
            opacity-0 invisible group-hover:opacity-100 group-hover:visible 
            transition duration-300 z-50">

        <h3 class="font-bold text-lg mb-2">
            Microsoft Excel dari dasar hingga pakar
        </h3>

        <p class="text-sm text-gray-500 mb-2">
        17,5 jam • Semua Tingkat 
        </p>

        <ul class="text-sm text-gray-700 mb-3 space-y-1">
            <li>Kuasa Microsoft Excel 365/2019/2021 dengan cepat dan mudah</li>
            <li>✔ Kuasai Microsoft Excel dari dasar hingga mahir</li>
            <li>✔ Bangun pemahaman yang kuat tentang dasar-dasar Microsoft Excel</li>
            <li>✔ Menggunakan formula dan fungsi modern di dalam Excel seperti SUM, AVERAGE, dan XLOOKUP</li>
        </ul>

        <button class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">
            Tambahkan ke keranjang
        </button>
    </div>
        </div>

        <!-- KARTU KURSUS 5 -->
        <div class="min-w-[260px] max-w-[260px] flex flex-col cursor-pointer group snap-start relative">
            <img src="{{ asset('ijun.png') }}" alt="Data Analyst" class="w-full h-36 object-cover border border-gray-200 mb-2 group-hover:opacity-90">
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
            <div class="absolute top-0 right-full mr-3 w-[320px] bg-white border rounded-xl shadow-xl p-4 
            opacity-0 invisible group-hover:opacity-100 group-hover:visible 
            transition duration-300 z-50">

        <h3 class="font-bold text-lg mb-2">
            Kelas Data Analyst Python 2024 & Project (New Update: + SQL)
        </h3>

        <p class="text-sm text-gray-500 mb-2">
        21 jam • Tingkat Pemula
        </p>

        <ul class="text-sm text-gray-700 mb-3 space-y-1">
            <li>Bahasa Python Untuk Analisis Data dan Visualisasi Data, Disertai Kuis, Latihan, Project. Update Terbaru Penambahan SQL.</li>
            <li>✔ Mengenal Google Colaboratory dan Cara Menggunakannya</li>
            <li>✔ Dapat Menggunakan Library Numpy dan Struktur Data Array untuk Analisis Data</li>
            <li>✔ Dapat Menggunakan Library Pandas dan Struktur Data Series & Dataframe untuk Analisis Data dan Visualisasi Data</li>
        </ul>

        <button class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">
            Tambahkan ke keranjang
        </button>
    </div>
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