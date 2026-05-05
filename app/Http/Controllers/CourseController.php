<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;

class CourseController extends Controller
{
    public function filterByCategory($id)
    {
        $category = Category::findOrFail($id);
        
        $courses = Course::where('category_id', $id)->paginate(12);

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
}