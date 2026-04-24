@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="bg-gradient-to-r from-purple-700 to-purple-500 px-10 py-12 flex items-center justify-between">

    <div class="bg-white p-6 rounded shadow w-[450px]">
        <h2 class="text-3xl font-bold mb-3">
            Bangun skill yang diminati
        </h2>

        <p class="text-gray-600 mb-4">
            Dapatkan akses ke 26.000 kursus dari para ahli dunia nyata
        </p>

        <div class="flex space-x-3">
            <button class="bg-purple-600 text-white px-4 py-2 rounded">
                Dapatkan Paket Personal
            </button>

            <button class="border px-4 py-2 rounded">
                Pelajari AI
            </button>
        </div>
    </div>

    <img src="https://img-c.udemycdn.com/home/banner/desktop.jpg"
         class="w-[500px]">
</section>


<!-- KATEGORI (3 KOTAK) -->
<section class="px-10 py-10">

    <h2 class="text-2xl font-bold mb-6">
        Pelajari skill penting terkait karier dan kehidupan
    </h2>

    <div class="grid grid-cols-3 gap-6">

        <div class="bg-white rounded-xl overflow-hidden shadow">
            <img src="https://img-c.udemycdn.com/topic/240x135/ai.jpg"
                 class="w-full h-40 object-cover">
            <div class="p-4 font-semibold">AI Generatif →</div>
        </div>

        <div class="bg-white rounded-xl overflow-hidden shadow">
            <img src="https://img-c.udemycdn.com/topic/240x135/it-certification.jpg"
                 class="w-full h-40 object-cover">
            <div class="p-4 font-semibold">Sertifikasi TI →</div>
        </div>

        <div class="bg-white rounded-xl overflow-hidden shadow">
            <img src="https://img-c.udemycdn.com/topic/240x135/data-science.jpg"
                 class="w-full h-40 object-cover">
            <div class="p-4 font-semibold">Data Science →</div>
        </div>

    </div>
</section>


<!-- KURSUS POPULER -->
<section class="px-10 py-10 bg-gray-100">

    <h2 class="text-2xl font-bold mb-6">Kursus populer</h2>

    <div class="grid grid-cols-4 gap-6">

        <!-- CARD -->
        <div class="bg-white rounded-lg shadow hover:shadow-lg overflow-hidden">

            <img src="https://img-c.udemycdn.com/course/240x135/2776760_f176.jpg"
                 class="w-full h-40 object-cover">

            <div class="p-4">
                <h3 class="font-semibold text-sm">
                    Pemrograman Go (Golang)
                </h3>

                <p class="text-xs text-gray-500">
                    Dicoding Indonesia
                </p>

                <div class="flex items-center text-xs mt-2 space-x-1">
                    <span class="text-orange-500 font-semibold">4.8</span>
                    <i data-feather="star" class="w-4 h-4 text-orange-500"></i>
                    <i data-feather="star" class="w-4 h-4 text-orange-500"></i>
                    <i data-feather="star" class="w-4 h-4 text-orange-500"></i>
                    <i data-feather="star" class="w-4 h-4 text-orange-500"></i>
                    <i data-feather="star" class="w-4 h-4 text-orange-500"></i>
                </div>

                <div class="mt-2">
                    <span class="font-bold">Rp169.000</span>
                    <span class="text-gray-400 line-through text-sm ml-2">
                        Rp249.000
                    </span>
                </div>
            </div>
        </div>

        <!-- DUPLIKAT -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <img src="https://img-c.udemycdn.com/course/240x135/1565838_e54e_16.jpg"
                 class="w-full h-40 object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-sm">Machine Learning</h3>
                <p class="text-xs text-gray-500">Kirill</p>
                <div class="mt-2 font-bold">Rp159.000</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <img src="https://img-c.udemycdn.com/course/240x135/793796_0e89.jpg"
                 class="w-full h-40 object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-sm">Microsoft Excel</h3>
                <p class="text-xs text-gray-500">Leila</p>
                <div class="mt-2 font-bold">Rp199.000</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <img src="https://img-c.udemycdn.com/course/240x135/851712_fc61_6.jpg"
                 class="w-full h-40 object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-sm">HTML CSS JS</h3>
                <p class="text-xs text-gray-500">Angela</p>
                <div class="mt-2 font-bold">Rp189.000</div>
            </div>
        </div>

    </div>
</section>

@endsection