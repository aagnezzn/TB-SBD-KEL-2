<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // WAJIB ADA
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory; // WAJIB ADA
    protected $table = 'payments';

    protected $fillable = [
        'enrollment_id', 
        'amount', 
        'payment_method', 
        'status', 
        'paid_at' => 'datetime',
        ];
        public $timestamps = true;

    // Tambahkan relasi ini agar Factory bisa mengambil harga kursus
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}