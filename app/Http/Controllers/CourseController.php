<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * FAKTA FIX 404: Mengubah pencarian dari berbasis Slug ke berbasis ID Kategori
     * Agar sinkron dengan parameter numerik ID yang dikirim oleh welcome.blade.php
     */
    public function filterByCategory($id) 
    {
        // 1. Ambil data kategori berdasarkan ID langsung dari database riil CSV kelompokmu
        $category = Category::with('children')->findOrFail($id);
        
        // 2. Kumpulkan semua ID yang kemungkinan terikat (ID Kategori Induk + ID Anak sub-kategorinya jika ada)
        $categoryIds = $category->children->pluck('id')->push($category->id)->toArray();
        
        // 3. Tarik data kursus dengan teknik adaptif agar melahap data relasi CSV induk maupun anak
        $courses = Course::where(function($query) use ($categoryIds, $category) {
                $query->whereIn('category_id', $categoryIds)
                      ->orWhereHas('category', function($subQuery) use ($category) {
                          $subQuery->where('parent_id', $category->id);
                      });
            })
            ->with('user') // Eager load data akun instruktur kelas
            ->withAvg('reviews', 'rating') // Kalkulasi rerata rating langsung di level DB MySQL
            ->withCount('reviews') // Hitung total ulasan langsung di level DB MySQL
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // 4. Salurkan data ke berkas view category.blade.php
        return view('category', compact('courses', 'category'));
    }

    public function search(Request $request)
    {
        $keyword = trim($request->input('query'));

        if (empty($keyword)) {
            return redirect()->back();
        }

        $lowerKeyword = strtolower($keyword);

        $courses = Course::where(function($query) use ($lowerKeyword) {
                $query->whereRaw('LOWER(title) LIKE ?', ["%{$lowerKeyword}%"])
                      ->orWhereRaw('LOWER(description) LIKE ?', ["%{$lowerKeyword}%"]);
            })
            ->orWhereHas('user', function($query) use ($lowerKeyword) {
                $query->whereRaw('LOWER(name) LIKE ?', ["%{$lowerKeyword}%"]);
            })
            ->with(['user', 'category']) 
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->paginate(12)
            ->withQueryString();

        return view('search-results', compact('courses', 'keyword'));
    }

    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
                        ->with('course.user')
                        ->get();

        $courses = Course::with(['user', 'category'])
                         ->withAvg('reviews', 'rating')
                         ->withCount('reviews')
                         ->inRandomOrder() 
                         ->limit(20) 
                         ->get(); 

        return view('keranjang', compact('cartItems', 'courses'));
    }

    public function show($id)
    {
        $course = Course::with(['lessons', 'reviews.user', 'enrollments'])
            ->findOrFail($id);

        return view('course-detail', compact('course'));
    }
}