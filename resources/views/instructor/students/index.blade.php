@extends('instructor.layout_instructor')

@section('page_title', 'Daftar Siswa')
@section('page_name', 'Data Siswa Terdaftar')

@section('content')
    {{-- Header Judul Halaman --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-[#1c1d1f]">Siswa Anda</h1>
        <p class="text-gray-500 text-sm mt-1">Daftar siswa yang mengikuti kursus-kursus Anda.</p>
    </div>

    {{-- Kontainer Tabel Data Siswa Berelasi --}}
    <div class="bg-white border border-gray-200 shadow-sm rounded-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-gray-50 border-b border-gray-200 text-[11px] uppercase text-gray-400 font-bold tracking-widest">
                    <tr>
                        <th class="p-5">Nama Siswa</th>
                        <th class="p-5">Kursus yang Diambil (Materi Anda)</th>
                        <th class="p-5">Tanggal Bergabung</th>
                        <th class="p-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($students ?? [] as $student)
                    <tr class="hover:bg-gray-50/50 transition-all">
                        {{-- Kolom 1: Profil & Identitas Siswa --}}
                        <td class="p-5">
                            <div class="font-bold text-[#1c1d1f] capitalize text-sm">{{ $student->name }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tight font-mono mt-0.5">{{ $student->email }}</div>
                        </td>
                        
                        {{-- Kolom 2: Judul Kelas yang Diikuti (Sudah Diproteksi) --}}
                        <td class="p-5">
                            @php $hasOwnCourse = false; @endphp
                            
                            @foreach($student->enrollments ?? [] as $enroll)
                                {{-- FAKTA PERBAIKAN MUTLAK: Hanya tampilkan jika kelas tersebut buatan instruktur yang login --}}
                                @if($enroll->course && $enroll->course->instructor_id === Auth::id())
                                    <span class="block text-sm font-semibold text-purple-700 mb-1">
                                        <i class="fas fa-book-reader text-xs mr-1 text-gray-400"></i> {{ $enroll->course->title }}
                                    </span>
                                    @php $hasOwnCourse = true; @endphp
                                @endif
                            @endforeach

                            {{-- Fail-safe jika data relasi tidak sinkron --}}
                            @if(!$hasOwnCourse)
                                <span class="text-xs text-gray-400 italic">Kelas dalam proses konfirmasi</span>
                            @endif
                        </td>
                        
                        {{-- Kolom 3: Tanggal Transaksi/Registrasi Siswa --}}
                        <td class="p-5 text-gray-600 text-sm font-medium">
                            {{ $student->created_at ? $student->created_at->format('d M Y') : '-' }}
                        </td>
                        
                        {{-- Kolom 4: Tombol Hubungi Terarah --}}
                        <td class="p-5 text-right">
                            <a href="mailto:{{ $student->email }}" 
                               class="inline-block text-gray-600 hover:text-[#5624d0] hover:border-[#5624d0] transition font-bold text-xs border border-gray-200 px-4 py-2 rounded-lg bg-white shadow-sm active:scale-95">
                                <i class="fas fa-envelope mr-1.5"></i> Hubungi Siswa
                            </a>
                        </td>
                    </tr>
                    @empty
                    {{-- State Tampilan Jika Instruktur Baru Belum Memiliki Siswa Hasil Transaksi --}}
                    <tr>
                        <td colspan="4" class="p-20 text-center text-gray-400">
                            <div class="flex justify-center text-gray-200 text-5xl mb-4">
                                <i class="fas fa-user-slash"></i>
                            </div>
                            <p class="italic font-medium">Belum ada data siswa yang mendaftar di kursus buatan Anda.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection