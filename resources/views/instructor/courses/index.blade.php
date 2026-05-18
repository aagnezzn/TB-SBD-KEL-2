@extends('instructor.layout_instructor')

@section('page_title', 'Kursus Saya')
@section('page_name', 'Manajemen Kursus')

@section('content')
    {{-- Header Panel: Menampilkan info ringkas dan tombol buat kelas baru --}}
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Kursus Saya</h1>
            <p class="text-gray-400 text-sm mt-1 italic">Kelola semua daftar kursus Anda.</p>
        </div>
        
        {{-- FAKTA PERBAIKAN MUTLAK: Tombol pendaftaran kelas baru dipasang agar alur bisnis tidak putus --}}
        <a href="{{ route('instructor.courses.create') }}" 
           class="bg-[#5624d0] hover:bg-[#4c1da7] text-white px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all flex items-center gap-2 shadow-lg shadow-purple-100 active:scale-95">
            <i class="fas fa-plus"></i> Buat Kursus Baru
        </a>
    </div>

    {{-- Tabel Data Kursus Hasil Seeding CSV --}}
    <div class="bg-white border border-gray-200 shadow-sm rounded-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-200 text-[11px] uppercase text-gray-400 font-bold tracking-widest">
                    <tr>
                        <th class="p-5">Judul</th>
                        <th class="p-5">Harga</th>
                        <th class="p-5">Status</th>
                        <th class="p-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($courses as $course)
                    <tr class="hover:bg-gray-50/50 transition">
                        {{-- Kolom Judul Kelas --}}
                        <td class="p-5 font-bold text-gray-800">{{ $course->title }}</td>
                        
                        {{-- Kolom Harga Berformat Rupiah --}}
                        <td class="p-5 font-bold text-gray-600 tracking-tight">
                            Rp {{ number_format($course->price, 0, ',', '.') }}
                        </td>
                        
                        {{-- Kolom Status Publikasi --}}
                        <td class="p-5">
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-700 uppercase">
                                Published
                            </span>
                        </td>
                        
                        {{-- Kolom Aksi Kontrol --}}
                        <td class="p-5 text-right">
                            <div class="flex justify-end gap-4">
                                {{-- Link Menuju Halaman Edit Informasi Dasar --}}
                                <a href="{{ route('instructor.courses.edit', $course->id) }}" 
                                   class="text-gray-500 hover:text-[#5624d0] font-bold text-xs flex items-center gap-1 transition-colors">
                                    <i class="fas fa-edit"></i> Edit Info
                                </a>
                                {{-- Link Menuju Halaman Kelola Struktur Kurikulum --}}
                                <a href="{{ route('instructor.courses.manage', $course->id) }}" 
                                   class="text-[#5624d0] hover:text-purple-900 font-bold text-xs flex items-center gap-1 transition-colors">
                                    <i class="fas fa-tasks"></i> Kelola Materi
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection