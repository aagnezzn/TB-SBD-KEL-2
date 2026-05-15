<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Idemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f7f9fa] flex h-screen overflow-hidden font-sans text-[#1c1d1f]">

    @include('admin.sidebar')

    <main class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
        
        <header class="h-16 bg-[#8710d8] border-b border-white/20 flex items-center justify-between px-8 shrink-0 shadow-md">
            <h2 class="text-xl font-bold">Kelola kelas</h2>
            <div class="flex items-center gap-6">
                <span class="text-sm font-semibold text-[#6a6f73]">Halo, Admin!</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-700 flex items-center gap-2">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-[1400px]"> <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl border border-[#d1d7dc] shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xl shrink-0">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div>
                            <h3 class="text-[#6a6f73] text-sm font-bold">Total Pendapatan</h3>
                            <p class="text-2xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl border border-[#d1d7dc] shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-purple-100 text-[#a435f0] flex items-center justify-center text-xl shrink-0">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <div>
                            <h3 class="text-[#6a6f73] text-sm font-bold">Total Kelas</h3>
                            <p class="text-2xl font-bold">{{ $totalKelas }} Kelas</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-[#d1d7dc] shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl shrink-0">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <h3 class="text-[#6a6f73] text-sm font-bold">Total Siswa</h3>
                            <p class="text-2xl font-bold">{{ $totalSiswa }} Orang</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-[#d1d7dc] shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-[#d1d7dc] flex justify-between items-center">
                        <h3 class="font-bold">Transaksi Terbaru</h3>
                        <a href="{{ route('admin.transactions') }}" class="text-[#a435f0] text-sm font-bold hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-[#f7f9fa] text-[#6a6f73] text-sm border-b border-[#d1d7dc]">
                                    <th class="px-6 py-4 font-bold">ID</th>
                                    <th class="px-6 py-4 font-bold">Metode</th>
                                    <th class="px-6 py-4 font-bold">Total</th>
                                    <th class="px-6 py-4 font-bold">Status</th>
                                    <th class="px-6 py-4 font-bold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksiTerbaru as $trx)
                                <tr class="border-b border-[#d1d7dc] hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-semibold">#{{ $trx->id }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $trx->payment_method }}</td>
                                    <td class="px-6 py-4 text-sm font-bold">Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase {{ $trx->status == 'success' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ $trx->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="bg-gray-100 text-[#1c1d1f] px-3 py-1.5 rounded text-xs font-bold hover:bg-gray-200 transition-colors">Detail</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada transaksi terbaru.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>