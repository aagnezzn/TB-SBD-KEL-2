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

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $now = Carbon::now();
        $lastPaymentId = null;

        // Database Transaction memastikan konsistensi data relasional
        DB::transaction(function () use ($cartItems, $now, $request, &$lastPaymentId) {
            foreach ($cartItems as $item) {
                // 1. Buat Pendaftaran Mandiri (Tanpa mengikat payment)
                Enrollment::create([
                    'user_id'     => Auth::id(),
                    'course_id'   => $item->course_id, 
                    'status'      => 'active', // Langsung aktif karena default di up() adalah success
                    'enrolled_at' => $now,
                ]);

                // 2. Buat Catatan Pembayaran Mandiri (Menggunakan user_id dan course_id sesuai migration barumu)
                $payment = Payment::create([
                    'user_id'        => Auth::id(),
                    'course_id'      => $item->course_id,
                    'amount'         => $item->course->price, 
                    'payment_method' => $request->payment_method ?? 'Transfer Bank',
                    'status'         => 'success', // Sesuai default value di migration baru kamu
                    'paid_at'        => $now,
                ]);

                $lastPaymentId = $payment->id;
            }

            // 3. Destruksi data keranjang belanja setelah checkout sukses
            Cart::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('checkout.invoice', ['id' => $lastPaymentId])
                         ->with('success', 'Pesanan berhasil dibuat, silakan selesaikan pembayaran.');
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
}