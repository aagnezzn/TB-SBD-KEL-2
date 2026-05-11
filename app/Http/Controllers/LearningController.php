<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Wishlist; 
use App\Models\Cart;

class LearningController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();
    if (!$user) return redirect()->route('login');

    $tab = $request->query('tab', 'all');

    if ($tab == 'wishlist') {
        // Mengambil course lewat tabel Wishlist
        $courses = Wishlist::where('user_id', $user->id)
                    ->with('course.user') // Eager load user agar tidak error
                    ->get()
                    ->pluck('course'); 
    } else {
        // Mengambil course yang sudah dibeli
        $courses = $user->courses()->with('user')->get(); 
    }

    return view('learning.index', compact('courses', 'tab'));
}

public function addToWishlist($id)
{
    Wishlist::firstOrCreate([
        'user_id' => Auth::id(),
        'course_id' => $id
    ]);

    return redirect()->back()->with('success', 'Berhasil ditambah ke wishlist');
}

public function purchaseHistory()
{
    $payments = \App\Models\Payment::whereHas('enrollment', function($query) {
        $query->where('user_id', Auth::id());
    })
    ->with('enrollment.course') // Ambil data kursusnya juga
    ->orderBy('paid_at', 'desc')
    ->get();

    return view('learning.purchase_history', compact('payments'));
}

public function removeFromWishlist($id)
{
    Wishlist::where('user_id', Auth::id())
            ->where('course_id', $id)
            ->delete();

    return redirect()->back()->with('success', 'Berhasil dihapus dari daftar keinginan.');
}

public function moveToCart($id)
{
    $userId = Auth::id();

    // 1. Simpan ke tabel carts
    // Kita gunakan updateOrCreate supaya jika barang sudah ada di keranjang, tidak duplikat
    Cart::updateOrCreate([
        'user_id' => $userId,
        'course_id' => $id
    ]);

    // 2. Hapus dari tabel wishlists
    Wishlist::where('user_id', $userId)
            ->where('course_id', $id)
            ->delete();

    // 3. Kembali ke halaman dengan pesan sukses
    return redirect()->back()->with('success', 'Kursus berhasil dipindahkan ke keranjang.');
}
}