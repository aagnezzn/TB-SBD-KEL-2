@extends('instructor.layout_instructor')

@section('page_title', 'Performa Instruktur')
@section('page_name', 'Performance Analytics')

@section('content')
    <div class="mb-10">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Performa Anda</h1>
        <p class="text-gray-500 text-sm mt-1 italic">Data statistik pendapatan dan interaksi siswa.</p>
    </div>

    {{-- Kartu Statistik Utama (Tema Ungu Diselaraskan) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <div class="bg-white p-8 border border-purple-50 shadow-sm rounded-xl">
            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Total Pendapatan</p>
            <p class="text-4xl font-bold text-[#5624d0] mt-2">Rp {{ number_format($data['total_earnings'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-8 border border-purple-50 shadow-sm rounded-xl">
            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Siswa Terdaftar</p>
            <p class="text-4xl font-bold text-[#5624d0] mt-2">{{ $data['total_enrollments'] }}</p>
        </div>
        <div class="bg-white p-8 border border-purple-50 shadow-sm rounded-xl">
            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Rating Rata-rata</p>
            <p class="text-4xl font-bold text-yellow-500 mt-2">{{ $data['avg_rating'] }} <span class="text-gray-300 text-sm italic font-normal">/ 5.0</span></p>
        </div>
    </div>

    {{-- Grafik Batas Aktivitas CSS Dinamis --}}
    <div class="bg-white border border-purple-100 rounded-xl p-8 shadow-sm">
        <div class="flex justify-between items-center mb-10">
            <h3 class="font-bold text-gray-700 uppercase text-xs tracking-widest italic">Aktivitas 7 Hari Terakhir</h3>
        </div>
        
        <div class="flex items-end justify-between h-56 gap-4 border-b border-gray-100 pb-2">
            @foreach($chartData as $dayData)
                <div class="relative group w-full flex flex-col items-center h-full justify-end">
                    {{-- Tooltip Nominal --}}
                    <span class="absolute -top-10 left-1/2 -translate-x-1/2 bg-black text-white text-[10px] p-2 rounded opacity-0 group-hover:opacity-100 transition-all duration-200 shadow-xl whitespace-nowrap z-10">
                        Rp {{ number_format($dayData['income'], 0, ',', '.') }}
                    </span>
                    
                    {{-- FAKTA PERBAIKAN: Bar Grafik disinkronkan ke tema warna Ungu #5624d0 --}}
                    <div class="w-full transition-all duration-700 {{ $dayData['income'] > 0 ? 'bg-[#5624d0] shadow-lg shadow-purple-100' : 'bg-gray-100' }} rounded-t-md" 
                         style="height: {{ $dayData['income'] > 0 ? max($dayData['height'], 30) : 5 }}%;">
                    </div>
                    
                    {{-- Label Hari --}}
                    <span class="absolute -bottom-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                        {{ $dayData['day'] }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
@endsection