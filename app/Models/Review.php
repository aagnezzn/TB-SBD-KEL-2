<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Pastikan ini ada
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory; // Tambahkan ini agar bisa pakai factory

    protected $fillable = [
        'user_id',
        'course_id',
        'rating',
        'comment'
    ];
}