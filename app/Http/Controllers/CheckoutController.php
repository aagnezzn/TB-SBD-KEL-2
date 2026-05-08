<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Enrollment; // Pastikan Anda punya model pendaftaran
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
{
    // Mengambil item keranjang dari database berdasarkan user yang login
    $cartItems = \App\Models\Cart::where('user_id', auth()->id())
                     ->with('course') 
                     ->get();

    // Menghitung total harga dari semua kursus di keranjang
    $total = $cartItems->sum(function($item) {
        return $item->course->price;
    });

    return view('checkout', compact('cartItems', 'total'));
}

    public function store(Request $request)
{
    $cartItems = \App\Models\Cart::where('user_id', auth()->id())
                    ->with('course')
                    ->get();

    foreach ($cartItems as $item) {

        $enrollment = Enrollment::create([
            'user_id' => auth()->id(),
            'course_id' => $item->course_id,
            'status' => 'active'
        ]);

        $payment = Payment::create([
            'enrollment_id'  => $enrollment->id,
            'amount'         => $item->course->price,
            'payment_method' => $request->payment_method,
            'status'         => 'success',
            'paid_at'        => now(),
        ]);
    }

    // hapus cart setelah checkout
    \App\Models\Cart::where('user_id', auth()->id())->delete();

    return redirect()->route('payment.success', $payment->id);
}

public function success($id)
{
    $payment = Payment::with('enrollment.course')
                ->findOrFail($id);

    return view('payment-success', compact('payment'));
}
}