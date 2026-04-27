@extends('layouts.app')

@section('content')

<section class="px-10 mt-4">
    <div class="h-[350px] relative rounded-lg overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-right" style="background-image: url('{{ asset('udemy.jpg') }}')"></div>
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative h-full flex items-center">
            <div class="bg-white p-6 rounded shadow w-[450px] ml-10">
                <h2 class="text-3xl font-bold mb-3">Bangun skill yang diminati</h2>
                <p class="text-gray-600 mb-4">Dapatkan akses ke 26.000 kursus dari para ahli dunia nyata</p>
                <div class="flex space-x-3">
                    <button class="bg-purple-600 text-white px-4 py-2 rounded font-bold">Dapatkan Paket Personal</button>
                    <button class="border border-black font-bold px-4 py-2 rounded">Pelajari AI</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="px-10 py-16 bg-gray-100">
    <div class="grid grid-cols-4 gap-8 items-start">
        <div>
            <h2 class="text-3xl font-bold mb-4">
                Pelajari skill <i>penting</i><br>terkait karier dan kehidupan
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
</section>

<section class="px-10 py-10">
    <div class="bg-[#1c1d27] rounded-2xl p-12 flex flex-col lg:flex-row items-center gap-10">
        <div class="w-full lg:w-1/2 text-white">
            <h2 class="text-3xl font-bold mb-4">Transformasikan karier Anda di<br>era AI</h2>
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
</section>

<section class="px-10 py-12">
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
                <div class="p-4 flex flex-col flex-grow">
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
                <div class="p-4 flex flex-col flex-grow">
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
                <div class="p-4 flex flex-col flex-grow">
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
                <div class="p-4 flex flex-col flex-grow">
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

        <button class="absolute right-[-20px] top-1/2 -translate-y-1/2 bg-white border border-gray-300 w-12 h-12 rounded-full shadow-md flex items-center justify-center hover:bg-gray-50 transition z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>

    <div class="mt-6">
        <a href="#" class="text-purple-700 font-bold hover:text-purple-900 text-sm">
            Tampilkan semua kursus Python &rarr;
        </a>
    </div>
</section>

<section class="bg-gray-50 py-12 md:py-16">
    <div class="bg-gray-100 py-16 px-4">
    <p class="text-center text-slate-700 font-light text-lg mb-8 tracking-wide">
        Dipercaya oleh lebih dari 17.000 perusahaan dan jutaan pembelajar di seluruh dunia
    </p>

    <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-8 max-w-7xl mx-auto">
        
        <div class="flex items-center justify-center">
            <img src="vw.png" class="h-20 w-auto grayscale opacity-70" alt="VW">
        </div>

        <div class="flex items-center justify-center">
            <img src="samsung.png" class="h-20 w-auto grayscale opacity-70" alt="Samsung">
        </div>

        <div class="flex items-center justify-center">
            <img src="cisco.png" class="h-14 w-auto grayscale opacity-70" alt="Cisco">
        </div>

        <div class="flex items-center justify-center">
            <img src="vimeo.png" class="h-10 w-auto grayscale opacity-70" alt="Vimeo">
        </div>

        <div class="flex items-center justify-center">
            <img src="pg.png" class="h-20 w-auto grayscale opacity-70" alt="P&G">
        </div>

        <div class="flex items-center justify-center">
            <img src="hpe.png" class="h-14 w-auto grayscale opacity-70" alt="HPE">
        </div>

        <div class="flex items-center justify-center">
            <img src="citi.png" class="h-14 w-auto grayscale opacity-70" alt="Citi">
        </div>

        <div class="flex items-center justify-center">
            <img src="ericsson.png" class="h-14 w-auto grayscale opacity-70" alt="Ericsson">
        </div>

    </div>
</div>
</section>

<section class="px-10 py-16 bg-gray-50">
    <h2 class="text-3xl font-bold mb-8 max-w-2xl text-gray-900">
        Bergabung dengan orang lain untuk mengubah hidup mereka melalui pembelajaran
    </h2>
    <div class="grid grid-cols-4 gap-6">
        
        <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col shadow-sm">
            <svg class="w-8 h-8 mb-4 text-gray-800" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            <p class="text-gray-700 mb-6 flex-grow text-sm leading-relaxed">
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
            <p class="text-gray-700 mb-6 flex-grow text-sm leading-relaxed">
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
            <p class="text-gray-700 mb-6 flex-grow text-sm leading-relaxed">
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
            <p class="text-gray-700 mb-6 flex-grow text-sm leading-relaxed">
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
</section>

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