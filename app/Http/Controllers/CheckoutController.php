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

        $lastPaymentId = null;

        // Database Transaction memastikan konsistensi data relasional
        DB::transaction(function () use ($cartItems, $request, &$lastPaymentId) {
            foreach ($cartItems as $item) {
                
                $payment = Payment::create([
                'user_id'        => Auth::id(),
                'course_id'      => $item->course_id,
                'amount'         => $item->course->price, 
                'payment_method' => $request->payment_method ?? 'Transfer Bank',
                'status'         => 'pending', // UBAH KE PENDING
                'paid_at'        => null,      // Kosongkan karena belum bayar
                ]);


                $lastPaymentId = $payment->id;
            }

            Cart::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('checkout.invoice', ['id' => $lastPaymentId]);
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

    public function confirmPayment($id)
{
    $payment = Payment::findOrFail($id);

    // Update status payment
    $payment->update([
        'status' => 'success',
        'paid_at' => Carbon::now(),
    ]);

    // Sekarang baru buat Enrollment-nya!
    Enrollment::create([
        'user_id'     => $payment->user_id,
        'course_id'   => $payment->course_id,
        'status'      => 'active',
        'enrolled_at' => Carbon::now(),
    ]);

    return redirect()->route('transaction.success', ['id' => $payment->id]);
}
}