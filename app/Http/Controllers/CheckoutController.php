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
        $cartItems = \App\Models\Cart::where('user_id', Auth::id())
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

        $total = $cartItems->sum(function($item) {
            return $item->course->price;
        });

        // --- PERBAIKAN: Gunakan looping agar semua kursus terdaftar ---
        foreach ($cartItems as $item) {
            $enrollment = Enrollment::create([
                'user_id'   => Auth::id(),
                'course_id' => $item->course_id, // Mengambil id masing-masing kursus
                // 'status' => 'active', // Tambahkan jika ada kolom status di tabelmu
            ]);

            // Buat data payment untuk setiap enrollment (pendaftaran)
            // Atau jika kamu ingin 1 payment untuk banyak kursus, logic ini bisa disesuaikan
            Payment::create([
                'enrollment_id'  => $enrollment->id,
                'amount'         => $item->course->price, // Harga per kursus
                'payment_method' => $request->payment_method ?? 'Transfer Bank',
                'status'         => 'success',
                'paid_at'        => Carbon::now(),
            ]);
        }

        // 3. Hapus semua item di keranjang setelah pendaftaran sukses
        Cart::where('user_id', Auth::id())->delete();

        // 4. Arahkan ke halaman My Learning (Pembelajaran Saya) agar user bisa langsung lihat hasilnya
        return redirect()->route('learning.index')->with('success', 'Pembelian berhasil!');
    }

    public function success($id)
    {
        $payment = Payment::findOrFail($id);
        return view('payment-success', ['payment' => $payment]);
    }

    public function invoice($id)
    {
        $payment = \App\Models\Payment::findOrFail($id);
        return view('invoice', ['payment' => $payment]);
    }
}