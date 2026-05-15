@extends('instructor.layout_instructor')

@section('title', 'Dashboard Instruktur')
@section('page_title', 'Dashboard')

@section('content')
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Halo, Instruktur!</h1>
        {{-- Tombol: Ganti ke Ungu #5624d0 --}}
        <a href="{{ route('instructor.courses.create') }}" 
           class="bg-[#5624d0] text-white px-6 py-3 font-bold text-sm hover:bg-[#4c1da7] shadow-lg shadow-purple-100 transition-all active:scale-95">
            Buat Kursus Baru
        </a>
    </div>

    {{-- Widget Statistik --}}
    <div class="grid grid-cols-3 gap-8 mb-10">
        <div class="bg-white p-8 border border-purple-50 shadow-sm rounded-xl">
            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Total Kursus</p>
            {{-- Angka: Ganti ke Ungu #5624d0 --}}
            <p class="text-4xl font-bold text-[#5624d0] mt-2">{{ $totalCourses }}</p>
        </div>
        <div class="bg-white p-8 border border-purple-50 shadow-sm rounded-xl">
            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Total Siswa</p>
            <p class="text-4xl font-bold text-[#5624d0] mt-2">{{ $totalStudents }}</p>
        </div>
        <div class="bg-white p-8 border border-purple-50 shadow-sm rounded-xl">
            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Rating</p>
            <p class="text-4xl font-bold text-[#5624d0] mt-2">{{ $avgRating ?? '0.0' }}</p>
        </div>
    </div>

    {{-- Tabel Kursus --}}
    <h3 class="font-bold mb-6 text-gray-800">Kursus Anda</h3>
    <div class="bg-white border border-purple-100 shadow-sm rounded-xl overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-purple-50 text-[11px] font-bold text-gray-400 uppercase">
                <tr>
                    <th class="p-5">Judul Kursus</th>
                    <th class="p-5">Harga</th>
                    <th class="p-5">Status</th>
                    <th class="p-5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-purple-50">
                @foreach($courses as $course)
                <tr class="hover:bg-[#fcfaff] transition-colors">
                    <td class="p-5 font-bold">{{ $course->title }}</td>
                    <td class="p-5 font-bold text-gray-600">Rp {{ number_format($course->price, 0, ',', '.') }}</td>
                    <td class="p-5">
                        <span class="px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-bold rounded-full uppercase">
                            Published
                        </span>
                    </td>
                    <td class="p-5 text-right">
                        {{-- Link Aksi: Ganti ke Ungu #5624d0 --}}
                        <a href="{{ route('instructor.courses.edit', $course->id) }}" class="text-[#5624d0] font-bold text-sm hover:underline">
                            <i class="fas fa-edit mr-1"></i> Edit Materi
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection