<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category; 
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\Payment;

class InstructorController extends Controller
{
    // 1. Menampilkan Halaman Login (Sesuai rute instructor.login)
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        }
        return view('instructor.login');
    }

    // 2. Dashboard Ringkasan (Sesuai rute instructor.dashboard)
    public function index()
    {
        $user = Auth::user();
        $courses = Course::where('instructor_id', $user->id)->latest()->get();
        $courseIds = $courses->pluck('id');

        $totalCourses = $courses->count();
        $totalStudents = Enrollment::whereIn('course_id', $courseIds)->count();
        $totalRevenue = Payment::whereHas('enrollment', function($query) use ($courseIds) {
            $query->whereIn('course_id', $courseIds);
        })->sum('amount');

        return view('instructor.dashboard', compact('courses', 'totalCourses', 'totalStudents', 'totalRevenue'));
    }

    // 3. Daftar Kursus Saya (Sesuai rute instructor.courses.index)
    public function myCourses()
    {
        $courses = Course::where('instructor_id', Auth::id())->latest()->get();
        return view('instructor.courses.index', compact('courses'));
    }

    // 4. Form Buat Kursus (Sesuai rute instructor.courses.create & add)
    public function createCourse() {
        $categories = Category::all(); 
        return view('instructor.courses_create', compact('categories'));
    }

    // Alias untuk createCourse jika rute memanggil createNewCourse
    public function createNewCourse() {
        return $this->createCourse();
    }

    // 5. Simpan Kursus (Sesuai rute instructor.courses.store & save)
    public function storeCourse(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        // Gunakan Unsplash agar loading web kencang
        $imageUrl = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80';

        Course::create([
            'instructor_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => $imageUrl,
            'status' => 'active',
        ]);

        return redirect()->route('instructor.confirmation');
    }

    // Alias untuk storeCourse
    public function storeNewCourse(Request $request) {
        return $this->storeCourse($request);
    }

    // 6. Manage & Edit (Sesuai rute manage & edit & update)
    public function manageCourse($id)
    {
        $course = Course::with('lessons')->where('instructor_id', Auth::id())->findOrFail($id);
        return view('instructor.courses.manage', compact('course'));
    }

    public function editCourse($id)
    {
        $course = Course::where('instructor_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        return view('instructor.courses.edit', compact('course', 'categories'));
    }

    public function updateCourse(Request $request, $id)
    {
        $course = Course::where('instructor_id', Auth::id())->findOrFail($id);
        $course->update($request->all());
        return redirect()->route('instructor.courses.index')->with('success', 'Kursus diperbarui!');
    }

    // 7. Tambah Materi (Sesuai rute instructor.lessons.store)
    public function addLesson(Request $request, $id)
    {
        Lesson::create([
            'course_id' => $id,
            'title' => $request->title,
            'content' => $request->content,
            'duration' => $request->duration ?? 0,
        ]);
        return back()->with('success', 'Materi ditambahkan!');
    }

    // 8. Daftar Siswa (Sesuai rute instructor.students.index)
    public function myStudents()
{
    // 1. Ambil data instruktur yang sedang login
    $instructor = \Illuminate\Support\Facades\Auth::user();

    // 2. Ambil semua ID kursus yang dibuat oleh instruktur ini
    $courseIds = \App\Models\Course::where('instructor_id', $instructor->id)->pluck('id')->toArray();

    // 3. Ambil data siswa yang terdaftar khusus pada kelas milik instruktur ini
    // Menggunakan eager loading (with) agar data hubungan tabelnya tidak NULL dan tidak memicu Error 500
    $students = \App\Models\User::where('role', 'student')
        ->whereHas('enrollments', function($query) use ($courseIds) {
            $query->whereIn('course_id', $courseIds);
        })
        ->with(['enrollments' => function($query) use ($courseIds) {
            $query->whereIn('course_id', $courseIds)->with('course');
        }])
        ->latest()
        ->get();

    // 4. Kirim variabel $students secara resmi ke file Blade index siswa
    return view('instructor.students.index', compact('students'));
}

    // 9. Performa & Konfirmasi
    public function performance()
{
    $instructorId = Auth::id();
    
    // Ambil semua ID kursus milik instruktur ini
    $courses = \App\Models\Course::where('instructor_id', $instructorId)->get();
    $courseIds = $courses->pluck('id');

    // 1. Data Kotak Statistik Atas (Earnings, Enrollments, Rating)
    $totalEarnings = \App\Models\Payment::whereHas('enrollment', function($query) use ($courseIds) {
        $query->whereIn('course_id', $courseIds);
    })->sum('amount');

    $totalEnrollments = \App\Models\Enrollment::whereIn('course_id', $courseIds)->count();
    $averageRating = \App\Models\Review::whereIn('course_id', $courseIds)->avg('rating') ?? 0;

    // 2. LOGIKA GRAFIK: Hitung Aktivitas Pendapatan 7 Hari Terakhir (Sesuai Struktur Blade Kamu)
    $chartData = [];
    
    // Looping mundur dari 6 hari lalu sampai hari ini (Total 7 hari)
    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i);
        
        // Hitung total pendapatan instruktur pada tanggal spesifik ini
        $dayIncome = \App\Models\Payment::whereHas('enrollment', function($query) use ($courseIds) {
            $query->whereIn('course_id', $courseIds);
        })
        ->whereDate('created_at', $date->toDateString())
        ->sum('amount');

        // Tentukan tinggi grafik batang dalam bentuk persen (%)
        // Jika tidak ada income, tinggi 0. Jika ada, kalkulasi persentase kasarnya (misal max skala 2 juta rupiah = 100%)
        $maxScale = 2000000; 
        $heightPercentage = $dayIncome > 0 ? min(($dayIncome / $maxScale) * 100, 100) : 0;

        // Masukkan ke array dengan KEY yang dicari oleh file Blade kamu
        $chartData[] = [
            'day'    => $date->isoFormat('ddd'), // Contoh hasil: Sen, Sel, Rab, Kam...
            'income' => $dayIncome,
            'height' => $heightPercentage
        ];
    }

    // 3. Bungkus data statistik atas
    $data = [
        'total_earnings'    => $totalEarnings,
        'total_enrollments' => $totalEnrollments,
        'avg_rating'        => round($averageRating, 1),
    ];

    // Kirim $data dan $chartData ke view
    return view('instructor.performance', compact('data', 'chartData'));
}

    public function showConfirmation() {
        return view('instructor.courses_confirmation');
    }

    // 10. Upgrade Role (Untuk Siswa jadi Instruktur)
    public function upgradeRole()
    {
        $user = Auth::user();
        $user->update(['role' => 'instructor']);
        return redirect()->route('instructor.dashboard')->with('success', 'Selamat! Anda sekarang adalah Instruktur.');
    }
}