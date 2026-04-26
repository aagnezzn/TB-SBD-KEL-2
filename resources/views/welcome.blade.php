@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="px-10 mt-4">
    <div class="h-[350px] relative rounded-lg overflow-hidden">

        <div class="absolute inset-0 bg-cover bg-right"
             style="background-image: url('{{ asset('udemy.jpg') }}')">
        </div>

        <div class="absolute inset-0 bg-black/20"></div>

        <div class="relative h-full flex items-center">
            <div class="bg-white p-6 rounded shadow w-[450px] ml-10">
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
        </div>
    </div>
</section>

<!-- KATEGORI SLIDER -->
<section class="px-10 py-16 bg-gray-100">

    <div class="grid grid-cols-4 gap-8 items-start">

        <!-- TEXT -->
        <div>
            <h2 class="text-3xl font-bold mb-4">
                Pelajari skill <i>penting</i><br>
                terkait karier dan kehidupan
            </h2>

            <p class="text-gray-600">
                Udemy membantu Anda membangun skill yang dibutuhkan dengan cepat dan
                memajukan karier Anda di pasar kerja yang terus berubah.
            </p>
        </div>

        <!-- SLIDER -->
        <div class="col-span-3 relative">

            <!-- HANYA SLIDER YANG DI HIDE -->
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
                            <img src="{{ asset($item[0]) }}"
                                 class="w-full h-[300px] object-cover">

                            <div class="absolute bottom-4 left-4 right-4 bg-white p-4 rounded-xl flex justify-between items-center">
                                <span class="font-semibold">{{ $item[1] }}</span>
                                <span>→</span>
                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>

            </div>

            <!-- BUTTON -->
            <button onclick="prevSlide()" 
                class="absolute left-[-25px] top-1/2 -translate-y-1/2 bg-white w-10 h-10 rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition">
                ‹
            </button>

            <button onclick="nextSlide()" 
                class="absolute right-[-25px] top-1/2 -translate-y-1/2 bg-white w-10 h-10 rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition">
                ›
            </button>

            <!-- DOT -->
            <div class="flex justify-center mt-6 space-x-2" id="dots"></div>

        </div>

    </div>

</section>

<!-- KURSUS POPULER -->
<section class="px-10 py-10 bg-gray-100">

    <h2 class="text-2xl font-bold mb-6">Kursus populer</h2>

    <div class="grid grid-cols-4 gap-6">

        <div class="bg-white rounded-lg shadow hover:shadow-lg overflow-hidden">
            <img src="https://img-c.udemycdn.com/course/240x135/2776760_f176.jpg"
                 class="w-full h-40 object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-sm">Pemrograman Go (Golang)</h3>
                <p class="text-xs text-gray-500">Dicoding Indonesia</p>
                <div class="mt-2 font-bold">Rp169.000</div>
            </div>
        </div>

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

<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const slider = document.getElementById('slider');
    if (!slider) return;

    const totalItems = slider.children.length;
    const itemsPerView = 3;

    let index = 0;

    function updateSlider() {
        const width = 324;
        slider.style.transform = `translateX(-${index * width}px)`;
        updateDots();
    }

    window.nextSlide = function () {
        if (index < totalItems - itemsPerView) {
            index++;
        } else {
            index = 0;
        }
        updateSlider();
    }

    window.prevSlide = function () {
        if (index > 0) {
            index--;
        } else {
            index = totalItems - itemsPerView;
        }
        updateSlider();
    }

    function createDots() {
        const dotContainer = document.getElementById('dots');
        const totalDots = totalItems - itemsPerView + 1;

        for (let i = 0; i < totalDots; i++) {
            const dot = document.createElement('div');
            dot.className = "w-2.5 h-2.5 rounded-full bg-gray-300 cursor-pointer transition";
            dot.onclick = () => {
                index = i;
                updateSlider();
            };
            dotContainer.appendChild(dot);
        }
    }

    function updateDots() {
        const dots = document.querySelectorAll('#dots div');
        dots.forEach((dot, i) => {
            dot.classList.remove('bg-purple-600', 'scale-125');
            dot.classList.add('bg-gray-300');

            if (i === index) {
                dot.classList.remove('bg-gray-300');
                dot.classList.add('bg-purple-600', 'scale-125');
            }
        });
    }

    createDots();
    updateSlider();

});
</script>

@endsection