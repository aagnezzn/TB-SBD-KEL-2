<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performa Instruktur - IDEMY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Open Sans', sans-serif; }</style>
</head>
<body class="bg-[#f7f9fa] text-[#1c1d1f]">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-[#1c1d1f] text-white flex flex-col shrink-0">
            <div class="p-6 border-b border-gray-800">
                <h1 class="text-2xl font-bold tracking-tighter italic">idemy</h1>
                <p class="text-[10px] text-blue-400 font-bold uppercase tracking-widest mt-1">Instructor Portal</p>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('instructor.dashboard') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-th-large w-5"></i><span class="ml-3 text-sm">Dashboard</span>
                </a>
                <a href="{{ route('instructor.courses.index') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-play-circle w-5"></i><span class="ml-3 text-sm">Kursus Saya</span>
                </a>
                <a href="{{ route('instructor.students.index') }}" class="flex items-center p-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-md transition font-bold">
                    <i class="fas fa-users w-5"></i><span class="ml-3 text-sm">Siswa</span>
                </a>
                <a href="{{ route('instructor.performance') }}" class="flex items-center p-3 bg-blue-600 text-white rounded-md transition font-bold shadow-lg shadow-blue-900/20">
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
                <div class="font-bold text-gray-400 text-xs uppercase tracking-widest">Performance Analytics</div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                    <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold uppercase border-2 border-white shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-10">
                <div class="mb-10">
                    <h1 class="text-3xl font-bold tracking-tight">Performa Anda</h1>
                    <p class="text-gray-500 text-sm mt-1 italic">Data statistik pendapatan dan interaksi siswa.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                    <div class="bg-white p-8 border border-gray-100 shadow-sm rounded-sm">
                        <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Total Pendapatan</p>
                        <p class="text-4xl font-bold text-blue-600 mt-2">Rp {{ number_format($data['total_earnings'], 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white p-8 border border-gray-100 shadow-sm rounded-sm">
                        <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Siswa Terdaftar</p>
                        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $data['total_enrollments'] }}</p>
                    </div>
                    <div class="bg-white p-8 border border-gray-100 shadow-sm rounded-sm">
                        <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Rating Rata-rata</p>
                        <p class="text-4xl font-bold text-yellow-500 mt-2">{{ $data['avg_rating'] }} <span class="text-gray-300 text-sm italic font-normal">/ 5.0</span></p>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 p-8 shadow-sm">
    <div class="flex justify-between items-center mb-10">
        <h3 class="font-bold text-gray-700 uppercase text-xs tracking-widest italic">Aktivitas 7 Hari Terakhir</h3>
    </div>
    
    <div class="flex items-end justify-between h-56 gap-4 border-b border-gray-100 pb-2">
    @foreach($chartData as $dayData)
        <div class="relative group w-full flex flex-col items-center h-full justify-end">
            
            <span class="absolute -top-10 left-1/2 -translate-x-1/2 bg-black text-white text-[10px] p-2 rounded opacity-0 group-hover:opacity-100 transition shadow-xl whitespace-nowrap z-10">
                Rp {{ number_format($dayData['income'], 0, ',', '.') }}
            </span>
            
            <div class="w-full transition-all duration-700 {{ $dayData['income'] > 0 ? 'bg-blue-600 shadow-lg shadow-blue-200' : 'bg-gray-100' }} rounded-t-sm" 
                 style="height: {{ $dayData['income'] > 0 ? max($dayData['height'], 30) : 5 }}%;">
            </div>
            
            <span class="absolute -bottom-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                {{ $dayData['day'] }}
            </span>

        </div>
    @endforeach
</div>
    </div>
</div>
            </div>
        </main>
    </div>
</body>
</html>