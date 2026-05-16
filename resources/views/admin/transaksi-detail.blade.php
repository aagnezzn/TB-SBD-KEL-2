<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi #{{ $transaksi->id }} - Idemy Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center p-6">
        
        <div class="w-full max-w-2xl bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
            
            <div class="bg-[#5624d0] px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Detail Transaksi #{{ $transaksi->id }}</h2>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 uppercase tracking-wider">
                    {{ $transaksi->status }}
                </span>
            </div>

            <div class="p-6 space-y-6">
                
                <div class="bg-purple-50 rounded-lg p-4 text-center border border-purple-100">
                    <p class="text-sm text-gray-600 font-medium uppercase tracking-wider">Total Tagihan</p>
                    <p class="text-3xl font-extrabold text-[#5624d0] mt-1">
                        Rp {{ number_format($transaksi->amount, 0, ',', '.') }}
                    </p>
                </div>

                <div class="divide-y divide-gray-100">
                    
                    <div class="py-3 flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">Metode Pembayaran</span>
                        <span class="text-sm font-semibold text-gray-900 bg-gray-100 px-3 py-1 rounded">
                            {{ $transaksi->payment_method }}
                        </span>
                    </div>

                    <div class="py-3 flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">ID Transaksi Di Sistem</span>
                        <span class="text-sm font-mono text-gray-900">TRX-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <div class="py-3 flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">Waktu Transaksi</span>
                        <span class="text-sm text-gray-900 font-medium">
                            {{ $transaksi->created_at ? $transaksi->created_at->format('d F Y, H:i') : '-' }} WIB
                        </span>
                    </div>
                    
                </div>

            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end">
                <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-lg hover:bg-gray-700 transition duration-200 shadow-sm">
                    ← Kembali ke Dashboard
                </a>
            </div>

        </div>

    </div>

</body>
</html>