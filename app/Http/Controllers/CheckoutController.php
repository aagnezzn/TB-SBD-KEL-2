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
        // Ambil item dari keranjang (Contoh simpel pakai session atau DB)
        $cart = session()->get('cart', []); 
        $total = 0;
        foreach($cart as $item) { $total += $item['price']; }

        return view('checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
{
    // 1. Buat data pendaftaran (Enrollment) dulu untuk dapat ID-nya
    $enrollment = Enrollment::create([
        'user_id' => auth()->id(),
        'course_id' => $request->course_id,
        'status' => 'active'
    ]);

    // 2. Simpan ke tabel payments sesuai struktur database Anda
    Payment::create([
        'enrollment_id'  => $enrollment->id,
        'amount'         => $request->amount,
        'payment_method' => $request->payment_method, // Misal: OVO, Dana, atau Transfer Bank
        'status'         => 'success', 
        'paid_at'        => now(),
    ]);

    return redirect('/home')->with('success', 'Pembayaran berhasil!');
}
}