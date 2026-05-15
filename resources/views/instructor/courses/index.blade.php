@extends('instructor.layout_instructor')

@section('page_title', 'Kursus Saya')
@section('page_name', 'Manajemen Kursus')

@section('content')
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Kursus Saya</h1>
            <p class="text-gray-400 text-sm mt-1 italic">Kelola semua daftar kursus Anda.</p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 shadow-sm rounded-sm overflow-hidden">
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
                    <td class="p-5 font-bold">{{ $course->title }}</td>
                    <td class="p-5 font-bold text-gray-600 tracking-tight">
                        Rp {{ number_format($course->price, 0, ',', '.') }}
                    </td>
                    <td class="p-5">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-700 uppercase">
                            Published
                        </span>
                    </td>
                    <td class="p-5 text-right">
                        <a href="{{ route('instructor.courses.manage', $course->id) }}" class="text-blue-600 hover:text-blue-800 font-bold">
                            <i class="fas fa-tasks mr-2"></i>Kelola Materi
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection