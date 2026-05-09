<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; // Pastikan model Cart sudah ada
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function startSubscription()
    {
        // 1. (Opsional) Tambahkan logic di sini jika ingin otomatis 
        // memasukkan "Paket Personal" ke dalam database keranjang user.
        
        // 2. Arahkan user ke route keranjang belanja
        // Sesuaikan 'cart.index' dengan nama route keranjangmu
        return redirect()->route('cart.index')
            ->with('success', 'Selamat datang! Silakan lanjutkan langganan Anda.');
    }
}
