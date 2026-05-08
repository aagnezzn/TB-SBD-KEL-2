<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($course_id)
    {
        // Cek apakah kursus sudah ada di keranjang user ini
        $exists = Cart::where('user_id', Auth::id())
                      ->where('course_id', $course_id)
                      ->exists();

        if (!$exists) {
            Cart::create([
                'user_id' => Auth::id(),
                'course_id' => $course_id,
            ]);
        }

        return redirect()->back()->with('success', 'Kursus berhasil ditambah!');
    }

    public function removeFromCart($id)
{
    // Mencari item keranjang milik user yang sedang login
    $cartItem = \App\Models\Cart::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $cartItem->delete();

    return redirect()->back()->with('success', 'Kursus berhasil dihapus dari keranjang.');
}

   public function index()
{
    // Item keranjang user
    $cartItems = Cart::where('user_id', Auth::id())
                     ->with('course.user')
                     ->get();

    // Course rekomendasi untuk slider bawah
    $courses = \App\Models\Course::inRandomOrder()
                 ->take(10)
                 ->get();

    return view('keranjang', compact('cartItems', 'courses'));
}
}