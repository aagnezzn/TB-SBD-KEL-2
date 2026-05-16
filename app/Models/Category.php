<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
    // Ini buat nyari siapa bapaknya
    return $this->belongsTo(Category::class, 'parent_id');
    }
    // Memanggil anak dari anak
    public function subChildren()
    {
        return $this->children()->with('subChildren');
    }

    public function getRouteKeyName()
    {
    return 'slug';
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }
}
