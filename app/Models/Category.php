<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'parent_id'];

    // Memanggil anak langsung (Level 2)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
    // Ini buat nyari siapa bapaknya (opsional tapi berguna)
    return $this->belongsTo(Category::class, 'parent_id');
    }
    // Memanggil anak dari anak (Level 3 / Topik Populer)
    // Digunakan dengan cara: $category->load('children.children')
    public function subChildren()
    {
        return $this->children()->with('subChildren');
    }

    // Tambahkan ini di dalam class Category
    public function getRouteKeyName()
    {
    return 'slug';
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }
}
