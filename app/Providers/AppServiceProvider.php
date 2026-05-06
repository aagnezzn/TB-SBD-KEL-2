<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
 public function boot(): void
  {
    // Hanya kirim data ke file navbar dan footer, bukan ke SEMUA file.
    View::composer('*', function ($view) {
    $navCategories = \App\Models\Category::whereNull('parent_id')->with('children.children')->get();

    $cartCount = 0;
    $cartItems = collect(); // Default koleksi kosong

    if (\Illuminate\Support\Facades\Auth::check()) {
        // Ambil data item keranjang beserta info kursusnya
        $cartData = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())
                        ->with('course')
                        ->get();
        
        $cartCount = $cartData->count();
        $cartItems = $cartData;
    }

    $view->with([
        'navCategories' => $navCategories,
        'cartCount'     => $cartCount,
        'cartItems'     => $cartItems
    ]);
});
  }}
