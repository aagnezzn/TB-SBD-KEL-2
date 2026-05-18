<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    // Mengunci nama tabel fisik di database MySQL kalian
    protected $table = 'user_profiles';

    /**
     * Atribut yang diizinkan untuk pengisian Mass Assignment via Seeder/Controller
     */
    protected $fillable = [
        'user_id', 
        'first_name', 
        'last_name', 
        'headline', 
        'bio', 
        'photo',
        'website', 
        'facebook', 
        'instagram', 
        'twitter'
    ];

    /**
     * Relasi Balik Banyak-ke-Satu (BelongsTo / Inverse One-to-One)
     * Menghubungkan kembali data profil ke akun User induknya.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}