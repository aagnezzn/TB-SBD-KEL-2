<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory; 

    protected $table = 'payments';

    // Kembalikan array fillable ke format string murni nama kolom database
    protected $fillable = [
        'enrollment_id', 
        'amount', 
        'payment_method', 
        'status', 
        'paid_at',
    ];

    //Deklarasi penentu format waktu dipisahkan ke dalam properti casts
    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public $timestamps = true;

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }
}