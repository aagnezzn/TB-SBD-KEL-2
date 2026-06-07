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
        // FIX: Tambahkan withAvg di relasi courses
        $topics = Category::whereIn('name', $targetTopicNames)
                            ->with(['courses' => function($query) {
                                $query->with(['user', 'reviews.user'])
                                      ->withAvg('reviews', 'rating')
                                      ->withCount('reviews');
                            }])
                            ->get()
                            ->unique('name');

        $categoriesData = [];

        foreach ($topics as $topic) {
            $courses = $topic->courses;

            if ($courses->isEmpty()) {
                continue;
            }

            $categoriesData[$topic->id] = [
                'name' => $topic->name,
                'slug' => $topic->slug,
                'courses' => $courses->take(10)
            ];
        }

        // Jika data kategori berdasarkan target topik kosong, gunakan kategori yang ada
        if (empty($categoriesData)) {
            $fallbackCategories = Category::whereHas('courses')->take(4)->get();
            foreach ($fallbackCategories as $fallback) {
                // FIX: Tambahkan withAvg disini juga
                $categoriesData[$fallback->id] = [
                    'name' => $fallback->name,
                    'slug' => $fallback->slug,
                    'courses' => $fallback->courses()->whereHas('user')
                                          ->with(['user', 'reviews.user'])
                                          ->withAvg('reviews', 'rating') 
                                          ->withCount('reviews')
                                          ->take(10)->get()
                ];
            }
        }

        // 2. Ambil dari ulasan untuk kursus rekomendasi sama populer 
        // FIX: Tambahkan withAvg('reviews', 'rating')
        $recommendedCourses = Course::whereHas('user')
                                    ->with(['category', 'user', 'reviews.user'])
                                    ->withAvg('reviews', 'rating')
                                    ->withCount('reviews')
                                    ->latest()
                                    ->take(5)
                                    ->get();

        // Tambahkan withAvg('reviews', 'rating')
        $popularCourses = Course::whereHas('user')
                                ->with(['category', 'user', 'reviews.user'])
                                ->withCount('reviews')
                                ->withAvg('reviews', 'rating')
                                ->orderBy('reviews_count', 'desc')
                                ->withCount('reviews')
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
            'topics', 
            'recommendedCourses', 
            'popularCourses',
            'cartItems'
        ));
    }
}