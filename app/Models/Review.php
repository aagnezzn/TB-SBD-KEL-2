<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'rating',
        'comment' // Kolom teks ulasan di database kamu namanya 'comment'
    ];

    /**
     * Relasi ke model User (Siapa yang mengulas)
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    /**
     * FIX UNTUK ERROR: Menambahkan relasi course yang hilang
     */
    public function course() 
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}