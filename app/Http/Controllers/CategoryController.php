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
        $navCategories = Category::whereNull('parent_id')
                            ->with('children.children')
                            ->get();

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

        $topics = Category::whereIn('name', $targetTopicNames)
                            ->with(['courses.user'])
                            ->get()
                            ->unique('name');

        $categories = collect();
        $categoriesData = [];

        foreach ($topics as $topic) {
            $courses = $topic->courses;

            if ($courses->isEmpty()) {
                $subCategoryIds = $topic->children->pluck('id');
                $courses = Course::whereIn('category_id', $subCategoryIds)->with('user')->get();
            }

            if ($courses->isNotEmpty()) {
                $categories->push($topic);
                $categoriesData[$topic->id] = [
                    'name' => $topic->name,
                    'slug' => $topic->slug,
                    'courses' => $courses->take(10)
                ];
            }
        }

        // FIX DATABASE FALLBACK: Proteksi relasi user/instruktur agar tidak null pointer exception
        if ($categories->isEmpty()) {
            $fallbackCategories = Category::has('courses')
                                    ->with(['courses' => function($query) {
                                        $query->whereHas('user'); // Hanya ambil kursus yang instrukturnya ada di DB
                                    }])
                                    ->get()
                                    ->unique('name')
                                    ->take(6);
                                    
            foreach ($fallbackCategories as $fallback) {
                $categories->push($fallback);
                $categoriesData[$fallback->id] = [
                    'name' => $fallback->name,
                    'slug' => $fallback->slug,
                    'courses' => $fallback->courses()->whereHas('user')->with('user')->take(10)->get()
                ];
            }
        }

        $recommendedCourses = Course::whereHas('user')->with(['category', 'user'])->latest()->take(5)->get();
        $popularCourses = Course::whereHas('user')->with(['category', 'user'])->inRandomOrder()->take(5)->get();

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