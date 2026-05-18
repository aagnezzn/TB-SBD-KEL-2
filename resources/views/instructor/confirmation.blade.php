<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Instruktur - Idemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f7f9fa] font-sans text-[#1c1d1f] min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-xl bg-white border border-[#d1d7dc] shadow-lg rounded-xl p-8 md:p-10 text-center space-y-6">
        
        {{-- Ikon Selamat / Proteksi Visual --}}
        <div class="flex justify-center text-[#a435f0]">
            <div class="w-20 h-20 bg-purple-50 rounded-full flex items-center justify-center text-4xl shadow-inner">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
        </div>

        {{-- Judul Halaman --}}
        <div class="space-y-2">
            <h1 class="font-bold text-2xl md:text-3xl text-gray-900 tracking-tight">Langkah Pengajuan Pengajar</h1>
            <p class="text-sm text-gray-600">Konfirmasi data akun Anda sebelum beralih peran menjadi Instruktur resmi Idemy</p>
        </div>

        {{-- Kotak Informasi Pengguna (Titik Eror Nomor 16 Lama yang Sudah Diamankan) --}}
        <div class="bg-gray-50 border border-[#d1d7dc] rounded-lg p-5 text-left space-y-3">
            <h3 class="text-xs font-black uppercase tracking-wider text-gray-400 border-b border-[#d1d7dc] pb-2 flex items-center gap-2">
                <i class="fas fa-user-circle text-sm"></i> Detail Akun Pemohon
            </h3>
            
            <div class="grid grid-cols-3 gap-y-2 text-sm">
                <span class="text-gray-500 font-medium">Nama Lengkap</span>
                <span class="col-span-2 font-bold text-gray-900">: {{ Auth::user()->name ?? 'Tamu / Belum Login' }}</span>
                
                <span class="text-gray-500 font-medium">Alamat Email</span>
                <span class="col-span-2 font-mono text-gray-800 text-xs font-bold">: {{ Auth::user()->email ?? 'guest@idemy.com (Silakan Login)' }}</span>
                
                <span class="text-gray-500 font-medium">Role Saat Ini</span>
                <span class="col-span-2 flex items-center gap-1.5 font-bold">
                    : <span class="bg-gray-200 text-gray-700 text-[10px] font-black px-2 py-0.5 rounded uppercase">{{ Auth::user()->role ?? 'GUEST' }}</span>
                </span>
            </div>
        </div>

        {{-- Form Aksi Upgrade Role --}}
        <div class="pt-4 space-y-4">
            @auth
                @if(Auth::user()->role !== 'instructor')
                    <form action="{{ route('instructor.upgrade') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="w-full bg-[#a435f0] hover:bg-[#8710d8] text-white font-bold py-3 px-6 rounded-lg transition-all duration-200 shadow-md flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fas fa-user-plus"></i> Konfirmasi & Upgrade Jadi Instruktur Sekarang
                        </button>
                    </form>
                @else
                    <div class="bg-green-100 border border-green-200 text-green-800 text-sm font-bold p-4 rounded-lg flex items-center justify-center gap-2">
                        <i class="fas fa-check-circle"></i> Akun Anda sudah berstatus sebagai Instruktur aktif!
                    </div>
                    <a href="{{ route('instructor.dashboard') }}" class="block w-full bg-gray-900 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-lg text-sm transition shadow-md">
                        Buka Dashboard Instruktur <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                @endif
            @else
                {{-- Tampilan Tombol Jika Pengunjung Belum Login --}}
                <a href="{{ route('login') }}" class="block w-full bg-purple-700 hover:bg-purple-800 text-white font-bold py-3 px-6 rounded-lg text-sm transition shadow-md">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login Terlebih Dahulu
                </a>
            @endauth

            <div class="flex justify-center pt-2">
                <a href="{{ url('/') }}" class="text-sm font-bold text-gray-500 hover:text-purple-700 hover:underline flex items-center gap-1.5 transition">
                    <i class="fas fa-chevron-left text-xs"></i> Batal & Kembali ke Beranda
                </a>
            </div>
        </div>

        {{-- Footer Info --}}
        <div class="border-t border-gray-100 pt-4 flex items-center justify-center text-[11px] text-gray-400 gap-1.5 leading-relaxed">
            <i class="fas fa-shield-alt"></i> Dengan menekan tombol konfirmasi, Anda menyetujui seluruh aturan pakem kode etik pengajar platform Idemy USU 2026.
        </div>

    </div>

</body>
</html>