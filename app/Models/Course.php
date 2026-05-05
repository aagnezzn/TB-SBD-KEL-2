<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Izinkan semua kolom diisi kecuali ID
    protected $guarded = ['id'];
    
    public function category() {
    return $this->belongsTo(Category::class);
}

    public function instructor() {
    return $this->belongsTo(User::class, 'user_id');
}

    // Relasi ke User (Instruktur)
    public function user()
{
    // Course "Milik" (belongsTo) seorang User
    return $this->belongsTo(User::class, 'instructor_id'); 
}

// Relasi ke Lesson (Materi)
    public function lessons()
{
    // Course "Punya Banyak" (hasMany) Lesson
    return $this->hasMany(Lesson::class);
}
}