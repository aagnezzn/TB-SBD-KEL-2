<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function filterByCategory($slug) 
{
    // 1. Cari kategori berdasarkan slug (misal: 'ilmu-data')
    // Kita panggil 'children' juga biar tahu topik-topik di bawahnya
    $category = Category::where('slug', $slug)->with('children')->firstOrFail();
    
    // 2. Ambil semua ID: ID kategori ini sendiri + ID semua anak-anaknya (topik populer)
    $categoryIds = $category->children->pluck('id')->push($category->id);
    
    // 3. Cari kursus yang masuk dalam daftar ID tadi
    $courses = Course::whereIn('category_id', $categoryIds)->paginate(12);

    // 4. Kirim data ke view
    return view('courses.index', compact('courses', 'category'));
}
    public function search(Request $request)
    {
        // 1. Ambil input dan BERSIHKAN spasi
        $keyword = trim($request->input('query'));

        // 2. Jika kotak pencarian kosong, balikkan
        if (empty($keyword)) {
            return redirect()->back();
        }

        // 3. Paksa kata kunci jadi huruf kecil
        $lowerKeyword = strtolower($keyword);

        // 4. Proses pencarian ke database
        $courses = Course::where(function($query) use ($lowerKeyword) {
                // Cari di judul
                $query->whereRaw('LOWER(title) LIKE ?', ["%{$lowerKeyword}%"])
                      // ATAU cari di deskripsi
                      ->orWhereRaw('LOWER(description) LIKE ?', ["%{$lowerKeyword}%"]);
            })
            // ATAU cari berdasarkan nama instruktur
            ->orWhereHas('user', function($query) use ($lowerKeyword) {
                $query->whereRaw('LOWER(name) LIKE ?', ["%{$lowerKeyword}%"]);
            })
            ->with(['user', 'category', 'reviews']) 
            ->get();

        return view('search-results', compact('courses', 'keyword'));
    }

   public function index()
    {
        // 1. Ambil data keranjang (agar daftar belanjaan muncul)
        $cartItems = Cart::where('user_id', Auth::id())
                        ->with('course.user')
                        ->get();

        // 2. Ambil 20 kursus secara ACAK (sesuai permintaan Anda)
        $courses = Course::with(['user', 'category', 'reviews'])
                         ->inRandomOrder() 
                         ->limit(20) 
                         ->get(); 

        // 3. Kirim kedua data ke view
        return view('keranjang', compact('cartItems', 'courses'));
    }
public function show($id)
{
    $course = Course::with(['lessons', 'reviews.user', 'enrollments'])
        ->findOrFail($id);

    return view('course-detail', compact('course'));
}
}
    