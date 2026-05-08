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
        // 1. Ambil kategori utama untuk navigasi atas (Level 1)
        $navCategories = Category::whereNull('parent_id')
                            ->with('children.children')
                            ->get();

        // 2. Tentukan nama-nama topik yang ingin kita tampilkan di slider utama
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

        // 3. Ambil kategori dari DB, lalu pangkas duplikatnya berdasarkan NAMA menggunakan ->unique('name')
        $topics = Category::whereIn('name', $targetTopicNames)
                            ->with(['courses.user'])
                            ->get()
                            ->unique('name'); // MENGHILANGKAN DUPLIKAT TOMBOL DI HALAMAN DEPAN

        $categories = collect();
        $categoriesData = [];

        foreach ($topics as $topic) {
            // Ambil kursus yang terhubung langsung ke topik ini
            $courses = $topic->courses;

            // Jika topik ini tidak punya kursus langsung, coba ambil dari sub-kategorinya
            if ($courses->isEmpty()) {
                $subCategoryIds = $topic->children()->pluck('id')->push($topic->id);
                $courses = Course::whereIn('category_id', $subCategoryIds)
                                ->with('user')
                                ->latest()
                                ->take(10)
                                ->get();
            }

            // Hanya buatkan tab jika topik ini memiliki minimal 1 kursus agar tidak kosong
            if ($courses->isNotEmpty()) {
                $categories->push($topic);
                $categoriesData[$topic->id] = [
                    'name' => $topic->name,
                    'slug' => $topic->slug,
                    'courses' => $courses
                ];
            }
        }

        // FALLBACK: Jika semua kosong, ambil kategori acak yang ada kursusnya (tetap unik secara nama)
        if ($categories->isEmpty()) {
            $fallbackCategories = Category::has('courses')
                                    ->with('courses.user')
                                    ->get()
                                    ->unique('name') // Tetap dipastikan unik
                                    ->take(6);
                                    
            foreach ($fallbackCategories as $fallback) {
                $categories->push($fallback);
                $categoriesData[$fallback->id] = [
                    'name' => $fallback->name,
                    'slug' => $fallback->slug,
                    'courses' => $fallback->courses()->with('user')->take(10)->get()
                ];
            }
        }

        // 4. Ambil data rekomendasi dan populer untuk welcome
        $recommendedCourses = Course::with(['category', 'user'])->latest()->take(5)->get();
        $popularCourses = Course::with(['category', 'user'])->inRandomOrder()->take(5)->get();

        // 5. Ambil data keranjang jika user sudah login
        $cartItems = collect();
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                            ->with('course.user')
                            ->get();
        }

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