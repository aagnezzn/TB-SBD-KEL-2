@extends('layouts.app')

@section('content')

<section class="max-w-6xl mx-auto mt-12 px-10">
    <div class="flex flex-col md:flex-row items-center justify-between gap-10">
        
        <div class="md:w-1/2">
            <p class="text-purple-700 font-bold text-sm mb-2">Paket Personal</p>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                Bawa karier Anda<br>ke level berikutnya
            </h1>
            <p class="text-gray-700 text-lg mb-6">
                Melangkah maju dalam pekerjaan dan kehidupan dengan akses langganan ke koleksi kursus berperingkat teratas dalam topik teknologi, bisnis, dan lainnya.
            </p>
            <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-8 rounded transition">
                Mulai langganan
            </button>
            <p class="text-xs text-gray-500 mt-3">
                Mulai Rp116.000 per bulan. Batalkan kapan saja.
            </p>
        </div>
        
        <div class="md:w-1/2 flex justify-end">
            <img src="{{ asset('hero_berlangganan.jpg') }}" alt="Berlangganan" class="max-h-[400px] object-contain">
        </div>

    </div>
</section>

<section class="max-w-6xl mx-auto px-10 mt-16 mb-20">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center border-t border-b border-gray-200 py-10">
        
        <div>
            <h2 class="text-4xl font-bold text-gray-900">28,000+</h2>
            <p class="text-sm text-gray-500 mt-1">kursus atas permintaan</p>
        </div>
        
        <div>
            <h2 class="text-4xl font-bold text-gray-900">20,000+</h2>
            <p class="text-sm text-gray-500 mt-1">ujian praktik</p>
        </div>
        
        <div>
            <h2 class="text-4xl font-bold text-gray-900 flex justify-center items-center gap-1">
                4.5 
                <svg class="w-6 h-6 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </h2>
            <p class="text-sm text-gray-500 mt-1">peringkat kursus rata-rata</p>
        </div>
        
        <div>
            <h2 class="text-4xl font-bold text-gray-900">9,000+</h2>
            <p class="text-sm text-gray-500 mt-1">instruktur teratas</p>
        </div>

    </div>
</section>

@endsection