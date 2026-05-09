<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\Enrollment; // Pastikan Anda punya model pendaftaran
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;          // <-- Wajib ada untuk mencatat waktu bayar

class CheckoutController extends Controller
{
    public function index()
{
    // Mengambil item keranjang dari database berdasarkan user yang login
    $cartItems = \App\Models\Cart::where('user_id', Auth::id())
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
        $cartItems = Cart::where('user_id', Auth::id())->with('course')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $total = $cartItems->sum(function($item) {
            return $item->course->price;
        });

        // 1. BUAT DATA ENROLLMENT (PENDAFTARAN) DULU
        $enrollment = Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $cartItems->first()->course_id,
            // Jika di tabel enrollments kamu ada kolom lain seperti 'status' => 'active', tambahkan di sini
        ]);

        // 2. BARU BUAT DATA PAYMENT BERDASARKAN ENROLLMENT TADI
        $payment = Payment::create([
            'enrollment_id' => $enrollment->id, // Mengambil ID dari pendaftaran di atas
            'amount' => $total,
            'payment_method' => $request->payment_method ?? 'Transfer Bank',
            'status' => 'success',
            'paid_at' => Carbon::now(),
        ]);

        // 3. Hapus keranjang setelah sukses
        Cart::where('user_id', Auth::id())->delete();

        // 4. Arahkan ke halaman ecek-ecek (invoice)
        return redirect()->route('checkout.invoice', ['id' => $payment->id]);
    }

    // Function untuk menampilkan halaman payment-success.blade.php
    public function success($id)
    {
        // Cari data transaksi berdasarkan ID
        $payment = Payment::findOrFail($id);

        // Lempar data ke blade dengan nama variabel 'payment' agar sesuai dengan bladenya
        return view('payment-success', ['payment' => $payment]);
    }

    public function invoice($id)
    {
        // Ambil data transaksi
        $payment = \App\Models\Payment::findOrFail($id);

        // Lempar ke halaman invoice
        return view('invoice', ['payment' => $payment]);
    }
}