<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa - IDEMY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Open Sans', sans-serif; }</style>
</head>
<body class="bg-[#f7f9fa] text-[#1c1d1f]">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-[#1c1d1f] text-white flex flex-col shrink-0">
            <div class="p-6 border-b border-gray-800">
                <h1 class="text-2xl font-bold tracking-tighter">idemy</h1>
                <p class="text-[10px] text-blue-400 font-bold uppercase tracking-widest mt-1">Instructor Portal</p>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('instructor.dashboard') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-th-large w-5"></i><span class="ml-3 text-sm">Dashboard</span>
                </a>
                <a href="{{ route('instructor.courses.index') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-play-circle w-5"></i><span class="ml-3 text-sm">Kursus Saya</span>
                </a>
                <a href="{{ route('instructor.students.index') }}" class="flex items-center p-3 bg-blue-600 text-white rounded-md transition font-bold shadow-lg shadow-blue-900/20">
                    <i class="fas fa-users w-5"></i><span class="ml-3 text-sm">Siswa</span>
                </a>
                <a href="{{ route('instructor.performance') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-chart-bar w-5"></i><span class="ml-3 text-sm">Performa</span>
                </a>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <form action="{{ route('logout') }}" method="POST">@csrf
                    <button type="submit" class="flex items-center w-full p-3 text-gray-500 hover:text-red-400 font-bold text-sm">
                        <i class="fas fa-sign-out-alt w-5"></i><span class="ml-3">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-10 shrink-0">
                <div class="font-bold text-gray-400 text-xs uppercase tracking-widest">Data Siswa Terdaftar</div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                    <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold uppercase border-2 border-white shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-10">
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
            </div>
        </main>
    </div>
</body>
</html>