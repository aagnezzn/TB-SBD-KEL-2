<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function filterByCategory($idOrSlug) 
    {
        // 1. Ambil data kategori berdasarkan ID (Angka) atau Slug (Teks) secara adaptif
        if (is_numeric($idOrSlug)) {
            $category = Category::with('children.children')->findOrFail($idOrSlug);
        } else {
            $decodedSlug = urldecode($idOrSlug);
            $category = Category::where('slug', $decodedSlug)
                                ->orWhere('slug', 'LIKE', '%' . $decodedSlug . '%')
                                ->with('children.children')
                                ->firstOrFail();
        }
        
        // 2. FAKTA FIX: Ambil ID kategori ini, ID anak-anaknya, DAN ID cucu-cucu kategori di bawahnya
        $categoryIds = collect([$category->id]);

        foreach ($category->children as $child) {
            $categoryIds->push($child->id);
            // Ambil semua ID topik populer tingkat 3 (cucu kategori) tempat kursus CSV bernaung
            if ($child->children) {
                $categoryIds = $categoryIds->merge($child->children->pluck('id'));
            }
        }

        $allCategoryIds = $categoryIds->unique()->toArray();
        
        // 3. Tarik data kursus yang memiliki category_id COCOK dengan semua tumpukan array ID di atas
        $courses = Course::whereIn('category_id', $allCategoryIds)
            ->with('user') // Eager load data akun instruktur kelas
            ->withAvg('reviews', 'rating') // Kalkulasi rerata rating langsung dari database MySQL
            ->withCount('reviews') // Hitung total ulasan langsung dari database MySQL
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // 4. Salurkan data murni ke berkas view category.blade.php
        return view('category', compact('courses', 'category'));
    }

    /**
     * FITUR PENCARIAN GLOBAL (SEARCH BAR)
     */
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

    /**
     * FUNGSI INDEX KERANJANG BELANJA
     */
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

    /**
     * FUNGSI DETAIL KURSUS
     */
    public function show($id)
    {
        $course = Course::with(['lessons', 'reviews.user', 'enrollments'])
            ->findOrFail($id);

        return view('course-detail', compact('course'));
    }
}