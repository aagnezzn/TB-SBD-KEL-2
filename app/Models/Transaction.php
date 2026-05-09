<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'course_id',
        'payment_method',
        'amount',
        'status',
        'paid_at',
    ];

    // Ubah paid_at menjadi format tanggal yang bisa dibaca Laravel
    protected $casts = [
        'paid_at' => 'datetime',
    ];
}