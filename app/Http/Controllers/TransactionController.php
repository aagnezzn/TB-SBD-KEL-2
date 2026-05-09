<?php

namespace App\Http\Controllers;

use App\Models\Transaction; // <-- Wajib ada agar mengenali Model
use Illuminate\Http\Request; // <-- Wajib ada untuk mengambil data form
use Carbon\Carbon; // <-- Wajib ada untuk waktu
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini

class TransactionController extends Controller
{
    public function process(Request $request)
    {
        // ... (Logika pembayaran kamu disini) ...

        // Simpan ke table transactions
        $transaction = Transaction::create([
            'user_id' => Auth::id(), // <-- Ubah auth()->id() menjadi Auth::id() agar VS Code tidak error
            'course_id' => $request->course_id,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'status' => 'success',
            'paid_at' => Carbon::now(),
        ]);

        return redirect()->route('transaction.success', ['id' => $transaction->id]);
    }

    public function success($id)
    {
        $transaction = Transaction::findOrFail($id);

        // Lempar data $transaction tapi dengan nama variabel 'payment'
        // supaya file payment-success.blade.php kamu tetap berfungsi normal
        return view('payment-success', ['payment' => $transaction]);
    }
}