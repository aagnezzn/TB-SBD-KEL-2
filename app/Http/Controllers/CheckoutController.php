<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\Enrollment; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;          

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

        // Proses looping pendaftaran kelas massal
        foreach ($cartItems as $item) {
            $enrollment = Enrollment::create([
                'user_id'   => Auth::id(),
                'course_id' => $item->course_id, 
                'created_at' => $now, // Paksa sinkronisasi waktu murni database
                'updated_at' => $now,
            ]);

            Payment::create([
                'enrollment_id'  => $enrollment->id,
                'amount'         => $item->course->price, 
                'payment_method' => $request->payment_method ?? 'Transfer Bank',
                'status'         => 'success',
                'paid_at'        => $now,
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);
        }

        // Hapus item di keranjang user setelah sukses checkout
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('learning.index')->with('success', 'Pembelian berhasil!');
    }
}