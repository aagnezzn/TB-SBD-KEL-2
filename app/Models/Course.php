<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Pakai guarded id sudah benar, lebih simpel
    protected $guarded = ['id'];

    // Relasi ke Category (Sudah Benar)
    public function category() 
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Relasi ke User (DIREVISI)
    public function user()
    {
        // Harus pakai 'user_id' karena itu nama kolom di database kamu!
        return $this->belongsTo(User::class, 'instructor_id');
    }

    // Relasi ke Lesson (Materi)
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}