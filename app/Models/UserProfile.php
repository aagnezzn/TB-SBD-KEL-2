<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'headline', 'bio', 'photo',
        'website', 'facebook', 'instagram', 'linkedin', 'tiktok', 'twitter', 'youtube'
    ];

    // Relasi balik ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}