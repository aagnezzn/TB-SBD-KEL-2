<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\Enrollment; 
use App\Models\Course; // FAKTA: Tambahkan ini agar model Course terbaca
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
                         ->with('course') 
                         ->get();

        $total = $cartItems->sum(function($item) {
            return $item->course->price;
        });

        return view('checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('course')->get();
        if ($cartItems->isEmpty()) return redirect()->back()->with('error', 'Keranjang kosong!');

        $paymentIds = []; // 1. Buat array untuk menampung ID

        DB::transaction(function () use ($cartItems, $request, &$paymentIds) {
            foreach ($cartItems as $item) {
                $payment = Payment::create([
                    'user_id'        => Auth::id(),
                    'course_id'      => $item->course_id,
                    'amount'         => $item->course->price, 
                    'payment_method' => $request->payment_method ?? 'Transfer Bank',
                    'status'         => 'pending', 
                    'paid_at'        => null, 
                ]);
                $paymentIds[] = $payment->id; // 2. Kumpulkan semua ID
            }
            Cart::where('user_id', Auth::id())->delete();
        });

        // 3. Simpan ID ke Session agar Invoice tahu apa yang harus dibayar
        session(['pending_payment_ids' => $paymentIds]);

        return redirect()->route('checkout.invoice.batch');
    }
    public function invoice($id)
    {
        // FAKTANYA: Relasi diubah langsung memanggil course, bukan lewat enrollment lagi
        $payment = Payment::with('course')->findOrFail($id);

        return view('invoice', compact('payment'));
    }

    public function success($id)
    {
        return redirect()->route('learning.index')
                         ->with('success', 'Pembayaran berhasil dikonfirmasi! Selamat belajar.');
    }

    public function confirmAll()
    {
        $ids = session('pending_payment_ids');
        $payments = Payment::whereIn('id', $ids)->get();

        DB::transaction(function () use ($payments) {
            foreach ($payments as $payment) {
                $payment->update(['status' => 'success', 'paid_at' => Carbon::now()]);
                
                Enrollment::firstOrCreate([
                    'user_id'   => $payment->user_id,
                    'course_id' => $payment->course_id,
                ], [
                    'status'      => 'active',
                    'enrolled_at' => Carbon::now(),
                ]);
            }
        });

        session()->forget('pending_payment_ids');
        return redirect()->route('learning.index')->with('success', 'Semua kursus berhasil diaktifkan!');
    }

public function invoiceBatch()
    {
        $ids = session('pending_payment_ids');
        if (!$ids) return redirect()->route('checkout')->with('error', 'Sesi pembayaran berakhir.');

        // Ambil SEMUA pembayaran yang pending untuk user ini
        $payments = Payment::with('course')->whereIn('id', $ids)->get();
        return view('invoice', compact('payments'));
    }
}