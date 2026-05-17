<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

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

    // Relasi balik One-to-One ke User induk
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}