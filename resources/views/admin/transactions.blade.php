<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Admin Idemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f7f9fa] flex h-screen overflow-hidden font-sans text-[#1c1d1f]">

    @include('admin.sidebar')

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
    <header class="h-16 bg-[#6a11cb] border-b border-white/20 flex items-center justify-between px-8 shrink-0 shadow-md">
            <h2 class="text-xl font-bold text-white">Transaksi</h2>
            <div class="flex items-center gap-6">
                <span class="text-sm font-semibold text-white/90">Halo, Admin!</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-400 flex items-center gap-2">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
            </div>
        </header>

        <div class="p-8">
            <h3 class="text-2xl font-bold mb-6">Riwayat Pembayaran</h3>

            <div class="bg-white rounded-xl border border-[#d1d7dc] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#f7f9fa] text-[#6a6f73] text-sm border-b border-[#d1d7dc]">
                                <th class="px-6 py-4 font-bold">ID</th>
                                <th class="px-6 py-4 font-bold">Siswa</th>
                                <th class="px-6 py-4 font-bold">Kelas</th>
                                <th class="px-6 py-4 font-bold text-center">Metode</th>
                                <th class="px-6 py-4 font-bold">Total</th>
                                <th class="px-6 py-4 font-bold text-center">Status</th>
                                <th class="px-6 py-4 font-bold">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                            <tr class="border-b border-[#d1d7dc] hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-semibold">#{{ $payment->id }}</td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-sm text-[#1c1d1f]">{{ $payment->enrollment->user->name ?? 'User Hilang' }}</p>
                                    <p class="text-xs text-[#6a6f73]">{{ $payment->enrollment->user->email ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#1c1d1f]">
                                    {{ $payment->enrollment->course->title ?? 'Kelas Terhapus' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-center">
                                    <span class="bg-gray-100 px-2 py-1 rounded text-xs font-semibold">{{ $payment->payment_method }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm font-bold whitespace-nowrap text-[#1c1d1f]">
                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($payment->status == 'success')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold italic">Paid</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">{{ $payment->status }}</span>
                                    @endif
                                </td>
                              <td class="px-6 py-4 text-xs text-[#6a6f73] whitespace-nowrap">
                                    {{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d M Y, H:i') : $payment->created_at->format('d M Y') }}
                              </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-[#6a6f73]">Belum ada data transaksi masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6">
                    {{ $payments->links() }}
                </div>
        </div>
    </main>

</body>
</html>