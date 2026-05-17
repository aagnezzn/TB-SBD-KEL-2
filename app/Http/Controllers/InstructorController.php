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
    // 1. Menampilkan Halaman Login
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        }
        return view('instructor.login');
    }

    // 2. Dashboard Ringkasan
    public function index()
    {
        $user = Auth::user();
        
        $courses = Course::where('instructor_id', $user->id)->latest()->get();
        $courseIds = $courses->pluck('id');

        $totalCourses = $courses->count();
        $totalStudents = Enrollment::whereIn('course_id', $courseIds)->count();
        
        $avgRating = \App\Models\Review::whereIn('course_id', $courseIds)->avg('rating') ?? 0;
        $avgRating = round($avgRating, 1);

        // FAKTANYA: Query diubah langsung memfilter course_id di tabel payments tanpa lewat enrollment
        $totalRevenue = Payment::whereIn('course_id', $courseIds)->where('status', 'success')->sum('amount');

        return view('instructor.dashboard', compact('courses', 'totalCourses', 'totalStudents', 'avgRating', 'totalRevenue'));
    }

    // 3. Daftar Kursus Saya
    public function myCourses()
    {
        $courses = Course::where('instructor_id', Auth::id())->latest()->get();
        return view('instructor.courses.index', compact('courses'));
    }

    // 4. Form Buat Kursus 
    public function createCourse() {
        $categories = Category::all(); 
        return view('instructor.courses_create', compact('categories'));
    }

    // Alias untuk createCourse jika rute memanggil createNewCourse
    public function createNewCourse() {
        return $this->createCourse();
    }

    // 5. Simpan Kursus
    public function storeCourse(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $angkaAcak = rand(1000, 9999);
        $imageUrl = "https://loremflickr.com/640/360/computer,office?lock={$angkaAcak}";

        Course::create([
            'instructor_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => $imageUrl,
            'status' => 'active',
        ]);

        // Jika pembuatnya adalah Instruktur asli, langsung arahkan ke dashboard instruktur, jangan ke halaman upgrade role lagi
        if (Auth::user()->role === 'instructor') {
            return redirect()->route('instructor.dashboard')->with('success', 'Kursus baru Anda berhasil diterbitkan!');
        }

        // kalo yang ngisi siswa, dibalikkan ke halaman konfirmasi
        return redirect()->route('instructor.confirmation');
    }

    // Alias untuk storeCourse
    public function storeNewCourse(Request $request) {
        return $this->storeCourse($request);
    }

    // 6. Manage & Edit
    public function manageCourse($id)
    {
        $course = Course::with('lessons')->where('instructor_id', Auth::id())->findOrFail($id);
        return view('instructor.courses.manage', compact('course'));
    }

    // Form Edit Kursus
    public function editCourse($id)
    {
        $course = Course::where('instructor_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        return view('instructor.courses.edit', compact('course', 'categories'));
    }

    // Proses Perbaruan Data Kursus
   public function updateCourse(Request $request, $id)
{
    // 1. Validasi
    $request->validate([
        'category_id' => 'required',
        'title' => 'required|string|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
    ]);

    // 2. Cari kursus
    $course = Course::where('instructor_id', Auth::id())->findOrFail($id);
    
    // 3. Update Kursus Utama
    $course->update([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
    ]);

    // 4. Update Materi 
    if ($request->has('lessons')) {
        foreach ($request->lessons as $lessonId => $lessonData) {
            Lesson::where('id', $lessonId)
                  ->where('course_id', $course->id)
                  ->update([
                      'title' => $lessonData['title']
                  ]);
        }
    }
    
    return redirect()->route('instructor.courses.index')->with('success', 'Perubahan berhasil disimpan!');
}

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

    // 8. Daftar Siswa 
    public function myStudents()
    {
        $instructor = Auth::user();
        $courseIds = Course::where('instructor_id', $instructor->id)->pluck('id')->toArray();

        $students = \App\Models\User::where('role', 'student')
            ->whereHas('enrollments', function($query) use ($courseIds) {
                $query->whereIn('course_id', $courseIds);
            })
            ->with(['enrollments' => function($query) use ($courseIds) {
                $query->whereIn('course_id', $courseIds)->with('course');
            }])
            ->latest()
            ->get();

        return view('instructor.students.index', compact('students'));
    }

    // 9. Performa Statistik Grafik Pendapatan
   public function performance()
    {
        $user = Auth::user();
        $courses = Course::where('instructor_id', $user->id)->get();
        $courseIds = $courses->pluck('id');

        // FAKTANYA: Hitung total langsung dari data payments baru
        $totalEarnings = Payment::whereIn('course_id', $courseIds)->where('status', 'success')->sum('amount');
        $totalEnrollments = Enrollment::whereIn('course_id', $courseIds)->count();
        $averageRating = \App\Models\Review::whereIn('course_id', $courseIds)->avg('rating') ?? 0;

        $chartData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            
            // FAKTANYA: Query grafik mingguan diubah murni mendeteksi course_id langsung pada payments
            $dayIncome = Payment::whereIn('course_id', $courseIds)
            ->where('status', 'success')
            ->whereDate('created_at', $date->toDateString())
            ->sum('amount');

            $maxScale = 2000000; 
            $heightPercentage = $dayIncome > 0 ? min(($dayIncome / $maxScale) * 100, 100) : 0;

            $chartData[] = [
                'day'    => $date->isoFormat('ddd'), 
                'income' => $dayIncome,
                'height' => $heightPercentage
            ];
        }

        $data = [
            'total_earnings'    => $totalEarnings,
            'total_enrollments' => $totalEnrollments,
            'avg_rating'        => round($averageRating, 1),
        ];

        return view('instructor.performance', compact('data', 'chartData'));
    }

    // Merender halaman konfirmasi lama
    public function showConfirmation() {
        return view('instructor.confirmation');
    }

    // 10. Upgrade Role
    public function upgradeRole()
    {
        $user = Auth::user();
        $user->update(['role' => 'instructor']);
        return redirect()->route('instructor.dashboard')->with('success', 'Selamat! Anda sekarang adalah Instruktur.');
    }
}