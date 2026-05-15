<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard - IDEMY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Open Sans', sans-serif; }</style>
</head>
<body class="bg-[#f7f9fa] text-[#1c1d1f]">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-[#1c1d1f] text-white flex flex-col shrink-0">
            <div class="p-6">
                <h1 class="text-2xl font-bold tracking-tighter">idemy</h1>
                <p class="text-[10px] text-blue-400 font-bold uppercase tracking-widest mt-1">Instructor Portal</p>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-1">
                <a href="{{ route('instructor.dashboard') }}" class="flex items-center p-3 bg-blue-600 text-white rounded-md transition font-bold">
                    <i class="fas fa-th-large w-5"></i><span class="ml-3">Dashboard</span>
                </a>
                <a href="{{ route('instructor.courses.index') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-play-circle w-5"></i><span class="ml-3 text-sm">Kursus Saya</span>
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
                    <button type="submit" class="flex items-center w-full p-3 text-gray-400 hover:text-red-400 font-bold text-sm">
                        <i class="fas fa-sign-out-alt w-5"></i><span class="ml-3">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-10 shrink-0">
                <div class="font-bold text-gray-400 text-xs uppercase tracking-widest">Dashboard</div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                    <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold uppercase shadow-md shadow-blue-200">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-10">
                <div class="flex justify-between items-center mb-10">
                    <h1 class="text-3xl font-bold">Halo, Instruktur!</h1>
                    <a href="{{ route('instructor.courses.create') }}" class="bg-blue-600 text-white px-6 py-3 font-bold text-sm hover:bg-blue-700 shadow-lg shadow-blue-100">Buat Kursus Baru</a>
                </div>

                <div class="grid grid-cols-3 gap-8 mb-10">
                    <div class="bg-white p-8 border border-gray-100 shadow-sm rounded-sm">
                        <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Total Kursus</p>
                        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalCourses }}</p>
                    </div>
                    <div class="bg-white p-8 border border-gray-100 shadow-sm rounded-sm">
                        <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Total Siswa</p>
                        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalStudents }}</p>
                    </div>
                    <div class="bg-white p-8 border border-gray-100 shadow-sm rounded-sm">
                        <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Rating</p>
                        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $avgRating ?? '0.0' }}</p>
                    </div>
                </div>

                <h3 class="font-bold mb-6 text-gray-800">Kursus Anda</h3>
                <div class="bg-white border border-gray-200 shadow-sm rounded-sm overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200 text-[11px] font-bold text-gray-400 uppercase">
                            <tr><th class="p-5">Judul Kursus</th><th class="p-5">Harga</th><th class="p-5">Status</th><th class="p-5 text-right">Aksi</th></tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($courses as $course)
                            <tr class="hover:bg-gray-50/50">
                                <td class="p-5 font-bold">{{ $course->title }}</td>
                                <td class="p-5 font-bold text-gray-600">Rp {{ number_format($course->price, 0, ',', '.') }}</td>
                                <td class="p-5"><span class="px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-bold rounded-full uppercase">Published</span></td>
                                <td class="p-5 text-right"><a href="{{ route('instructor.courses.edit', $course->id) }}" class="text-blue-600 font-bold text-sm hover:underline"><i class="fas fa-edit mr-1"></i> Edit Materi</a></td>
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