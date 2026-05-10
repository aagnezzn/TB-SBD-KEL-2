<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Materi - IDEMY</title>
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
                    <i class="fas fa-th-large w-5"></i><span class="ml-3 text-sm text-gray-400">Dashboard</span>
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
                    <button type="submit" class="flex items-center w-full p-3 text-gray-500 font-bold text-sm">
                        <i class="fas fa-sign-out-alt w-5"></i><span class="ml-3">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-10 shrink-0">
                <div class="flex items-center gap-3">
                    <a href="{{ route('instructor.courses.index') }}" class="text-gray-300 hover:text-gray-600"><i class="fas fa-arrow-left"></i></a>
                    <span class="font-bold text-gray-400 text-xs uppercase tracking-widest border-l pl-3 border-gray-200">Kurikulum</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                    <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold uppercase border-2 border-white shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-10 text-sm">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold tracking-tight">{{ $course->title }}</h1>
                </div>

                <div class="grid grid-cols-3 gap-10">
                    <div class="col-span-1">
                        <div class="bg-white border border-gray-200 p-6 shadow-sm rounded-sm">
                            <h3 class="font-bold text-gray-700 mb-5 border-b pb-2 uppercase text-[11px] tracking-widest">Input Materi</h3>
                            <form action="{{ route('instructor.lessons.store', $course->id) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Judul Bab</label>
                                    <input type="text" name="title" class="w-full border border-gray-200 p-3 rounded-sm outline-none focus:border-blue-600" required>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Deskripsi Bab</label>
                                    <textarea name="content" class="w-full border border-gray-200 p-3 rounded-sm outline-none focus:border-blue-600 h-24" placeholder="Masukkan penjelasan materi..." required></textarea>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Durasi (Menit)</label>
                                    <input type="number" name="duration" class="w-full border border-gray-200 p-3 rounded-sm outline-none focus:border-blue-600" required>
                                </div>
                                <button type="submit" class="w-full bg-[#1c1d1f] text-white py-3 font-bold text-xs uppercase tracking-widest hover:bg-black transition-all">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <div class="bg-white border border-gray-200 shadow-sm rounded-sm overflow-hidden">
                            <div class="bg-gray-50 p-4 border-b border-gray-200 font-bold text-xs uppercase tracking-widest text-gray-400">Daftar Pelajaran</div>
                            <div class="divide-y divide-gray-100">
                                @foreach($course->lessons as $lesson)
                                <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition">
                                    <div class="flex items-center gap-4">
                                        <i class="fas fa-play-circle text-gray-300 text-lg"></i>
                                        <div>
                                            <div class="font-bold text-gray-800">{{ $lesson->title }}</div>
                                            <div class="text-[10px] text-gray-400 italic">{{ $lesson->duration }} Menit</div>
                                        </div>
                                    </div>
                                    <button class="text-gray-300 hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>