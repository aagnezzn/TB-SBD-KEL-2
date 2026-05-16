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
            $courses = Wishlist::where('user_id', $user->id)
                    ->with('course.user')
                    ->get()
                    ->pluck('course'); 
        } else {
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
        ->with('enrollment.course')
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

        // Simpan ke tabel carts
        Cart::updateOrCreate([
            'user_id' => $userId,
            'course_id' => $id
        ]);

        //Hapus dari tabel wishlists
        Wishlist::where('user_id', $userId)
                ->where('course_id', $id)
                ->delete();

        //Kembali ke halaman dengan pesan sukses
        return redirect()->back()->with('success', 'Kursus berhasil dipindahkan ke keranjang.');
    }
}