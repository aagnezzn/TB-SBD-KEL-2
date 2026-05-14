<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\Enrollment; 
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

        // Gunakan Database Transaction agar jika satu gagal, semua batal (aman dari data sampah)
        DB::transaction(function () use ($cartItems, $now, $request, &$lastPaymentId) {
            foreach ($cartItems as $item) {
                // 1. Buat Pendaftaran
                $enrollment = Enrollment::create([
                    'user_id'    => Auth::id(),
                    'course_id'  => $item->course_id, 
                    'status'     => 'active',
                    'enrolled_at' => $now,
                ]);

                // 2. Buat Catatan Pembayaran
                $payment = Payment::create([
                    'enrollment_id'  => $enrollment->id,
                    'amount'         => $item->course->price, 
                    'payment_method' => $request->payment_method ?? 'Transfer Bank',
                    'status'         => 'success',
                    'paid_at'        => $now,
                ]);

                $lastPaymentId = $payment->id;
            }

            // 3. Hapus keranjang setelah data pendaftaran & pembayaran aman
            Cart::where('user_id', Auth::id())->delete();
        });

        // FIX ALUR: Jangan langsung ke learning, tapi mampir ke Invoice dulu
        // Kita bawa ID pembayaran terakhir untuk ditampilkan QR Code-nya
        return redirect()->route('checkout.invoice', ['id' => $lastPaymentId])
                         ->with('success', 'Pesanan berhasil dibuat, silakan selesaikan pembayaran.');
    }

    // TAMBAHKAN FUNGSI INI: Agar file invoice.blade.php bisa dipanggil
    public function invoice($id)
    {
        // Cari data pembayaran yang barusan dibuat
        $payment = Payment::with('enrollment.course')->findOrFail($id);

        return view('invoice', compact('payment'));
    }

    // Fungsi untuk tombol "Cek Status" di halaman invoice
    public function success($id)
    {
        return redirect()->route('learning.index')
                         ->with('success', 'Pembayaran berhasil dikonfirmasi! Selamat belajar.');
    }
}