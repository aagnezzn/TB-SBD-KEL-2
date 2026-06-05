<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    /**
     * Kebijakan Pengamanan Kolom (Mass Assignment)
     * Mengizinkan semua kolom diisi massal kecuali kolom 'id'.
     */
    protected $guarded = ['id'];

    /**
     * =========================================================================
     * DEFINISI RELASI BASIS DATA ELOQUENT (KARDINALITAS ERD)
     * =========================================================================
     */

    /**
     * Relasi Banyak-ke-Satu (Many-to-One / BelongsTo).
     * Banyak kursus bisa bernaung di bawah satu kategori utama yang sama.
     */
    public function category(): BelongsTo 
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Relasi Banyak-ke-Satu (Many-to-One / BelongsTo).
     * Banyak kursus bisa dibuat/diajar oleh satu user yang ber-role 'instructor'.
     * Nama fungsi tetap 'user' agar klop dengan perintah Eager Loading di Controller Admin.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    /**
     * Relasi One-to-Many (1:N) ke Tabel lessons.
     * Satu kursus wajib memiliki banyak video materi bab pembelajaran (Akurat: 3 materi per kelas).
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    /**
     * Relasi One-to-Many (1:N) ke Tabel reviews.
     * Satu kursus bisa menerima puluhan ribu ulasan rating dari berbagai mahasiswa berbeda.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'course_id');
    }

    /**
     * Relasi One-to-Many (1:N) ke Tabel enrollments.
     * Satu kursus bisa memiliki banyak catatan hak akses siswa yang aktif belajar.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'id');
    }

    /**
     * Relasi One-to-Many (1:N) ke Tabel payments.
     * FAKTA TAMBAHAN: Satu kursus mencatat banyak riwayat transaksi keuangan pembelian.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'course_id');
    }

    /**
     * Relasi One-to-Many (1:N) ke Tabel carts.
     * FAKTA TAMBAHAN: Satu kursus bisa sedang dimasukkan ke dalam banyak keranjang user sekaligus.
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'course_id');
    }

    /**
     * Relasi One-to-Many (1:N) ke Tabel wishlists.
     * FAKTA TAMBAHAN: Satu kursus bisa sedang nangkring di banyak daftar impian user sekaligus.
     */
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'course_id');
    }

    /**
     * VIRTUAL ATTRIBUTES UNTUK INTEGRASI DATA SCRAPING & REAL-TIME
     */
    public function getTotalReviewsAttribute()
    {
        $baseReviews = isset($this->attributes['reviews_count']) ? $this->attributes['reviews_count'] : 0;
        return $baseReviews + $this->reviews()->count();
    }

    public function getTotalSubscribersAttribute()
    {
        $baseSubscribers = isset($this->attributes['subscribers_count']) ? $this->attributes['subscribers_count'] : 0;
        return $baseSubscribers + $this->enrollments()->count();
    }
}