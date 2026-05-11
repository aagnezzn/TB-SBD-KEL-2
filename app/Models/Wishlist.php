<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'course_id'];

    // Relasi ke Course agar kita bisa ambil data gambarnya dsb
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
