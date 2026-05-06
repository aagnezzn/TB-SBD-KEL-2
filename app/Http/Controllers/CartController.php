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
}