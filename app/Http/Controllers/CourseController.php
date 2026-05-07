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
    $category = Category::where('slug', $slug)->firstOrFail();
    
    $courses = Course::where('category_id', $category->id)->paginate(12);

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
            ->with(['user', 'category'])
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
        $courses = Course::with(['user', 'category'])
                         ->inRandomOrder() 
                         ->limit(20) 
                         ->get(); 

        // 3. Kirim kedua data ke view
        return view('keranjang', compact('cartItems', 'courses'));
    }
public function show($id)
{
    // Mengambil kursus beserta materi (lessons) agar halaman detail tidak kosong
    $course = Course::with('lessons')->findOrFail($id);
    return view('course-detail', compact('course'));
}
    
}