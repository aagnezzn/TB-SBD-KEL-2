@extends('instructor.layout_instructor')

@section('page_title', 'Daftar Siswa')
@section('page_name', 'Data Siswa Terdaftar')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-[#1c1d1f]">Siswa Anda</h1>
        <p class="text-gray-500 text-sm mt-1">Daftar siswa yang mengikuti kursus-kursus Anda.</p>
    </div>

    <div class="bg-white border border-gray-200 shadow-sm rounded-sm overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b border-gray-200 text-[11px] uppercase text-gray-400 font-bold tracking-widest">
                <tr>
                    <th class="p-5">Nama Siswa</th>
                    <th class="p-5">Kursus yang Diambil</th>
                    <th class="p-5">Tanggal Bergabung</th>
                    <th class="p-5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($students ?? [] as $student)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-5">
                        <div class="font-bold text-[#1c1d1f] capitalize">{{ $student->name }}</div>
                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">{{ $student->email }}</div>
                    </td>
                    <td class="p-5">
                        @forelse($student->enrollments ?? [] as $enroll)
                            @if($enroll->course)
                                <span class="block text-sm font-semibold text-blue-600 italic mb-1">
                                    {{ $enroll->course->title }}
                                </span>
                            @endif
                        @empty
                            <span class="text-xs text-gray-400 italic">Belum memilih kursus</span>
                        @endforelse
                    </td>
                    <td class="p-5 text-gray-500 text-sm">
                        {{ $student->created_at ? $student->created_at->format('d M Y') : '-' }}
                    </td>
                    <td class="p-5 text-right">
                        <button class="text-gray-400 hover:text-blue-600 transition font-semibold text-xs border border-gray-200 px-3 py-1.5 rounded-sm bg-white shadow-sm">
                            <i class="fas fa-envelope mr-1"></i> Hubungi
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-20 text-center text-gray-400">
                        <i class="fas fa-user-slash text-5xl mb-4 block text-gray-200"></i>
                        <p class="italic font-medium">Belum ada siswa yang mendaftar di kursus Anda.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection