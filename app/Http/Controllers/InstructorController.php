<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category; 
use App\Models\Course;
use App\Models\Lesson;

class InstructorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courses = Course::where('instructor_id', $user->id)->latest()->get();
        
        $totalCourses = $courses->count();
        $totalStudents = \App\Models\Enrollment::whereHas('course', function($q) use ($user) {
            $q->where('instructor_id', $user->id);
        })->count();

        return view('instructor.dashboard', compact('courses', 'totalCourses', 'totalStudents'));
    }

    public function createCourse() {
        $categories = Category::all(); 
        return view('instructor.courses_create', compact('categories'));
    }

    public function storeCourse(Request $request)
    {
        // Validasi input database agar tidak ada data null yang lolos
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        // Simpan Data ke Database
        Course::create([
            'instructor_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            // FIX: Gunakan format URL placeholder murni yang valid agar serasi dengan sistem gambar lokal
            'image_url' => 'https://loremflickr.com/640/360/computer,office?random=' . rand(1, 999),
            // Kolom 'status' dihapus dari create karena tidak terdaftar di file migrasi databasecourses
        ]);

        return redirect()->route('instructor.confirmation');
    }

    public function confirmation() {
        return view('instructor.courses_confirmation');
    }
}