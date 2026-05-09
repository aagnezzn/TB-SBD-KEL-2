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

    <aside class="w-64 bg-white border-r border-[#d1d7dc] flex flex-col">
        <div class="h-16 flex items-center px-6 border-b border-[#d1d7dc]">
            <span class="text-3xl font-bold">idemy <span class="text-sm font-normal text-[#a435f0] bg-purple-100 px-2 py-1 rounded">Admin</span></span>
        </div>
        
        <nav class="flex-1 py-6 px-4 space-y-2">
            <a href="#" class="flex items-center px-4 py-3 text-[#a435f0] bg-[#f7f9fa] border border-[#d1d7dc] rounded-lg font-bold transition-colors">
                <i class="fas fa-chart-pie w-6"></i> Ringkasan
            </a>
            <a href="{{ route('admin.courses') }}" class="flex items-center px-4 py-3 text-[#1c1d1f] hover:bg-gray-100 rounded-lg transition-colors">
               <i class="fas fa-video w-6 text-[#6a6f73]"></i> Kelola Kelas
            </a>
            <a href="{{ route('admin.transactions') }}" class="flex items-center px-4 py-3 text-[#1c1d1f] hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-receipt w-6 text-[#6a6f73]"></i> Transaksi
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 text-[#1c1d1f] hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-users w-6 text-[#6a6f73]"></i> Pengguna
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-16 bg-white border-b border-[#d1d7dc] flex items-center justify-between px-8 sticky top-0 z-10">
            <h2 class="text-xl font-bold">Dashboard</h2>
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

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl border border-[#d1d7dc] shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xl">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <h3 class="text-[#6a6f73] text-sm font-bold">Total Pendapatan</h3>
                        <p class="text-2xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl border border-[#d1d7dc] shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-purple-100 text-[#a435f0] flex items-center justify-center text-xl">
                        <i class="fas fa-play-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-[#6a6f73] text-sm font-bold">Total Kelas</h3>
                        <p class="text-2xl font-bold">{{ $totalKelas }} Kelas</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl border border-[#d1d7dc] shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div>
                        <h3 class="text-[#6a6f73] text-sm font-bold">Total Siswa</h3>
                        <p class="text-2xl font-bold">{{ $totalSiswa }} Orang</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-[#d1d7dc] shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#d1d7dc]">
                    <h3 class="font-bold">Transaksi Terbaru</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#f7f9fa] text-[#6a6f73] text-sm border-b border-[#d1d7dc]">
                                <th class="px-6 py-3 font-bold">ID</th>
                                <th class="px-6 py-3 font-bold">Metode</th>
                                <th class="px-6 py-3 font-bold">Total</th>
                                <th class="px-6 py-3 font-bold">Status</th>
                                <th class="px-6 py-3 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse($transaksiTerbaru as $trx)
                              <tr class="border-b border-[#d1d7dc] hover:bg-gray-50">
                              <td class="px-6 py-4 text-sm font-semibold">#{{ $trx->id }}</td>
                              <td class="px-6 py-4 text-sm">{{ $trx->payment_method }}</td>
                              <td class="px-6 py-4 text-sm font-bold">Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                              <td class="px-6 py-4">
                            @if($trx->status == 'success')
                              <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Success</span>
                           @else
                              <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">{{ ucfirst($trx->status) }}</span>
                        @endif
                              </td>
                              <td class="px-6 py-4 text-center">
                                 <button class="text-[#a435f0] hover:text-[#8710d8] font-bold text-sm">Detail</button>
                              </td>
                           </tr>
                        @empty
                           <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada transaksi.</td>
                        </tr>
                     @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>