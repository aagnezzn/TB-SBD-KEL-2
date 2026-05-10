<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Saya - IDEMY</title>
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
                <a href="{{ route('instructor.courses.index') }}" class="flex items-center p-3 bg-blue-600 text-white rounded-md transition font-bold shadow-lg shadow-blue-900/20">
                    <i class="fas fa-play-circle w-5"></i><span class="ml-3 text-sm text-white">Kursus Saya</span>
                </a>
                <a href="{{ route('instructor.students.index') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
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
                <div class="font-bold text-gray-400 text-xs uppercase tracking-widest">Manajemen Kursus</div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                    <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold uppercase border-2 border-white shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-10">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h1 class="text-3xl font-bold tracking-tight">Kursus Saya</h1>
                        <p class="text-gray-400 text-sm mt-1 italic">Kelola semua daftar kursus Anda.</p>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 shadow-sm rounded-sm overflow-hidden">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200 text-[11px] uppercase text-gray-400 font-bold tracking-widest">
                            <tr><th class="p-5">Judul</th><th class="p-5">Harga</th><th class="p-5">Status</th><th class="p-5 text-right">Aksi</th></tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($courses as $course)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="p-5 font-bold">{{ $course->title }}</td>
                                <td class="p-5 font-bold text-gray-600 tracking-tight">Rp {{ number_format($course->price, 0, ',', '.') }}</td>
                                <td class="p-5"><span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-700 uppercase">Published</span></td>
                                <td class="p-5 text-right"><a href="{{ route('instructor.courses.manage', $course->id) }}" class="text-blue-600 hover:text-blue-800 font-bold"><i class="fas fa-tasks mr-2"></i>Kelola Materi</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>