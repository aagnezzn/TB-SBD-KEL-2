<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - IDEMY Instructor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #fcfaff; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #dcd0ff; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #5624d0; }
    </style>
</head>
<body class="bg-[#fcfaff] text-[#1c1d1f] antialiased">
    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-72 bg-[#5624d0] flex flex-col h-screen text-white shrink-0 shadow-2xl z-20">
            <div class="h-24 px-8 border-b border-white/10 flex flex-col justify-center shrink-0">
                <h1 class="text-3xl font-black tracking-tighter leading-none">idemy</h1>
                <p class="text-[10px] text-[#a435f0] font-black uppercase tracking-widest mt-1">Instructor Portal</p>
            </div>

            {{-- Navigasi Sidebar --}}
            <nav class="flex-1 p-4 space-y-2 mt-4 overflow-y-auto custom-scrollbar">
                @php
                    $active = 'bg-white text-[#5624d0] shadow-xl font-bold scale-[1.02]';
                    $inactive = 'text-white/80 hover:bg-[#4c1da7] hover:text-white transition-all duration-200';
                @endphp

                <a href="{{ route('instructor.dashboard') }}" 
                   class="flex items-center gap-4 px-6 py-4 rounded-xl {{ request()->routeIs('instructor.dashboard') ? $active : $inactive }}">
                    <i class="fas fa-chart-pie text-lg"></i>
                    <span class="text-sm">Ringkasan</span>
                </a>

                <a href="{{ route('instructor.courses.index') }}" 
                   class="flex items-center gap-4 px-6 py-4 rounded-xl {{ request()->routeIs('instructor.courses.*') ? $active : $inactive }}">
                    <i class="fas fa-video text-lg"></i>
                    <span class="text-sm">Kelola Kelas</span>
                </a>

                <a href="{{ route('instructor.students.index') }}" 
                   class="flex items-center gap-4 px-6 py-4 rounded-xl {{ request()->routeIs('instructor.students.*') ? $active : $inactive }}">
                    <i class="fas fa-users text-lg"></i>
                    <span class="text-sm">Siswa</span>
                </a>

                <a href="{{ route('instructor.performance') }}" 
                   class="flex items-center gap-4 px-6 py-4 rounded-xl {{ request()->routeIs('instructor.performance') ? $active : $inactive }}">
                    <i class="fas fa-receipt text-lg"></i>
                    <span class="text-sm">Performa</span>
                </a>
            </nav>

            {{-- Logout Section --}}
            <div class="p-6 border-t border-white/10 shrink-0">
                <form action="{{ route('logout') }}" method="POST">@csrf
                    <button type="submit" class="flex items-center gap-4 w-full px-6 py-4 text-white/60 hover:text-white hover:bg-red-500/20 rounded-xl transition-all font-bold">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="text-sm">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Header + Content --}}
        <main class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
            
            {{-- HEADER --}}
            <header class="h-24 bg-white border-b border-white/20 flex items-center justify-between px-8 shrink-0 shadow-md">
                {{-- KIRI: Page Title --}}
                <div class="text-xl font-bold text-black">
                    @yield('page_title')
                </div>

                {{-- User Info --}}
                <div class="flex items-center gap-6">
                    <span class="text-sm font-bold text-white">{{ Auth::user()->name }}</span>
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-[#5624d0] font-bold uppercase border-4 border-white shadow-lg shadow-purple-900/20">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            {{-- ISI KONTEN --}}
            <div class="flex-1 overflow-y-auto p-12 custom-scrollbar bg-[#fcfaff]">
                <div class="max-w-6xl mx-auto">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>