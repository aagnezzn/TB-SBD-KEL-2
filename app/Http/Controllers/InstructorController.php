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
    
    // Ambil kursus milik instruktur ini saja
    $courses = \App\Models\Course::where('instructor_id', $user->id)->latest()->get();
    
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
    // Simpan Data
    \App\Models\Course::create([
        'instructor_id' => Auth::id(),
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'image_url'     => 'default-course.png',
        'status' => 'draft',
    ]);

    return redirect()->route('instructor.confirmation');
}

// Tambahkan fungsi ini untuk menampilkan halaman "BOOM" (daftar email)
public function showConfirmation()
{
    return view('instructor.confirmation'); 
}

public function upgradeRole() {
    $user = \App\Models\User::find(Auth::id());
    $user->role = 'instructor';
    $user->save();

    return back()->with('success', 'Email Anda sekarang terdaftar sebagai Instructor.');
}

public function showLogin()
{
    return view('instructor.login');
}
// Tampilkan Daftar Kursus Milik Instruktur
public function myCourses() {
    $courses = Course::where('instructor_id', Auth::id())->latest()->get();
    return view('instructor.courses.index', compact('courses'));
}

public function manageCourse($id) {
    $course = Course::with('lessons')->where('instructor_id', Auth::id())->findOrFail($id);
    return view('instructor.courses.manage', compact('course'));
}

public function addLesson(Request $request, $id)
{

    $request->validate([
        'title' => 'required|string|max:255',
        'duration' => 'required|integer',
        'content' => 'required',
    ]);

    Lesson::create([
        'course_id' => $id,
        'title' => $request->title,
        'duration' => $request->duration,
        'content' => $request->content,
    ]);

    return back()->with('success', 'Materi berhasil disimpan!');
}
public function editCourse($id) {
    $course = \App\Models\Course::with('lessons')->where('instructor_id', Auth::id())->findOrFail($id);
    return view('instructor.courses.edit', compact('course'));
}

public function updateCourse(Request $request, $id) {
    $course = \App\Models\Course::findOrFail($id);
    
    // Update data utama kursus
    $course->update([
        'title' => $request->title,
        'price' => $request->price,
    ]);

    // Update judul tiap lesson (looping)
    if($request->lessons) {
        foreach($request->lessons as $lessonId => $lessonData) {
            \App\Models\Lesson::where('id', $lessonId)->update([
                'title' => $lessonData['title']
            ]);
        }
    }

    return redirect()->route('instructor.courses.index')->with('success', 'Kursus berhasil diperbarui!');
}
public function createNewCourse()
{
    // Ambil semua kategori dari database buat ditampilin di select option
    $categories = \App\Models\Category::all();
    
    return view('instructor.courses.create', compact('categories'));
}

public function storeNewCourse(Request $request)
{
    // Simpan Data sesuai logika yang kamu mau
    $course = \App\Models\Course::create([
        'instructor_id' => Auth::id(),
        'category_id'   => $request->category_id,
        'title'         => $request->title,
        'description'   => $request->description,
        'price'         => $request->price,
        'image_url'     => 'default-course.png', // Sesuai permintaan
        'status'        => 'draft',             // Sesuai permintaan
    ]);

    // Lempar ke halaman manage atau konfirmasi
    return redirect()->route('instructor.courses.manage', $course->id)
                     ->with('success', 'Kursus berhasil dibuat sebagai draft!');
}
public function myStudents()
{
    $instructorId = Auth::id();

    // Query ini artinya: Ambil User yang punya data di tabel Enrollments 
    // dimana Enrollments tersebut terhubung ke Kursus yang instructor_id-nya adalah SAYA.
    $students = \App\Models\User::whereHas('enrollments', function($query) use ($instructorId) {
        $query->whereHas('course', function($q) use ($instructorId) {
            $q->where('instructor_id', $instructorId);
        });
    })
    ->with(['enrollments.course' => function($query) use ($instructorId) {
        // Biar kita tahu dia join di kursus mana
        $query->where('instructor_id', $instructorId);
    }])
    ->get();

    return view('instructor.students.index', compact('students'));
}

public function performance()
{
    $instructorId = Auth::id();

    // 1. Ambil ID Kursus kamu
    $myCourseIds = \App\Models\Course::where('instructor_id', $instructorId)->pluck('id');

    // 2. Hitung Total Pendapatan (Data Asli)
    $totalEarnings = \App\Models\Enrollment::whereIn('course_id', $myCourseIds)
                        ->join('courses', 'enrollments.course_id', '=', 'courses.id')
                        ->sum('courses.price');

    // 3. Hitung Total Siswa
    $totalEnrollments = \App\Models\Enrollment::whereIn('course_id', $myCourseIds)->count();

    // 4. LOGIKA GRAFIK (PASTI JALAN)
    $chartData = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = \Carbon\Carbon::now()->subDays($i);
        
        // Ambil pemasukan per hari
        $income = \App\Models\Enrollment::whereIn('course_id', $myCourseIds)
                    ->join('courses', 'enrollments.course_id', '=', 'courses.id')
                    ->whereDate('enrollments.created_at', $date->format('Y-m-d'))
                    ->sum('courses.price');

        // Hitung tinggi batang (0 sampai 100)
        // Kalau ada income hari ini, kita kasih tinggi min 30% biar kelihatan tabungnya
        $height = 0;
        if ($totalEarnings > 0 && $income > 0) {
            $height = ($income / $totalEarnings) * 100;
        }

        $chartData[] = [
            'day'    => $date->isoFormat('ddd'), // Sen, Sel, Rab...
            'income' => $income,
            'height' => $height
        ];
    }

    $data = [
        'total_earnings'    => $totalEarnings,
        'total_enrollments' => $totalEnrollments,
        'avg_rating'        => 5.0,
        'active_courses'    => $myCourseIds->count(),
    ];

    return view('instructor.performance', compact('data', 'chartData'));
}
}
