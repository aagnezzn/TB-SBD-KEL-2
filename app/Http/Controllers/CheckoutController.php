<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Enrollment; // Pastikan Anda punya model pendaftaran
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction; // <-- Wajib ada untuk menyimpan data
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
        $cartItems = \App\Models\Cart::where('user_id', Auth::id())
            ->with('course')
            ->get();

        // Cek jika keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong!');
        }

        // 2. Hitung total harga (sama seperti di function index)
        $total = $cartItems->sum(function($item) {
            return $item->course->price;
        });

        // 3. Simpan ke database (table transactions)
        // Catatan: Karena di tabel ada 'course_id', kita ambil dari item pertama di keranjang
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'course_id' => $cartItems->first()->course_id, 
            'payment_method' => $request->payment_method ?? 'Transfer Bank', // Ambil dari inputan form, default: Transfer Bank
            'amount' => $total,
            'status' => 'success',
            'paid_at' => Carbon::now(),
        ]);

        // 4. (Opsional tapi penting) Hapus keranjang setelah sukses bayar
        \App\Models\Cart::where('user_id', Auth::id())->delete();

        // 5. Arahkan ke halaman success sambil membawa ID transaksi
        // Pastikan nama route-nya sama dengan yang kamu buat di web.php
        return redirect()->route('checkout.invoice', ['id' => $transaction->id]);
    }

    // Function untuk menampilkan halaman payment-success.blade.php
    public function success($id)
    {
        // Cari data transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Lempar data ke blade dengan nama variabel 'payment' agar sesuai dengan bladenya
        return view('payment-success', ['payment' => $transaction]);
    }

    public function invoice($id)
    {
        // Ambil data transaksi
        $transaction = \App\Models\Transaction::findOrFail($id);

        // Lempar ke halaman invoice
        return view('invoice', ['payment' => $transaction]);
    }
}