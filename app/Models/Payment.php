<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory; 

    protected $table = 'payments';

    // FAKTANYA: Properti fillable wajib mendaftarkan user_id dan course_id agar mendukung Mass Assignment
    protected $fillable = [
        'user_id', 
        'course_id', 
        'amount', 
        'payment_method', 
        'status', 
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // FAKTANYA: Relasi lama dibuang, diganti dengan relasi langsung ke Course yang dibeli
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}