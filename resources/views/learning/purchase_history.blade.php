@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12 min-h-[60vh]">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Purchase history</h1>

    <div class="bg-white border border-gray-200 rounded-sm overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Course</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Total price</th>
                        <th class="px-6 py-4">Payment method</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($payments as $payment)
                        <tr class="text-sm text-gray-700 hover:bg-gray-50/80 transition-colors">
                            {{-- Judul Kelas Pembelian --}}
                            <td class="px-6 py-4 font-bold text-purple-700">
                                {{ $payment->course->title ?? 'Course Deleted' }}
                            </td>
                            
                            {{-- Tanggal Pembayaran Aman Melalui Tameng Validasi Fallback --}}
                            <td class="px-6 py-4 text-gray-500 font-medium">
                                @if($payment->paid_at)
                                    {{ \Carbon\Carbon::parse($payment->paid_at)->format('M d, Y') }}
                                @else
                                    {{ $payment->created_at->format('M d, Y') }}
                                @endif
                            </td>
                            
                            {{-- Nominal Biaya Transaksi --}}
                            <td class="px-6 py-4 font-bold text-gray-900">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </td>
                            
                            {{-- Metode Pembayaran --}}
                            <td class="px-6 py-4 font-medium text-gray-600">
                                {{ $payment->payment_method }}
                            </td>
                            
                            {{-- Status Label Transaksi --}}
                            <td class="px-6 py-4">
                                @if(strtolower($payment->status) == 'success')
                                    <span class="px-2.5 py-1 bg-green-100 text-green-800 text-[10px] font-black rounded-full uppercase tracking-wider">
                                        Paid
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 bg-yellow-100 text-yellow-800 text-[10px] font-black rounded-full uppercase tracking-wider">
                                        {{ $payment->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-400 font-medium italic">
                                <i class="fas fa-receipt text-3xl mb-3 block text-gray-200"></i>
                                You haven't made any purchases yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection