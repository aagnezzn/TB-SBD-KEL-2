<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; // Pastikan model Cart sudah ada
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function startSubscription()
    {
        return redirect()->route('cart.index')
            ->with('success', 'Selamat datang! Silakan lanjutkan langganan Anda.');
    }
}
