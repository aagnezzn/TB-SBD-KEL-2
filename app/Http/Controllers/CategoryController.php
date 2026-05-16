<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        // 1. Navbar Utama (Saat Login)
        $navCategories = Category::whereNull('parent_id')
                            ->with('children.children')
                            ->get();
        $categories = Category::whereNull('parent_id')->get();

        // Jika field parent_id di database kosong
        if ($categories->isEmpty()) {
            $categories = Category::take(8)->get();
        }

        // Target topik besar bawaan project untuk kebutuhan tab dashboard setelah login
        $targetTopicNames = [
            'Python', 
            'Pemasaran Digital', 
            'Digital Marketing', 
            'Ilmu Data', 
            'Data Science', 
            'Microsoft Excel', 
            'JavaScript', 
            'Perencanaan Proyek'
        ];

        // Memuat topik beserta kursus, instruktur, dan reviews untuk halaman dalam
        $topics = Category::whereIn('name', $targetTopicNames)
                            ->with(['courses.user', 'courses.reviews.user'])
                            ->get()
                            ->unique('name');

        $categoriesData = [];

        foreach ($topics as $topic) {
            $courses = $topic->courses;

            if ($courses->isEmpty()) {
                $subCategoryIds = $topic->children->pluck('id');
                $courses = Course::whereIn('category_id', $subCategoryIds)->with(['user', 'reviews.user'])->get();
            }

            if ($courses->isNotEmpty()) {
                $categoriesData[$topic->id] = [
                    'name' => $topic->name,
                    'slug' => $topic->slug,
                    'courses' => $courses->take(10)
                ];
            }
        }

        // database fallback untuk data tab dashboard
        if (empty($categoriesData)) {
            $fallbackCategories = Category::has('courses')
                                    ->with(['courses' => function($query) {
                                        $query->whereHas('user')->with(['user', 'reviews.user']);
                                    }])
                                    ->get()
                                    ->unique('name')
                                    ->take(6);
                                    
            foreach ($fallbackCategories as $fallback) {
                $categoriesData[$fallback->id] = [
                    'name' => $fallback->name,
                    'slug' => $fallback->slug,
                    'courses' => $fallback->courses()->whereHas('user')->with(['user', 'reviews.user'])->take(10)->get()
                ];
            }
        }

        // 2. Ambil dari ulasan untuk kursus rekomendasi sama populer 
        $recommendedCourses = Course::whereHas('user')
                                    ->with(['category', 'user', 'reviews.user'])
                                    ->latest()
                                    ->take(5)
                                    ->get();

        $popularCourses = Course::whereHas('user')
                                ->with(['category', 'user', 'reviews.user'])
                                ->withCount('reviews')
                                ->orderBy('reviews_count', 'desc')
                                ->take(5)
                                ->get();

        // Keranjang belanja
        $cartItems = collect();
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                            ->with('course.user')
                            ->get();
        }

        // Mengirimkan data kembali ke welcome
        return view('welcome', compact(
            'navCategories', 
            'categories', 
            'categoriesData', 
            'recommendedCourses', 
            'popularCourses',
            'cartItems'
        ));
    }
}