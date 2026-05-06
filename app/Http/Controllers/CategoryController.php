<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index()
{
    // 1. Ambil kategori navigasi (Navigasi atas kamu)
    $navCategories = \App\Models\Category::whereNull('parent_id')
                        ->with('children.children')
                        ->get();

    // 2. Ambil 5 kursus terbaru untuk variabel $recommendedCourses
    $recommendedCourses = \App\Models\Course::with('category')
                            ->latest()
                            ->take(5)
                            ->get();

    // 3. Ambil 5 kursus acak untuk variabel $popularCourses
    $popularCourses = \App\Models\Course::with('category')
                        ->inRandomOrder()
                        ->take(5)
                        ->get();

    // 4. KIRIM SEMUA VARIABEL INI KE BLADE
    return view('welcome', compact('navCategories', 'recommendedCourses', 'popularCourses'));
}
}
