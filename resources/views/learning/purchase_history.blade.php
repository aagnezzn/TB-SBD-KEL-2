@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Purchase history</h1>

    <div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50 text-sm font-bold text-gray-700">
                    <th class="px-6 py-4">Course</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Total price</th>
                    <th class="px-6 py-4">Payment method</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($payments as $payment)
                    <tr class="text-sm text-gray-700 hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-purple-700 capitalize">
                            {{-- FAKTANYA: Akses langsung ke properti course tanpa lewat enrollment --}}
                            {{ $payment->course->title ?? 'Course Deleted' }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ \Carbon\Carbon::parse($payment->paid_at)->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $payment->payment_method }}
                        </td>
                        <td class="px-6 py-4">
                            @if(strtolower($payment->status) == 'success')
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full">
                                    {{ strtoupper($payment->status) }}
                                </span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full">
                                    {{ strtoupper($payment->status) }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            You haven't made any purchases yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection