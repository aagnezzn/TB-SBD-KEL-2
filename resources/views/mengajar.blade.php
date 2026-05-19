@extends('layouts.app')

@section('content') 

{{-- 1. HERO SECTION UTAMA (DIAMANKAN ALUR AKSESNYA) --}}
<div class="relative bg-[#f8f9fa] overflow-hidden py-16 border-b border-gray-100">
    <div class="max-w-[1340px] mx-auto px-6 lg:px-10 flex flex-col md:flex-row items-center min-h-[460px] gap-12">
        
        {{-- Sisi Kiri: Teks Informasi --}}
        <div class="w-full md:w-1/2 py-12 md:py-0 z-10 space-y-6">
            <p class="text-[#a435f0] font-black text-xs uppercase tracking-widest bg-purple-50 px-3 py-1 rounded inline-block border border-purple-100">{{ __('teach.hero_label') }}</p>
            <h1 class="text-[40px] md:text-[52px] font-extrabold text-[#2d2f31] leading-none tracking-tight">
                {!! __('teach.hero_title') !!}
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-sm font-medium leading-relaxed">
                {{ __('teach.hero_subtitle') }}
            </p>
            
            <a href="{{ route('instructor.courses.create') }}" 
                class="inline-block bg-[#5624d0] text-white px-12 py-4 font-bold hover:bg-[#4c1da7] transition shadow-lg text-center text-xs uppercase tracking-widest min-w-[300px] rounded-xl active:scale-95 cursor-pointer">
                {{ __('teach.btn_start') }}
            </a>
        </div>

        {{-- Sisi Kanan: Gambar Representasi --}}
        <div class="w-full md:w-1/2 relative flex justify-end items-end h-full">
            <img src="{{ asset('mengejar.png') }}" 
                 alt="Instruktur Idemy" 
                 class="w-full h-auto max-h-[480px] object-cover object-top rounded-2xl shadow-xl border border-gray-50"
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1577896851231-70ef18881754?w=800&q=80';">
        </div>
    </div>
</div>
    
{{-- 2. SEKSI TIGA PILAR MANFAAT INSENTIF --}}
<div class="max-w-[1340px] mx-auto pt-20 pb-24 px-6 lg:px-10">
    <h2 class="text-[28px] md:text-[36px] font-extrabold text-center text-[#2d2f31] mb-16 tracking-tight leading-none">
        {{ __('teach.reasons_title') }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-16 justify-center text-center max-w-[1100px] mx-auto">
        {{-- Pilar 1 --}}
        <div class="flex flex-col items-center space-y-3">
            <div class="h-[90px] flex items-center justify-center mb-2">
                <img src="{{ asset('ajari.png') }}" class="w-20 h-20 object-contain" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3426/3426222.png'">
            </div>
            <h3 class="text-base font-bold text-[#2d2f31]">{{ __('teach.reason_1_title') }}</h3>
            <p class="text-gray-500 text-sm leading-relaxed max-w-[260px] font-medium">
                {{ __('teach.reason_1_desc') }}
            </p>
        </div>

        {{-- Pilar 2 --}}
        <div class="flex flex-col items-center space-y-3">
            <div class="h-[90px] flex items-center justify-center mb-2">
                <img src="{{ asset('inspirasi.png') }}" class="w-20 h-20 object-contain" onerror="this.src='https://cdn-icons-png.flaticon.com/512/2085/2085290.png'">
            </div>
            <h3 class="text-base font-bold text-[#2d2f31]">{{ __('teach.reason_2_title') }}</h3>
            <p class="text-gray-500 text-sm leading-relaxed max-w-[260px] font-medium">
                {{ __('teach.reason_2_desc') }}
            </p>
        </div>

        {{-- Pilar 3 --}}
        <div class="flex flex-col items-center space-y-3">
            <div class="h-[90px] flex items-center justify-center mb-2">
                <img src="{{ asset('hadiah.png') }}" class="w-20 h-20 object-contain" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3135/3135715.png'">
            </div>
            <h3 class="text-base font-bold text-[#2d2f31]">{{ __('teach.reason_3_title') }}</h3>
            <p class="text-gray-500 text-sm leading-relaxed max-w-[260px] font-medium">
                {{ __('teach.reason_3_desc') }}
            </p>
        </div>
    </div>
</div>

{{-- 3. BANNER UNGU METRIK DATA COUNTER --}}
<section class="w-full bg-[#5624d0] py-16 shadow-lg shadow-purple-900/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-8 text-center text-white">
            <div class="flex flex-col items-center justify-center border-r border-white/10 last:border-0">
                <h3 class="text-4xl md:text-5xl font-black mb-1 tracking-tight">{{ __('teach.stat_students_val') }}</h3>
                <p class="text-xs font-bold uppercase text-purple-200 tracking-wider">{{ __('teach.stat_students_lbl') }}</p>
            </div>
            <div class="flex flex-col items-center justify-center border-r border-white/10 last:border-0">
                <h3 class="text-4xl md:text-5xl font-black mb-1 tracking-tight">{{ __('teach.stat_langs_val') }}</h3>
                <p class="text-xs font-bold uppercase text-purple-200 tracking-wider">{{ __('teach.stat_langs_lbl') }}</p>
            </div>
            <div class="flex flex-col items-center justify-center border-r border-white/10 last:border-0">
                <h3 class="text-4xl md:text-5xl font-black mb-1 tracking-tight">{{ __('teach.stat_enrolls_val') }}</h3>
                <p class="text-xs font-bold uppercase text-purple-200 tracking-wider">{{ __('teach.stat_enrolls_lbl') }}</p>
            </div>
            <div class="flex flex-col items-center justify-center border-r border-white/10 last:border-0">
                <h3 class="text-4xl md:text-5xl font-black mb-1 tracking-tight">{{ __('teach.stat_countries_val') }}</h3>
                <p class="text-xs font-bold uppercase text-purple-200 tracking-wider">{{ __('teach.stat_countries_lbl') }}</p>
            </div>
            <div class="flex flex-col items-center justify-center col-span-2 md:col-span-1">
                <h3 class="text-4xl md:text-5xl font-black mb-1 tracking-tight">{{ __('teach.stat_enterprise_val') }}</h3>
                <p class="text-xs font-bold uppercase text-purple-200 tracking-wider">{{ __('teach.stat_enterprise_lbl') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- 4. SECTION METODE PEMBELAJARAN (TAB INTERAKTIF) --}}
<section class="max-w-7xl mx-auto px-4 py-24">
    <h2 class="text-4xl font-extrabold text-center text-[#2d2f31] mb-12 tracking-tight">{{ __('teach.steps_title') }}</h2>

    {{-- Tombol Tab --}}
    <div class="flex flex-wrap justify-center gap-x-8 border-b border-gray-200 mb-16">
        <button id="tab-btn-1" onclick="changeTab(1)" class="tab-btn pb-4 text-base font-bold text-[#2d2f31] border-b-4 border-[#2d2f31] transition-all cursor-pointer">{{ __('teach.tab_1') }}</button>
        <button id="tab-btn-2" onclick="changeTab(2)" class="tab-btn pb-4 text-base font-bold text-gray-400 border-b-4 border-transparent hover:text-[#2d2f31] transition-all cursor-pointer">{{ __('teach.tab_2') }}</button>
        <button id="tab-btn-3" onclick="changeTab(3)" class="tab-btn pb-4 text-base font-bold text-gray-400 border-b-4 border-transparent hover:text-[#2d2f31] transition-all cursor-pointer">{{ __('teach.tab_3') }}</button>
    </div>

    {{-- Wadah Konten Tab --}}
    <div class="relative max-w-5xl mx-auto">
        {{-- CONTENT TAB 1 --}}
        <div id="tab-content-1" class="tab-content block animate-fade-in">
            <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-12">
                <div class="w-full md:w-1/2 space-y-4">
                    <p class="text-gray-600 text-base leading-relaxed font-medium">{{ __('teach.tab_1_p1') }}</p>
                    <p class="text-gray-600 text-base leading-relaxed font-medium">{{ __('teach.tab_1_p2') }}</p>
                    <h3 class="font-bold text-lg text-[#2d2f31] pt-2 flex items-center gap-2 text-purple-700"><i class="fas fa-info-circle"></i> {{ __('teach.help_title') }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-medium">{{ __('teach.tab_1_p3') }}</p>
                </div>
                <div class="w-full md:w-1/2 flex justify-end">
                    <img src="{{ asset('rencanakankurikulum.png') }}" alt="Perencanaan" class="max-w-[380px] w-full object-contain rounded-xl shadow-md border" onerror="this.src='https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=500&q=80'">
                </div>
            </div>
        </div>

        {{-- CONTENT TAB 2 --}}
        <div id="tab-content-2" class="tab-content hidden animate-fade-in">
            <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-12">
                <div class="w-full md:w-1/2 space-y-4">
                    <p class="text-gray-600 text-base leading-relaxed font-medium">{{ __('teach.tab_2_p1') }}</p>
                    <p class="text-gray-600 text-base leading-relaxed font-medium">{{ __('teach.tab_2_p2') }}</p>
                    <h3 class="font-bold text-lg text-[#2d2f31] pt-2 flex items-center gap-2 text-purple-700"><i class="fas fa-info-circle"></i> {{ __('teach.help_title') }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-medium">{{ __('teach.tab_2_p3') }}</p>
                </div>
                <div class="w-full md:w-1/2 flex justify-end">
                    <img src="{{ asset('rekamvideo.png') }}" alt="Rekaman Video" class="max-w-[380px] w-full object-contain rounded-xl shadow-md border" onerror="this.src='https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=500&q=80'">
                </div>
            </div>
        </div>

        {{-- CONTENT TAB 3 --}}
        <div id="tab-content-3" class="tab-content hidden animate-fade-in">
            <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-12">
                <div class="w-full md:w-1/2 space-y-4">
                    <p class="text-gray-600 text-base leading-relaxed font-medium">{{ __('teach.tab_3_p1') }}</p>
                    <p class="text-gray-600 text-base leading-relaxed font-medium">{{ __('teach.tab_3_p2') }}</p>
                    <h3 class="font-bold text-lg text-[#2d2f31] pt-2 flex items-center gap-2 text-purple-700"><i class="fas fa-info-circle"></i> {{ __('teach.help_title') }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-medium">{{ __('teach.tab_3_p3') }}</p>
                </div>
                <div class="w-full md:w-1/2 flex justify-end">
                    <img src="{{ asset('lumcurkankursus.png') }}" alt="Peluncuran" class="max-w-[380px] w-full object-contain rounded-xl shadow-md border" onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500&q=80'">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 5. SLIDER REVIEW TESTIMONI PENGALAMAN INSPIRATIF --}}
<section class="bg-gray-50 border-t border-b border-gray-100 py-20 w-full">
    <div class="max-w-5xl mx-auto px-6 relative">
        <div class="overflow-hidden relative rounded-2xl bg-white border p-6 md:p-10 shadow-sm">
            <div id="slider-track" class="flex transition-transform duration-500 ease-in-out w-full">
                
                {{-- Slide Frank Kane --}}
                <div class="min-w-full flex flex-col md:flex-row items-center gap-12 px-2">
                    <div class="w-full md:w-2/5 flex justify-center">
                        <img src="{{ asset('frank.png') }}" alt="Frank Kane" class="w-56 h-56 object-cover rounded-full shadow-md border-4 border-gray-50" onerror="this.src='https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80'">
                    </div>
                    <div class="w-full md:w-3/5 space-y-4">
                        <p class="text-gray-600 text-base leading-relaxed italic font-medium">
                            {{ __('teach.frank_quote') }}
                        </p>
                        <div>
                            <h4 class="font-extrabold text-[#2d2f31] text-sm">Frank Kane</h4>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mt-0.5">{{ __('teach.frank_role') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Slide Paulo Dichone --}}
                <div class="min-w-full flex flex-col md:flex-row items-center gap-12 px-2">
                    <div class="w-full md:w-2/5 flex justify-center">
                        <img src="{{ asset('paulo.png') }}" alt="Paulo Dichone" class="w-56 h-56 object-cover rounded-full shadow-md border-4 border-gray-50" onerror="this.src='https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&q=80'">
                    </div>
                    <div class="w-full md:w-3/5 space-y-4">
                        <p class="text-gray-600 text-base leading-relaxed italic font-medium">
                            {{ __('teach.paulo_quote') }}
                        </p>
                        <div>
                            <h4 class="font-extrabold text-[#2d2f31] text-sm">Paulo Dichone</h4>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mt-0.5">{{ __('teach.paulo_role') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Slide Deborah Grayson --}}
                <div class="min-w-full flex flex-col md:flex-row items-center gap-12 px-2">
                    <div class="w-full md:w-2/5 flex justify-center">
                        <img src="{{ asset('deborah.png') }}" alt="Deborah" class="w-56 h-56 object-cover rounded-full shadow-md border-4 border-gray-50" onerror="this.src='https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&q=80'">
                    </div>
                    <div class="w-full md:w-3/5 space-y-4">
                        <p class="text-gray-600 text-base leading-relaxed italic font-medium">
                            {{ __('teach.deborah_quote') }}
                        </p>
                        <div>
                            <h4 class="font-extrabold text-[#2d2f31] text-sm">Deborah Grayson Riege</h4>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mt-0.5">{{ __('teach.deborah_role') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigasi Tombol Slider Kontrol Pas --}}
        <button id="btn-prev" onclick="geserKiri()" class="absolute left-1 top-1/2 -translate-y-1/2 bg-white rounded-full w-12 h-12 shadow-md hover:bg-gray-50 transition-all hidden items-center justify-center border cursor-pointer">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button id="btn-next" onclick="geserKanan()" class="absolute right-1 top-1/2 -translate-y-1/2 bg-white rounded-full w-12 h-12 shadow-md hover:bg-gray-50 transition-all flex items-center justify-center border cursor-pointer">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>
</section>

{{-- 6. LAYANAN BANTUAN MATERI INTEGRAL (RE-STRUCTURED GRID) --}}
<section class="w-full bg-white py-24 overflow-hidden">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-16">
            
            {{-- Blok Informasi --}}
            <div class="w-full md:w-7/12 space-y-4">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#2d2f31] tracking-tight leading-tight">
                    {{ __('teach.support_title') }}
                </h2>
                <p class="text-gray-600 text-base leading-relaxed font-medium">
                    <span class="font-bold text-gray-900 border-b-2 border-purple-100">{{ __('teach.support_p1_part1') }}</span>{{ __('teach.support_p1_part2') }}<span class="font-bold text-gray-900 border-b-2 border-purple-100">{{ __('teach.support_p1_part3') }}</span>{{ __('teach.support_p1_part4') }}
                </p>
                <div class="pt-2">
                    <a href="#" class="text-[#a435f0] font-black text-xs uppercase tracking-widest hover:text-purple-900 transition-all border-b-2 border-[#a435f0] pb-1 inline-block">
                        {{ __('teach.support_link') }}
                    </a>
                </div>
            </div>

            {{-- Blok Gambar Penjepit Sisi Kanan --}}
            <div class="w-full md:w-5/12 flex justify-end shrink-0">
                <img src="{{ asset('anukanan.png') }}" alt="Support Team" class="max-w-[340px] md:max-w-[420px] w-full object-contain rounded-xl" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1556761175-b413da4baf72?w=500&q=80';">
            </div>

        </div>
    </div>
</section>

{{-- ==================== CENTRALIZED SCRIPT ENGINE ==================== --}}
<script>
    // SISTEM 1: LOGIKA KONTROL TAB INTERAKTIF
    function changeTab(tabIndex) {
        document.querySelectorAll('.tab-content').forEach(function(content) {
            content.classList.remove('block');
            content.classList.add('hidden');
        });
        document.getElementById('tab-content-' + tabIndex).classList.remove('hidden');
        document.getElementById('tab-content-' + tabIndex).classList.add('block');

        document.querySelectorAll('.tab-btn').forEach(function(btn) {
            btn.classList.remove('text-[#2d2f31]', 'border-[#2d2f31]');
            btn.classList.add('text-gray-400', 'border-transparent');
        });

        let activeBtn = document.getElementById('tab-btn-' + tabIndex);
        activeBtn.classList.remove('text-gray-400', 'border-transparent');
        activeBtn.classList.add('text-[#2d2f31]', 'border-[#2d2f31]');
    }

    // SISTEM 2: LOGIKA KONTROL SLIDER TESTIMONI
    let slideSaatIni = 0;
    const totalSlide = 3;
    const track = document.getElementById('slider-track');
    const btnKiri = document.getElementById('btn-prev');
    const btnKanan = document.getElementById('btn-next');

    function perbaruiSlider() {
        if(track) {
            track.style.transform = `translateX(-${slideSaatIni * 100}%)`;
            if (slideSaatIni === 0) {
                btnKiri.classList.add('hidden');
                btnKiri.classList.remove('flex');
                btnKanan.classList.remove('hidden');
            } else if (slideSaatIni === totalSlide - 1) {
                btnKiri.classList.remove('hidden');
                btnKiri.classList.add('flex');
                btnKanan.classList.add('hidden');
            } else {
                btnKiri.classList.remove('hidden');
                btnKiri.classList.add('flex');
                btnKanan.classList.remove('hidden');
            }
        }
    }

    function geserKanan() {
        if (slideSaatIni < totalSlide - 1) {
            slideSaatIni++;
            perbaruiSlider();
        }
    }

    function geserKiri() {
        if (slideSaatIni > 0) {
            slideSaatIni--;
            perbaruiSlider();
        }
    }
</script>

{{-- CENTRALIZED CUSTOM ANIMATION STYLES --}}
<style>
    [x-cloak] { display: none !important; }
    .animate-fade-in { animation: fadeIn 0.4s ease-in-out; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection